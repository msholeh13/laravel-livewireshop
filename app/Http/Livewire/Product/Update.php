<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

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
    }
}
