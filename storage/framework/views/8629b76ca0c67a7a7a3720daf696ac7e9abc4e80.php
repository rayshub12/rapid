<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/add-property')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Property List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Properties</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Listed For</th>
                                    <th>Price</th>
                                    <th>Project Status</th>
                                    <th>Loacation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td>
                                        <?php if(!empty($p->images_mlink)): ?>
                                        <?php $__currentLoopData = explode(',',$p->images_mlink); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image_m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key == 0): ?>
                                        <img width="80" class="img-responsive" src="<?php echo e($image_m); ?>">
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0): ?>
                                        <?php $__currentLoopData = \App\PropertyImage::where('property_id', $p->id)->take(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img width="80" class="img-responsive" src="<?php echo e(url('images/frontend/property_images/large/'.$pim->image_name)); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <img width="80" src="<?php echo e(url('images/frontend/property_images/large/default.png')); ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="<?php echo e(url('/properties/'.$p->reference)); ?>"><?php echo e($p->pro_title); ?></a></td>
                                    <td><label class="label label-md label-success"><?php if($p->offering_type == 'sale'): ?>
                                            Sale <?php elseif($p->offering_type == 'rent'): ?> Rent <?php endif; ?></label></td>
                                    <td><?php if($p->offering_type == 'sale'): ?> AED <?php echo e($p->price_value); ?>

                                        <?php elseif($p->offering_type == 'rent'): ?> AED <?php echo e($p->price_value); ?> /year <?php endif; ?></td>
                                    <td><label class="label label-md- label-info"><?php if($p->project_status == 'off_plan'): ?>
                                            Off Plan <?php endif; ?></label></td>
                                    <td><?php echo e($p->community); ?>, <?php echo e($p->city); ?></td>
                                    <td>
                                        <div id="donate">
                                            <a href="<?php echo e(url('/admin/property/'.$p->reference.'/edit')); ?>" title="Edit"
                                                class="label label-success label-sm"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(url('/admin/property/'.$p->reference.'/delete')); ?>"
                                                title="Delete" class="label label-danger label-sm"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info_1" id="allusers-table_info_1" role="status" aria-live="polite">
                                Showing 1 to 10 of 10 entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers_1" id="allusers-table_paginate_1">
                                <?php echo $properties->render(); ?>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
.dataTables_info,
.paging_simple_numbers {
    display: none;
}

.pagination {
    margin: 10px 20px 20px 0px;
    float: right;
}

.dataTables_info_1 {
    margin: 20px;
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\RapidDeals\resources\views/admin/property/view_property.blade.php ENDPATH**/ ?>