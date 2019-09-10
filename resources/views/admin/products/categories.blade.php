@extends('admin.layout.base')
@section('title', 'Product Categories')
@section('data-page-id', 'adminCategories')
@section('content')
    <!-- Product Category-->
<div class="category admin_shared">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-11">
        <h2>Product Categories</h2><hr />
        </div>
        </div>

        @include('includes.message')

        <div class="grid-x grid-margin-x">
             <div class="cell small-12 medium-6">
                <form action="" method="post">
                    <div class="input-group">
                      <input type="text" class="input-group-field"  placeholder="search by name">
                        <div class="input-group-button">
                           <input type="submit" class="button" value="Search">
                        </div>

                    </div>
                </form>
             </div>

            <div class="cell small-12 medium-5">
                <form action="/admin/products/categories" method ="post">
                    <div class="input-group">
                        <input type="text" class="input-group-field" name="name"  placeholder="Category Name">
                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Create">
                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="grid-container ">
    <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-11">
            @if(count($categories))

                <table class="hover unstriped" data-form="deleteForm">
                    <thead>
                    <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Date Created</th>
                    <th width="70">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)

                        <tr>
                            <td>{{$category['name']}}</td>
                            <td>{{$category['slug']}}</td>
                            <td>{{$category['added']}}</td>
                            <td width="70" class="text-right">
                                <span data-tooltip class="top" tabindex="2" title="Add Sub Category.">
                                    <!--Add sub Category Modal -->
                                <a data-open="add-subcategory-{{$category['id']}}" ><i class="fa fa-plus"></i> </a>
                                </span>
                                <span data-tooltip class="top" tabindex="2" title="Edit Category.">
                                    <!--Edit Category Modal -->
                                <a data-open="item-{{$category['id']}}"><i class="fa fa-edit"></i> </a>
                                </span>
                                <span data-tooltip class="top" tabindex="2" title="Delete Category" style="display: inline-block">
                                    <!--Delete Category Modal -->
                                    <form method="post" action="/admin/products/categories/{{$category['id']}}/delete" class="delete-item">
                                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">

                                  <button type="submit"><i class="fa fa-times delete"></i> </button>

                                    </form>

                                </span>


                                <!--Edit Category Modal -->
                                <div class="reveal" id="item-{{$category['id']}}" data-reveal
                                     data-close-on-click ="false" data-close-on-esc ="false"
                                    data-animation-in="scale-in-up">
                                    <div class="notification callout primary"></div>
                                    <h2>Edit Category</h2>
                                    <form>
                                        <div class="input-group">
                                            <input type="text" id="item-name-{{$category['id']}}"
                                                   name="name" value="{{ $category['name'] }}">

                                            <div>
                                                <input type="submit" class="button update-category"
                                                       id="{{$category['id']}}"
                                                       name="token" data-token="{{ \App\Classes\CSRFToken::_token() }}"
                                                       value="Update">

                                            </div>

                                        </div>

                                    </form>

                                    <a href="/admin/products/categories" class="close-button"
                                       aria-label="Close modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </a>

                                </div>
                                <!--Edit Category Modal -->

                                <!--Add Sub Category Modal -->
                                <div class="reveal" id="add-subcategory-{{$category['id']}}" data-reveal
                                     data-close-on-click ="false" data-close-on-esc ="false"
                                     data-animation-in="scale-in-up">
                                    <div class="notification callout primary"></div>
                                    <h2>Add Sub Category</h2>
                                    <form>
                                        <div class="input-group">
                                            <input type="text" id="subcategory-name-{{$category['id']}}">

                                            <div>
                                                <input type="submit" class="button add-subcategory"
                                                       id="{{$category['id']}}"
                                                       name="token" data-token="{{ \App\Classes\CSRFToken::_token() }}"
                                                       value="Create">

                                            </div>

                                        </div>

                                    </form>

                                    <a href="/admin/products/categories" class="close-button"
                                       aria-label="Close modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </a>

                                </div>
                                <!--Add Sub Category Modal -->


                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>

                {!! $links !!}

                @else
            <h2>You have not created any category</h2>
                @endif
        </div>

    </div>
    </div>
</div>

    <!-- Product Category -->

    <!-- Sub Category -->

    <div class="Subcategory admin_shared">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell small-12 medium-11">
            <h2>Sub Categories</h2><hr/>
                </div>
            </div>
            </div>

        <div class="grid-container ">
            <div class="grid-x grid-margin-x">
                <div class="cell small-12 medium-11">
                    @if(count($subcategories))

                        <table class="hover unstriped" data-form="deleteForm">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Date Created</th>
                                <th width="50">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>

                            @foreach($subcategories as $subcategory)

                                <tr>
                                    <td>{{$subcategory['name']}}</td>
                                    <td>{{$subcategory['slug']}}</td>
                                    <td>{{$subcategory['added']}}</td>
                                    <td width="50" class="text-right">

                                        <span data-tooltip class="top" tabindex="2" title="Edit Sub Category.">
                                    <!--Edit Sub Category Modal -->
                                <a data-open="item-subcategory-{{$subcategory['id']}}"><i class="fa fa-edit"></i> </a>
                                </span>
                                        <span data-tooltip class="top" tabindex="2" title="Delete Sub Category" style="display: inline-block">
                                    <!--Delete Sub Category Modal -->
                                    <form method="post" action="/admin/products/subcategory/{{$subcategory['id']}}/delete" class="delete-item">
                                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">

                                  <button type="submit"><i class="fa fa-times delete"></i> </button>

                                    </form>

                                </span>


                                        <!--Edit Sub Category Modal -->
                                        <div class="reveal" id="item-subcategory-{{$subcategory['id']}}" data-reveal
                                             data-close-on-click ="false" data-close-on-esc ="false"
                                             data-animation-in="scale-in-up">
                                            <div class="notification callout primary"></div>
                                            <h2>Edit SubCategory</h2>
                                            <form>
                                                <div class="input-group">
                                                    <input type="text" id="item-subcategory-name-{{$subcategory['id']}}"
                                                            value="{{ $subcategory['name'] }}">

                                                </div>


                                                    <label>Change Category

                                                        <!-- sub category main category -->

                                                        <select id="item-category-{{ $subcategory['category_id'] }}">
                                                        @foreach(\App\Models\Category::all() as $category)
                                                            @if($category->id == $subcategory['category_id'])
                                                                    <option selected="selected" value="{{$category->id}}">
                                                                        {{$category->name}}</option>

                                                                @endif
                                                            <option value="{{$category->id}}" >{{$category->name}}</option>

                                                            @endforeach
                                                        </select>

                                                        <!-- sub category main category -->
                                                    </label>

                                                    <div class="input-group">

                                                        <input type="submit"
                                                               data-category-id="{{$subcategory['category_id']}}"
                                                               class="button update-subcategory"
                                                               data-token="{{ \App\Classes\CSRFToken::_token() }}"
                                                               value="Update"
                                                               id="{{$subcategory['id']}}">

                                                    </div>



                                            </form>

                                            <a href="/admin/products/categories" class="close-button"
                                               aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>

                                        </div>
                                        <!--Edit Sub Category Modal -->


                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                        {!! $subcategories_links !!}

                    @else
                        <h2>You have not created any Sub category</h2>
                    @endif
                </div>

            </div>
        </div>

    </div>
    <!-- Sub Category -->



<!--Delete Category Modal -->
    @include('includes.deletes-modal')
@endsection