
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/new-banners')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Banners</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Banners</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><strong><?php echo e($i); ?></strong></td>
                                    <td><img width="200" src="<?php echo e(url('/images/frontend/banner/large/'.$bn->image)); ?>" alt=""></td>
                                    <td><a href="<?php echo e($bn->link); ?>"><?php echo e($bn->title); ?></a></td>
                                    <td><?php echo e($bn->description); ?></td>
                                    <td>
                                        <div id="donate">

                                            <?php if($bn->status == 1): ?>
                                            <a href="/admin/banner/<?php echo e($bn->id); ?>/disable" title="Disable"
                                                class="label label-success label-sm">Enable</a>
                                            <?php else: ?>
                                            <a href="/admin/banner/<?php echo e($bn->id); ?>/enable" title="Enable"
                                                class="label label-danger label-sm">Disable</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td><a href="<?php echo e(url('/admin/banner/'.$bn->id.'/edit')); ?>" title="Edit"
                                                class="label label-warning label-sm"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo e(url('/admin/banner/'.$bn->id.'/delete')); ?>" title="Delete"
                                                class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
                                            
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/setting/banners/banners.blade.php ENDPATH**/ ?>