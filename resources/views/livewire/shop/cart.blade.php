<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout') }} <button type="button" class="btn btn-sm btn-primary" wire:click='removeAllProduct()'>Clear All</button></div>

                <div class="card-body">
                    
                   <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $product)
                            <tr>
                                <td>{{$product->title}}</td>
                                <td>Rp {{ number_format($product->price,2,",",".") }}</td>
                                <td>
                                    <button wire:click="removeFromCart({{$product->id}})" class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <a href="{{route('shop.checkout')}}" class="btn btn-sm btn-primary float-right">Checkout</a>
                            </td>
                        </tr>
                    </tfoot>
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>