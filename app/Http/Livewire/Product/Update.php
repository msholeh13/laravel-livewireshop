<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use WithFileUploads;

    public $productId;
    public $title;
    public $price;
    public $description;
    public $image;
    public $imageOld;

    public $listeners = [
        'editProduct' => 'editProductHandler'
    ];


    public function render()
    {
        return view('livewire.product.update');
    }


    public function editProductHandler($product)
    {
        $this->productId = $product['id'];
        $this->title = $product['title'];
        $this->price = $product['price'];
        $this->description = $product['description'];
        $this->imageOld = asset('/storage/' . $product['image']);

        // dd([
        //     'product id'    => $this->productId,
        //     'title'         => $this->title,
        //     'price'         => $this->price,
        //     'description'   => $this->description,
        //     'image'         => $this->image,
        //     'image old'     => $this->imageOld
        // ]);
    }

    public function update()
    {
        $this->validate([
            'title'         => 'required|min:3',
            'price'         => 'required|numeric',
            'description'   => 'required|max:250',
            'image'         => 'image|max:1024'
        ]);

        if ($this->productId) {
            $product = Product::findOrFail($this->productId);

            $newImage = '';

            if ($this->image) {
                Storage::disk('public')->delete($product->image);

                $imageName = Str::slug($this->title, '-')
                    . '-'
                    . uniqid()
                    . '.'
                    . $this->image->getClientOriginalExtension();

                $this->image->storeAs('public', $imageName, 'local');

                $newImage = $imageName;
            } else {
                $newImage = $product->image;
            }

            $product->update([
                'title'         => $this->title,
                'price'         => $this->price,
                'description'   => $this->description,
                'image'         => $newImage
            ]);

            $this->emit('productUpdated');
        }
    }
}
