@extends('layouts.app')
@section('title', 'Homepage')
@section('data-page-id', 'home')
@section('content')
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


          <section class="display-products" data-token="{{ $token }}" id="root">

              <h2>Featured Products</h2>
              <div class="grid-x grid-margin-x medium-up-2 large-up-4"> <!-- begin of grid -->

                  <!-- show 4 div on a medium screen and only show one on a small -->
                  <!-- V-for = for loop in vue.js -->
                  <div class="cell small-12 column " v-cloak v-for="feature in featured">
                      <a :href="'/product/' + feature.id">
                          <!-- featured product card -->
                          <div class="card" data-equalizer-watch>
                              <div class="card-section">
                                  <img :src="'/' + feature.image_path" width="100%" height="200">

                              </div>
                              <div class="card-section">
                                  <p>@{{stringLimit(feature.name, 15)}}</p>
                                  <a :href="'/product/' + feature.id" class="button more expanded">
                                      See More
                                  </a>
                                  <!-- vue.js on click event -->
                                  <button v-if="feature.quantity > 0" @click.prevent="addToCart(feature.id)"  class="button cart expanded">
                                     $@{{ feature.price }} TT -- Add to Cart
                                  </button>
                                  <button v-else  class="button cart expanded">
                                       Out of Stock
                                  </button>
                              </div>
                          </div>
                      </a>
                  </div>
                  <!-- V-for = for loop in vue.js -->
              </div> <!-- end of grid -->


              <h2>Product Picks</h2>
              <div class="grid-x grid-margin-x medium-up-2 large-up-4"> <!-- begin of grid -->

                  <!-- show 4 div on a medium screen and only show one on a small -->
                  <!-- V-for = for loop in vue.js -->
                  <div class="cell small-12 " v-cloak v-for="product in products">
                      <a :href="'/product/' + product.id">
                          <!-- featured product card -->
                          <div class="card" data-equalizer-watch>
                              <div class="card-section">
                                  <img :src="'/' + product.image_path" width="100%" height="200">

                              </div>
                              <div class="card-section">
                                  <p>@{{stringLimit(product.name, 20)}}</p>
                                  <a :href="'/product/' + product.id" class="button more expanded">
                                      See More
                                  </a>
                                  <button v-if="product.quantity > 0" @click.prevent="addToCart(product.id)" class="button cart expanded">
                                      $@{{ product.price }} TT -- Add to Cart
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

              <div class="text-center">
                  <i v-show="loading" class="fa fa-spinner fa-spin"
                     style="font-size: 3rem; padding-bottom: 3rem;
                position: fixed; top: 60%; bottom: 20%; color: #0a2b1d;"></i>
              </div>

          </section>

        </div>


    </div><!--end of grid -->

         </div>
    @stop
