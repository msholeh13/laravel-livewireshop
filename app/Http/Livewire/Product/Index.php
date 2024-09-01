<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $formVisible;
    public $formUpdate = false;

    protected $updatesQueryString = [
        ['search' => ['except' => '']],
    ];

    protected $listeners = [
        'formClose'         => 'formcloseHandler',
        'productStored'     => 'productStoredHandler',
        'productUpdated'    => 'productUpdatedHandler',
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.product.index', [
            'products' => $this->search === NULL ?
                Product::latest()->paginate($this->paginate) :
                product::latest()
                ->where('title', 'LIKE', '%' . $this->search . '%')
                ->paginate($this->paginate)
        ]);
    }

    public function formcloseHandler()
    {
        $this->formVisible = false;
    }

    public function productStoredHandler()
    {
        $this->formVisible = false;
        session()->flash('message', 'Your product was successfully stored');
    }

    public function editProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $this->formVisible = true;
        $this->formUpdate = true;

        $this->emit('editProduct', $product);
    }

    public function productUpdatedHandler()
    {
        $this->formVisible = false;
        session()->flash('message', 'Your product was successfully updated');
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        session()->flash('message', 'Your product was successfully deleted');
    }
}
