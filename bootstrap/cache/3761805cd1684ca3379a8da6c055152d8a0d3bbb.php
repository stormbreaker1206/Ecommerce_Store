<?php $__env->startSection('title', 'User'); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard">
        <div class="grid-container">
            <h2>User</h2>
            <?php echo e($admin); ?>


            <form action="/admin" method="post" enctype="multipart/form-data">
                <input name="product" value="testing">
                <input type="file" name="image">
                <input type="submit" value="Go" name="submit">
            </form>



        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>