<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    
    <section class="content-header">
        <h1>Add New Member</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Team Member</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" name="add_member" id="add_member"
                        method="POST" action="<?php echo e(url('/admin/team_member/add')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <?php if($errors->any()): ?>
                                        <span id="error_name " class="pull-right">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="text-danger"><?php echo e($error); ?><label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                        <?php endif; ?>
                                        <input type="text" name="name" id="TeamName" class="form-control"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <span id="error_name" class="pull-right"></span>
                                        <input type="text" name="position" id="MemberPosition" class="form-control"
                                            placeholder="Designation">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span id="error_msg" class="pull-right"></span>
                                        <textarea name="description" id="MemberDescription" class="form-control" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Team Member Image</label>
                                        <input type="file" name="member_image" id="member_image" class="form-control" accept="image/x-png,image/gif,image/jpeg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="AddMember" class="btn btn-info pull-right">Add Member</button>
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
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/team/add_new_member.blade.php ENDPATH**/ ?>