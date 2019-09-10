<?php $__env->startSection('title', 'test'); ?>
<?php $__env->startSection('content'); ?>
<div class="grid-container">
       <div class="grid-x grid-margin-x">
           <div class="cell small-12 medium-12">
<table>
    <thead>
    <tr>
        <th width="200">Table Header</th>
        <th>Table Header</th>
        <th width="150">Table Header</th>
        <th width="150">Table Header</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Content Goes Here</td>
        <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
        <td>Content Goes Here</td>
        <td>Content Goes Here</td>
    </tr>
    <tr>
        <td>Content Goes Here</td>
        <td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
        <td>Content Goes Here</td>
        <td>Content Goes Here</td>
    </tr>
    <tr>
        <td>Content Goes Here</td>
        <td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
        <td>Content Goes Here</td>
        <td>Content Goes Here</td>
    </tr>
    </tbody>
</table>
       </div>
       </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>