<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Recent Update</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Properties</span>
                        <span class="label label-success">Total &nbsp;<?php echo e(\App\Property::get()->count()); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Property</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="item">
                                <div class="product-img">
                                <?php if(!empty($p->images_mlink)): ?>
                                    <?php $__currentLoopData = explode(',',$p->images_mlink); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image_m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key == 0): ?>
                                        <img class="img-responsive" src="<?php echo e($image_m); ?>">
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <img src="<?php echo e(url('images/frontend/property_images/large/default.png')); ?>">
                                <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <a href="<?php echo e(url('/properties/'.$p->reference)); ?>" target="_blank" class="product-title"><?php echo e(str_limit($p->pro_title, $limit=150)); ?>

                                        <span class="label label-success pull-right"><?php if($p->offering_type == 'rent'): ?>
                                            AED <?php echo e($p->price_value); ?> <span>/Year</span>
                                            <?php else: ?>
                                            AED <?php echo e($p->price_value); ?>

                                            <?php endif; ?></span></a>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="<?php echo e(url('/admin/properties')); ?>" class="uppercase">View All Properties</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\RapidDeals\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>