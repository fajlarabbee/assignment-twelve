@extends('backend.app')
@section('title', 'Edit Product' . ' | ' . getenv('APP_NAME'))
@section('crumb-text', 'Edit Product')

@section('content')
    <!-- horizontal form -->
    <div class="mx-auto max-w-xl">
        <x-form-errors />
        <x-message-success />

        <!-- form controls -->
        <form action="{{ route('product.update', $product->id) }}" class="space-y-5 border p-6 rounded" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="product_name">Product Name <span class="text-danger">required</span></label>
                <input id="product_name" type="text" value="{{ old('product_name', $product->product_name) }}" name="product_name" placeholder="Product Name" class="form-input" required />
            </div>
            <div>
                <label for="inp-product-description">Product Description</label>
                <textarea id="inp-product-description" rows="3" name="description" class="form-textarea" placeholder="Product Description">{{ $product->description }}</textarea>
            </div>
            <div>
                <label for="product_stock">Stock <span class="text-danger">required</span></label>
                <input id="product_stock" type="number" value="{{ old('stock', $product->stock) }}" step=".01"  name="stock" class="form-input" required />
            </div>
            <div>
                <label for="product_price">Price <span class="text-danger">required</span></label>
                <input id="product_price" type="number" value="{{ old('price', $product->price) }}" step=".01" name="price" class="form-input" required />
            </div>

            <div>
                <div class="flex h-48 w-48 items-center mx-auto"><img
                        class="rounded-full object-cover"
                        @if( preg_match('/^(http)[s]{0,1}:\/\//', $product->thumbnail) )
                            src="{{ $product->thumbnail }}"
                        @else
                            src="{{ asset('uploads/product') . '/' . $product->thumbnail }}"
                        @endif
                    >
                </div>
                <label for="product_thumb">Product Thumbnail</label>
                <input id="product_thumb" type="file" name="thumbnail" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
            </div>
            <button type="submit" class="btn btn-primary !mt-6">Update</button>
        </form>
    </div>

@endsection
