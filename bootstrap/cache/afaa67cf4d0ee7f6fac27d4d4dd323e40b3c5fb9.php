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

                <?php if(count_chars($categories)): ?>

                    <li>

                        <a href="#">Categories</a>

                        <ul class="dropdown menu sub dropdown" data-dropdown-menu>
                            <!-- loop all the categories and display -->

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="/product-category/<?php echo e($category->id); ?>"><?php echo e($category->name); ?></a>

                                    <!-- check for all sub category for main category -->
                                    <?php if(count($category->subCategories)): ?>

                                        <ul class="dropdown menu sub dropdown" data-dropdown-menu>

                                            <!-- loop all the sub category and create a sub menu -->

                                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li>

                                                <a href="<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->name); ?></a>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                        <?php endif; ?>
                                </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </li>

                    <?php endif; ?>
            <!-- count all the categories to begin dropdown menu for categories -->


            </ul>
        </div>
        <div class="top-bar-right">
              <ul  class="dropdown menu vertical medium-horizontal menu" data-dropdown-menu>
                <?php if(isAuthenticated()): ?>
                 <li><a href="#"><?php echo e(user()->username); ?></a> </li>
                 <li><a href="/cart">Cart &nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i></a> </li>
                 <li><a href="/logout">Logout</a> </li>
                    <?php else: ?>
                <li><a href="/login">Sign In</a> </li>
                <li><a href="/register">Register</a> </li>
                <li><a href="/cart">Cart &nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a> </li>
                    <?php endif; ?>
            </ul>
        </div>
    </div>
</header>