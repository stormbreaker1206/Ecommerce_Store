<?php $categories = \App\Models\Category::with('subCategories')->get()

?>
<header  class="navigation">
    <div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
        <button class="menu-icon" type="button" data-toggle="example-menu"></button>
        <div class="title-bar-title">Menu</div>
    </div>

    <div class="top-bar" id="example-menu">
        <div style="padding-left: 2rem" class="top-bar-title show for medium">

            <a href="/" class=""><img class="logo" src="/images/logo.png"></a>
        </div>

        <div class="top-bar-left">
            <ul class="dropdown menu vertical medium-horizontal menu" data-dropdown-menu>
                 <!-- count all the categories to begin drop-down menu for categories -->

                @if(count_chars($categories))

                    <li>

                        <a href="#">Categories</a>

                        <ul class="dropdown menu sub dropdown" data-dropdown-menu>
                            <!-- loop all the categories and display -->

                            @foreach($categories as $category)
                                <li>
                                    <a href="/product-category/{{$category->id}}">{{$category->name}}</a>

                                    <!-- check for all sub category for main category -->
                                    @if(count($category->subCategories))

                                        <ul class="dropdown menu sub dropdown" data-dropdown-menu>

                                            <!-- loop all the sub category and create a sub menu -->

                                            @foreach($category->subCategories as $subCategory)

                                                <li>

                                                <a href="{{$subCategory->id}}">{{$subCategory->name}}</a>
                                                </li>
                                                @endforeach

                                        </ul>
                                        @endif
                                </li>

                                @endforeach

                        </ul>
                    </li>

                    @endif
            <!-- count all the categories to begin dropdown menu for categories -->


            </ul>
        </div>
        <div class="top-bar-right">
              <ul  class="dropdown menu vertical medium-horizontal menu" data-dropdown-menu>
                @if(isAuthenticated())
                 <li><a href="#">{{ user()->username }}</a> </li>
                 <li><a href="/cart">Cart &nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i></a> </li>
                 <li><a href="/logout">Logout</a> </li>
                    @else
                <li><a href="/login">Sign In</a> </li>
                <li><a href="/register">Register</a> </li>
                <li><a href="/cart">Cart &nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a> </li>
                    @endif
            </ul>
        </div>
    </div>
</header>