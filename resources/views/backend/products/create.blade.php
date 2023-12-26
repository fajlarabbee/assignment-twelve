@extends('backend.app')
@section('title', 'Add Product' . ' | ' . getenv('APP_NAME'))
@section('crumb-text', 'Add Product')

@section('content')
    <!-- horizontal form -->
   <div class="mx-auto max-w-xl">
       <x-form-errors />
       <x-message-success />

       <!-- form controls -->
       <form action="{{ route('product.store') }}" class="space-y-5 border p-6 rounded" method="POST" enctype="multipart/form-data">
           @csrf

           <div>
               <label for="product_name">Product Name <span class="text-danger">required</span></label>
               <input id="product_name" type="text" value="{{ old('product_name') }}" name="product_name" placeholder="Product Name" class="form-input" required />
           </div>
           <div>
               <label for="inp-product-description">Product Description</label>
               <textarea id="inp-product-description" rows="3" name="description" class="form-textarea" placeholder="Product Description">{{ old('description') }}</textarea>
           </div>
           <div>
               <label for="product_stock">Stock <span class="text-danger">required</span></label>
               <input id="product_stock" type="number" value="{{ old('stock') }}" step=".01"  name="stock" placeholder="Stock" class="form-input" required />
           </div>
           <div>
               <label for="product_price">Price <span class="text-danger">required</span></label>
               <input id="product_price" type="number" value="{{ old('price') }}" step=".01" name="price" placeholder="Unit Price" class="form-input" required />
           </div>

           <div>
               <label for="product_thumb">Product Thumbnail</label>
               <input id="product_thumb" type="file" value="{{ old('thumbnail') }}" name="thumbnail" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
           </div>
           <button type="submit" class="btn btn-primary !mt-6">Add Product</button>
       </form>
   </div>

@endsection
