<div class="off-canvas position-left reveal-for-large nav" id="offCanvas" data-off-canvas>

    <!-- Side Bar Menu -->
    <h3>Admin Panel</h3>
    <div class="image-holder text-center">
        <img src="/images/mayon.JPG" alt="Mayon" title="Admin">
        <p>{{user()->fullname}}</p>
        
    </div>
    <ul class="vertical menu">
        <li><a href="/admin"><i class="fa fa-tachometer fa-fw" aria-hiddens="true"></i>&nbsp; Dashboard</a></li>
        <li><a href="/admin"><i class="fa fa-users fa-fw" aria-hiddens="true"></i>&nbsp; Users</a></li>
        <li><a href="/admin/products/create"><i class="fa fa-plus fa-fw" aria-hiddens="true"></i>&nbsp; Add Product</a></li>
        <li><a href="/admin/products"><i class="fa fa-pencil fa-fw" aria-hiddens="true"></i>&nbsp; Manage Products</a></li>
        <li><a href="/admin/products/categories"><i class="fa fa-plus fa-fw" aria-hiddens="true"></i>&nbsp; Categories</a></li>
        <li><a href="/admin/users/orders"><i class="fa fa-shopping-cart fa-fw" aria-hiddens="true"></i>&nbsp; View Orders</a></li>
        <li><a href="/admin/users/payments"><i class="fa fa-money fa-fw" aria-hiddens="true"></i>&nbsp; Payments</a></li>
        <li><a href="/logout"><i class="fa fa-sign-out fa-fw" aria-hiddens="true"></i>&nbsp; Logout</a></li>
    </ul>

    <!-- End Side Bar Menu -->

</div>