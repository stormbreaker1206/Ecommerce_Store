<div class="grid-container">
    <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-11">
    <?php if(isset($errors) && count($errors) || \App\classes\Session::has('errors')): ?>

            <div class="callout alert" data-closable>

                <?php if( \App\classes\Session::has('errors')): ?> <!-- check for session errors -->
                <?php echo e(\App\classes\Session::flash('errors')); ?>


                    <?php else: ?> <!-- check for validation errors -->

        <?php $__currentLoopData = (array) $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- loops errors and display each -->

                <?php $__currentLoopData = (array) $error_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error_item); ?> <br />

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

        <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
        </button>
    </div>

    <?php endif; ?>
    </div>
    </div>

<div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-11">
    <?php if(isset($success) || \App\classes\Session::has('success')): ?>
    <div class="callout success" data-closable>

        <?php if(isset($success)): ?>

     <?php echo e($success); ?>


        <?php elseif(\App\classes\Session::has('success')): ?>
            <?php echo e(\App\classes\Session::flash('success')); ?>


            <?php endif; ?>

        <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
            <span arial-hidden="true">&times;</span>
        </button>
    </div>


    <?php endif; ?>
    </div>
</div>
</div>