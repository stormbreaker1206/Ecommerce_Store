<?php $__env->startSection('title', 'Edit Product'); ?>
<?php $__env->startSection('data-page-id', 'adminProduct'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Product Category-->

<div class="add-product">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-11">
        <h2>Edit <?php echo e($product->name); ?></h2><hr />
        </div>
        </div>
    </div>
    <?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                                       value="<?php echo e($product->name); ?>">

                            </label>
                        </div>
                        <!-- Input Block Product Name -->

                        <!--Input Block Price -->
                        <div class="cell small-12 medium-6">
                            <label>Product Price:
                                <input type="text" name="price"
                                       value="<?php echo e($product->price); ?>">

                            </label>
                        </div>
                        <!-- Input Block Price -->

                        <!--Input Block Product Category -->
                        <div class="cell small-12 medium-6">
                            <label>Product Category:
                                <select name="category" id="product-category">
                                    <option value="<?php echo e($product->category->id); ?>">
                                        <?php echo e($product->category->name); ?>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </label>
                        </div>
                        <!-- Input Block Product Category-->

                        <!--Input Block Product Sub Category -->
                        <div class="cell small-12 medium-6">
                            <label>Product Sub Category:

                                <select name="subcategory" id="product-subcategory">
                                    <option value="<?php echo e($product->subCategory->id); ?>">
                                        <?php echo e($product->subCategory->name); ?>

                                    </option>
                                </select>
                            </label>
                        </div>
                        <!-- Input Block Product Sub Category -->

                        <!--Input Block Product Quantity -->
                        <div class="cell small-12 medium-6">
                            <label>Product Quantity:
                                <select name="quantity">
                                    <option value="<?php echo e($product->quantity); ?>">
                                    <?php echo e($product->quantity); ?>


                                    <?php for($i = 1; $i <= 50; $i++): ?>
                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>

                                    <?php endfor; ?>

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
                            <textarea name="description"><?php echo e($product->description); ?></textarea>
                            </label>
                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
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
                    <form method="post" action="/admin/products/<?php echo e($product->id); ?>/delete" class="delete-item">
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">

                        <button style="padding: 1rem" type="submit" class="button alert">Delete Product </button>

                    </form>
                </td>

            </tr>
        </table>
        <!-- javascript data to delete record -->

    </div>
    </div>

    <!-- Delete Button -->

</div>


    <?php echo $__env->make('includes.deletes-modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>