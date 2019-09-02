
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
                                    <td><?php if(!empty($p->image_name)): ?> <img src="<?php echo e(url('images/frontend/property_images/large/'.$p->image_name)); ?>" width="60" alt="<?php echo e($p->name); ?>"> <?php endif; ?></td>
                                    <td><a href="<?php echo e(url('/properties/'.$p->id)); ?>"><?php echo e($p->name); ?></a></td>
                                    <td><?php if($p->property_for == 1): ?> Buy <?php elseif($p->property_for == 2): ?> Sale <?php else: ?> Off Plan <?php endif; ?></td>
                                    <td>AED <?php echo e($p->property_price); ?></td>
                                    <td><?php if(!empty($p->city)): ?> <?php $__currentLoopData = \App\City::where('id', $p->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($cname->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></td>
                                    <td>
                                        <div id="donate">
                                            <a href="<?php echo e(url('/admin/property/'.$p->id.'/edit')); ?>" title="Edit" class="label label-success label-sm"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(url('/admin/property/'.$p->id.'/delete')); ?>" title="Delete" class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
                                        </div>
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
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/property/view_property.blade.php ENDPATH**/ ?>