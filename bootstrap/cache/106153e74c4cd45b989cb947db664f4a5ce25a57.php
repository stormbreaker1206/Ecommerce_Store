<?php $__env->startSection('title'); ?><?php echo e($product->name); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('data-page-id', 'product'); ?>
<?php $__env->startSection('content'); ?>
    <div class="grid-container">
   <div class="product" id="product" data-token="<?php echo e($token); ?>" data-id="<?php echo e($product->id); ?>">

       <div class="text-center">

           <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding-bottom:3rem; color: #0a0a0a;">

           </i>
       </div>
       <!-- v-if will display data once it is finish loading -->
       <section class="item-container" v-cloak v-if="loading == false">

           <div class="row column">
               <nav aria-label="You are here:" role="navigation">
                   <ul class="breadcrumbs">
                       <!-- bind the url with : in vue -->
                       <li><a :href="'/product/category/' + category.slug">{{ category.name }}</a></li>
                       <li><a :href="'/product/subCategory/' + subCategory.slug">{{ subCategory.name }}</a></li>
                       <li>{{ product.name }}</li>

                   </ul>
               </nav>

           </div>

           <div class="row collapse">
               <div class="grid-x grid-margin-x">
               <div class="cell small-12 medium-5 large-4">
                   <img src="/<?php echo e($product->image_path); ?>" width="100%" height="200">
                   <!-- retrieve image using vue.js
                   <img :src="'/' + product.image_path" width="200" height="200"> -->
               </div>

               <div class="cell small-12 medium-7 large-8">
                   <div class="product-details">
                       <h2> {{ product.name }}</h2>
                       <p> {{ product.description }}</p>
                       <h2>${{ product.price }} TT</h2>
                       <button v-if="product.quantity > 0" @click.prevent="addToCart(product.id)"  class="button alert"> Add to Cart</button>
                       <button v-else class="button alert"> Out of Stock</button>
                   </div>

               </div>

           </div>
         </div>

       </section>

       <!-- similar Products -->

       <section class="home" v-if="loading == false">
           <h2 style="margin-left: 1rem;">Similar Products</h2>
           <div class="display-products">

               <div class="grid-x grid-margin-x medium-up-2 large-up-4"> <!-- begin of grid -->

                   <!-- show 4 div on a medium screen and only show one on a small -->
                   <!-- V-for = for loop in vue.js -->
                   <div class="cell small-12 column " v-cloak v-for="similar in similarProducts">
                       <a :href="'/product/' + similar.id">
                           <!-- featured product card -->
                           <div class="card" data-equalizer-watch>
                               <div class="card-section">
                                   <img :src="'/' + similar.image_path" width="100%" height="200">

                               </div>
                               <div class="card-section">
                                   <p>{{stringLimit(similar.name, 15)}}</p>
                                   <a :href="'/product/' + similar.id" class="button more expanded">
                                       See More
                                   </a>
                                   <button v-if="similar.quantity > 0"  @click.prevent="addToCart(similar.id)" class="button cart expanded">
                                       ${{ similar.price }} TT -- Add to Cart
                                   </button>
                                   <button v-else class="button cart expanded">
                                       Out of Stock
                                   </button>
                               </div>
                           </div>
                       </a>
                   </div>
                   <!-- V-for = for loop in vue.js -->
               </div> <!-- end of grid -->

           </div>

       </section>

   </div>

    </div>

    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>