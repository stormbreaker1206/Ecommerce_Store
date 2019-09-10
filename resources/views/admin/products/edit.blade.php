@extends('admin.layout.base')
@section('title', 'Edit Product')
@section('data-page-id', 'adminProduct')
@section('content')
    <!-- Product Category-->

<div class="add-product admin_shared">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-11">
        <h2>Edit {{ $product->name }}</h2><hr />
        </div>
        </div>
    </div>
    @include('includes.message')

            <div class="grid-container">

            <form method="post" action="/admin/products/edit" enctype="multipart/form-data">

                <!-- begin of input container -->
                <div class="grid-x grid-margin-x">

                <div class="cell small-12 medium-11">

                    <div class="grid-x grid-margin-x">
                        <!--Input Block Product Name -->
                        <div class="cell small-12 medium-6">
                            <label>Product Name:
                                <input type="text" name="name"
                                       value="{{ $product->name }}">

                            </label>
                        </div>
                        <!-- Input Block Product Name -->

                        <!--Input Block Price -->
                        <div class="cell small-12 medium-6">
                            <label>Product Price:
                                <input type="text" name="price"
                                       value="{{ $product->price }}">

                            </label>
                        </div>
                        <!-- Input Block Price -->

                        <!--Input Block Product Category -->
                        <div class="cell small-12 medium-6">
                            <label>Product Category:
                                <select name="category" id="product-category">
                                    <option value="{{ $product->category->id }}">
                                        {{$product->category->name }}
                                        @foreach($categories as $category)

                                            <option value="{{$category->id}}">{{$category->name}}</option>

                                            @endforeach
                                </select>
                            </label>
                        </div>
                        <!-- Input Block Product Category-->

                        <!--Input Block Product Sub Category -->
                        <div class="cell small-12 medium-6">
                            <label>Product Sub Category:

                                <select name="subcategory" id="product-subcategory">
                                    <option value="{{$product->subCategory->id}}">
                                        {{$product->subCategory->name}}
                                    </option>
                                </select>
                            </label>
                        </div>
                        <!-- Input Block Product Sub Category -->

                        <!--Input Block Product Quantity -->
                        <div class="cell small-12 medium-6">
                            <label>Product Quantity:
                                <select name="quantity">
                                    <option value="{{$product->quantity}}">
                                    {{$product->quantity}}

                                    @for($i = 1; $i <= 50; $i++)
                                        <option value="{{$i}}">{{$i}}</option>

                                    @endfor

                                </select>
                            </label>
                        </div>
                        <!-- Input Block Product Quantity-->

                        <!--Input Block Image -->
                        <div class="cell small-12 medium-6">
                            <br/>
                            <div class="input-group">
                                <span class="input-group-label">Product Image:</span>
                                <input type="file" name="productImage" class="input-group-field">
                            </div>

                        </div>
                        <!-- Input Block Image -->

                        <div class="cell small-12 medium-12">
                            <label>Description
                            <textarea name="description">{{$product->description}}</textarea>
                            </label>
                            <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                             <input class="button warning" type="submit" value="Update Product">
                        </div>
                    </div>
                </div>
                <!-- end of input container -->
                </div>
            </form>


        </div>

    </form>

    <!-- Delete Button -->
    <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-12">
        <!-- javascript data to delete record -->
        <table data-form = "deleteForm">
            <tr style="border: 1px solid #ffffff; !important;">
                <td style="border: 1px solid #ffffff;">
                    <form method="post" action="/admin/products/{{$product->id}}/delete" class="delete-item">
                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">

                        <button type="submit" class="button alert">Delete Product </button>

                    </form>
                </td>

            </tr>
        </table>
        <!-- javascript data to delete record -->

    </div>
    </div>

    <!-- Delete Button -->

</div>


    @include('includes.deletes-modal')
@endsection