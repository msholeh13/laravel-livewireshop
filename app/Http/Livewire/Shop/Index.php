<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    public $UpdatesQueryString = [
        ['search' => ['except' => '']]
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.shop.index', [
            'products' => $this->search === NULL ?
                Product::latest()->paginate(8) :
                Product::latest()->where('title', 'LIKE', '%' . $this->search . '%')->paginate(8)

        ]);
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        Cart::add($product);

        $this->emit('addToCart');
        // $cart = Cart::get()['products'];
        // dd($cart);
    }
}
