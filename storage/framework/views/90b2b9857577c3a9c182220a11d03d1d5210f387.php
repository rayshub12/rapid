
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/new-category')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Categories</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent Cat</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php if(!empty($cat->cat_image)): ?><img src="<?php echo e(url('/images/frontend/post_images/category/large/'.$cat->cat_image)); ?>" width="60" alt="<?php echo e($cat->name); ?>"><?php endif; ?></td>
                                    <td><?php echo e($cat->name); ?></td>
                                    <td><?php echo e($cat->url); ?></td>
                                    <td><?php if($cat->parent_cat != 0): ?> <?php $__currentLoopData = \App\PostCategory::where('id', $cat->parent_cat)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcat_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($pcat_name->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> Main <?php endif; ?></td>
                                    <td><?php echo e(date('d M, Y', strtotime($cat->created_at))); ?></td>
                                    <td>
                                        <div id="donate">

                                            <?php if($cat->status == 1): ?>
                                            <a href="<?php echo e(url('/admin/category/'.$cat->id.'/disable')); ?>" title="Enable"
                                                class="label label-success label-sm">Enable</a>
                                            <?php else: ?>
                                            <a href="<?php echo e(url('/admin/category/'.$cat->id.'/enable')); ?>" title="Disable"
                                                class="label label-danger label-sm">Disable</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('/admin/category/'.$cat->id.'/edit')); ?>" class="label label-warning label-lg"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo e(url('/admin/category/'.$cat->id.'/delete')); ?>" class="label label-danger label-lg"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/posts/category_all.blade.php ENDPATH**/ ?>