<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/post/add')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Posts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Posts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php if(!empty($p->post_image)): ?><img
                                            src="<?php echo e(url('/images/frontend/post_images/large/'.$p->post_image)); ?>"
                                            width="100" alt="<?php echo e($p->title); ?>"><?php endif; ?></td>
                                    <td><a target="_blank" href="<?php echo e(url('/blog/'.$p->url)); ?>"><strong><?php echo e($p->title); ?></strong></a></td>
                                    <td><?php if(!empty($p->post_cat)): ?><?php $__currentLoopData = \App\PostCategory::where('id', $p->post_cat)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($pcat->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></td>
                                    <td><?php echo e(date('d M, Y', strtotime($p->created_at))); ?></td>
                                    <td>
                                        <div id="donate">

                                            <?php if($p->status == 1): ?>
                                            <a href="<?php echo e(url('/admin/post/draft/'.$p->id)); ?>" title="Publish"
                                                class="label label-success label-sm">Publish</a>
                                            <?php else: ?>
                                            <a href="<?php echo e(url('/admin/post/publish/'.$p->id)); ?>" title="Draft"
                                                class="label label-danger label-sm">Draft</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('/admin/post/'.$p->id.'/edit')); ?>" class="label label-warning label-lg"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo e(url('/admin/post/'.$p->id.'/delete')); ?>" class="label label-danger label-lg"><i class="fa fa-trash"></i></a>
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
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/posts/posts_all.blade.php ENDPATH**/ ?>