<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Property Type</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Property Type</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="add_property_type" id="add_property_type" method="POST"
                        action="<?php echo e(url('/admin/prop_type/add')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Property Type</label>
                                        <?php if($errors->any()): ?>
                                        <span id="error_name " class="pull-right">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="text-danger"><?php echo e($error); ?><label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                        <?php endif; ?>
                                        <input type="text" name="property_type_name" id="property_type_name" class="form-control"
                                            placeholder="Property Type">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 hidden">
                                    <div class="form-group">
                                        <label>Property Code</label>
                                        <input type="text" name="type_code" id="type_code" class="form-control"
                                            placeholder="Property Code" value="<?php echo rand(0001, 9999); ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="property_type_desc" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Disable</label>
                                        <input type="checkbox" name="status" id="status">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">Add Property Type</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/property/add_property_type.blade.php ENDPATH**/ ?>