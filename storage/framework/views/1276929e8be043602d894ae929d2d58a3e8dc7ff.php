<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Post Category</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Category</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" name="add_category" id="add_category" method="POST"
                        action="<?php echo e(url('/admin/post_category/add')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="name" id="cat_name" class="form-control"
                                            placeholder="Category Name" value="<?php echo e($pcat->name); ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="text" name="url" id="cat_url" class="form-control"
                                            placeholder="Category Url" value="<?php echo e($pcat->url); ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select name="parent_cat" id="parent_cat" class="form-control">
                                            <!-- <option value="0">Main Category</option> -->
                                            <?php echo $post_category_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="cat_description" class="form-control" cols="30" rows="5" ><?php echo e($pcat->description); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Category Image</label>
                                        <input type="hidden" name="current_image" multiple id="image" value="<?php echo e($pcat->cat_image); ?>" accept="image/x-png,image/gif,image/jpeg" />
                                        <input type="file" name="cat_image" id="cat_image" class="form-control" accept="image/x-png,image/gif,image/jpeg" />
                                    </div>
                                    <p><img width="200" src="<?php echo e(url('/images/frontend/post_images/category/large/'.$pcat->cat_image)); ?>" alt=""></p>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
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
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/posts/edit_category.blade.php ENDPATH**/ ?>