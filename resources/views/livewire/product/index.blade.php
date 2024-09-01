<div class="container">
    @if ($formVisible)
        @if (!$formUpdate)
            @livewire('product.create')
        @else
            @livewire('product.update')
        @endif    
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row px-3 d-flex justify-content-between align-items-center">
                        {{ __('Product') }}
                        <button wire:click="$toggle('formVisible')" class="btn btn-primary btn-sm">Create</button>
                    </div>
                </div>

                <div class="card-body">
                    
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <select wire:model="paginate" name="" id="" class="form-control form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>

                        <div class="col">
                            <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="cari">
                        </div>
                    </div>

                    <hr>    
                    
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="col">{{$loop->iteration + $products->firstItem() - 1}}</th>
                                    <td>{{$product->title}}</td>
                                    <td> Rp{{number_format($product->price,2,",",".")}} </td>
                                    <td>
                                        <button wire:click="editProduct( {{$product->id}} )" class="btn btn-sm btn-info text-white">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$products->withQueryString()->links()}}

                </div>
            </div>
        </div>
    </div>