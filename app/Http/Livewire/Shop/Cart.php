<?php

namespace App\Http\Livewire\Shop;

use App\Product;
use Livewire\Component;
use App\Facades\Cart as FacadesCart;

class Cart extends Component
{

    public $cart;

    public function mount()
    {
        $this->cart = FacadesCart::get()['products'];
    }

    public function render()
    {
        return view('livewire.shop.cart');
    }

    public function removeFromCart($productId)
    {
        FacadesCart::remove($productId);
        $this->cart = FacadesCart::get()['products'];
        $this->emit('removeFromCart');
    }

    public function removeAllProduct()
    {
        FacadesCart::clear();
        $this->cart = FacadesCart::get()['products'];
        $this->emit('removeAllProduct');
    }
}
