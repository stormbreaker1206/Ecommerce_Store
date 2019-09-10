<?php $__env->startSection('title', 'Product Category'); ?>
<?php $__env->startSection('data-page-id', 'search'); ?>
<?php $__env->startSection('content'); ?>
    <div class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-12 home">

            <section v-cloak class="hero">

                <div class="hero-slider">
                    <div><img src="/images/sliders/slide_1.jpg" alt="Acme Store"></div>
                    <div><img src="/images/sliders/slide_2.jpg" alt="Acme Store"></div>
                    <div><img src="/images/sliders/slide_3.jpg" alt="Acme Store"></div>

                </div>

            </section>


          <section class="display-products" data-token="<?php echo e($token); ?>" id="root">




              <h2>Product Picks</h2>
              <div class="grid-x grid-margin-x medium-up-2 large-up-4"> <!-- begin of grid -->

              <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                  <div class="cell small-12 ">
                      <a href="">
                          <!-- featured product card -->
                          <div class="card" data-equalizer-watch>
                              <div class="card-section">
                                  <img src="/<?php echo e($products['image_path']); ?>" width="100%" height="200">

                              </div>
                              <div class="card-section">
                                  <p><?php echo e($products['name']); ?></p>
                                  <a href="" class="button more expanded">
                                      See More
                                  </a>
                                  <button  class="button cart expanded">
                                       TT -- Add to Cart
                                  </button>
                                  <button v-else class="button cart expanded">
                                      Out of Stock
                                  </button>
                              </div>
                          </div>
                      </a>
                  </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <!-- V-for = for loop in vue.js -->
              </div> <!-- end of grid -->

          </section>

        </div>


    </div><!--end of grid -->

         </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>