<?php $__env->startSection('title', 'Product Categories'); ?>
<?php $__env->startSection('data-page-id', 'adminCategories'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Product Category-->
<div class="category admin_shared">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
        <div class="cell small-12 medium-11">
        <h2>Product Categories</h2><hr />
        </div>
        </div>

        <?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
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
            <?php if(count($categories)): ?>

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

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e($category['name']); ?></td>
                            <td><?php echo e($category['slug']); ?></td>
                            <td><?php echo e($category['added']); ?></td>
                            <td width="70" class="text-right">
                                <span data-tooltip class="top" tabindex="2" title="Add Sub Category.">
                                    <!--Add sub Category Modal -->
                                <a data-open="add-subcategory-<?php echo e($category['id']); ?>" ><i class="fa fa-plus"></i> </a>
                                </span>
                                <span data-tooltip class="top" tabindex="2" title="Edit Category.">
                                    <!--Edit Category Modal -->
                                <a data-open="item-<?php echo e($category['id']); ?>"><i class="fa fa-edit"></i> </a>
                                </span>
                                <span data-tooltip class="top" tabindex="2" title="Delete Category" style="display: inline-block">
                                    <!--Delete Category Modal -->
                                    <form method="post" action="/admin/products/categories/<?php echo e($category['id']); ?>/delete" class="delete-item">
                                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">

                                  <button type="submit"><i class="fa fa-times delete"></i> </button>

                                    </form>

                                </span>


                                <!--Edit Category Modal -->
                                <div class="reveal" id="item-<?php echo e($category['id']); ?>" data-reveal
                                     data-close-on-click ="false" data-close-on-esc ="false"
                                    data-animation-in="scale-in-up">
                                    <div class="notification callout primary"></div>
                                    <h2>Edit Category</h2>
                                    <form>
                                        <div class="input-group">
                                            <input type="text" id="item-name-<?php echo e($category['id']); ?>"
                                                   name="name" value="<?php echo e($category['name']); ?>">

                                            <div>
                                                <input type="submit" class="button update-category"
                                                       id="<?php echo e($category['id']); ?>"
                                                       name="token" data-token="<?php echo e(\App\Classes\CSRFToken::_token()); ?>"
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
                                <div class="reveal" id="add-subcategory-<?php echo e($category['id']); ?>" data-reveal
                                     data-close-on-click ="false" data-close-on-esc ="false"
                                     data-animation-in="scale-in-up">
                                    <div class="notification callout primary"></div>
                                    <h2>Add Sub Category</h2>
                                    <form>
                                        <div class="input-group">
                                            <input type="text" id="subcategory-name-<?php echo e($category['id']); ?>">

                                            <div>
                                                <input type="submit" class="button add-subcategory"
                                                       id="<?php echo e($category['id']); ?>"
                                                       name="token" data-token="<?php echo e(\App\Classes\CSRFToken::_token()); ?>"
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

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>

                <?php echo $links; ?>


                <?php else: ?>
            <h2>You have not created any category</h2>
                <?php endif; ?>
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
                    <?php if(count($subcategories)): ?>

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

                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($subcategory['name']); ?></td>
                                    <td><?php echo e($subcategory['slug']); ?></td>
                                    <td><?php echo e($subcategory['added']); ?></td>
                                    <td width="50" class="text-right">

                                        <span data-tooltip class="top" tabindex="2" title="Edit Sub Category.">
                                    <!--Edit Sub Category Modal -->
                                <a data-open="item-subcategory-<?php echo e($subcategory['id']); ?>"><i class="fa fa-edit"></i> </a>
                                </span>
                                        <span data-tooltip class="top" tabindex="2" title="Delete Sub Category" style="display: inline-block">
                                    <!--Delete Sub Category Modal -->
                                    <form method="post" action="/admin/products/subcategory/<?php echo e($subcategory['id']); ?>/delete" class="delete-item">
                                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">

                                  <button type="submit"><i class="fa fa-times delete"></i> </button>

                                    </form>

                                </span>


                                        <!--Edit Sub Category Modal -->
                                        <div class="reveal" id="item-subcategory-<?php echo e($subcategory['id']); ?>" data-reveal
                                             data-close-on-click ="false" data-close-on-esc ="false"
                                             data-animation-in="scale-in-up">
                                            <div class="notification callout primary"></div>
                                            <h2>Edit SubCategory</h2>
                                            <form>
                                                <div class="input-group">
                                                    <input type="text" id="item-subcategory-name-<?php echo e($subcategory['id']); ?>"
                                                            value="<?php echo e($subcategory['name']); ?>">

                                                </div>


                                                    <label>Change Category

                                                        <!-- sub category main category -->

                                                        <select id="item-category-<?php echo e($subcategory['category_id']); ?>">
                                                        <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($category->id == $subcategory['category_id']): ?>
                                                                    <option selected="selected" value="<?php echo e($category->id); ?>">
                                                                        <?php echo e($category->name); ?></option>

                                                                <?php endif; ?>
                                                            <option value="<?php echo e($category->id); ?>" ><?php echo e($category->name); ?></option>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>

                                                        <!-- sub category main category -->
                                                    </label>

                                                    <div class="input-group">

                                                        <input type="submit"
                                                               data-category-id="<?php echo e($subcategory['category_id']); ?>"
                                                               class="button update-subcategory"
                                                               data-token="<?php echo e(\App\Classes\CSRFToken::_token()); ?>"
                                                               value="Update"
                                                               id="<?php echo e($subcategory['id']); ?>">

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

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>

                        <?php echo $subcategories_links; ?>


                    <?php else: ?>
                        <h2>You have not created any Sub category</h2>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </div>
    <!-- Sub Category -->



<!--Delete Category Modal -->
    <?php echo $__env->make('includes.deletes-modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>