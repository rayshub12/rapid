<?php $__env->startSection('content'); ?>

<style>
#filediv {
    display: inline-block !important;
}

#file {
    color: green;
    padding: 5px;
    border: 1px dashed #123456;
    background-color: #f9ffe5
}

#noerror {
    color: green;
    text-align: left
}

#error {
    color: red;
    text-align: left
}

#img {
    width: 17px;
    border: none;
    height: 17px;
    margin-left: 10px;
    cursor: pointer;
}

.abcd img {
    height: 100px;
    width: 100px;
    padding: 5px;
    border-radius: 10px;
    border: 1px solid #e8debd
}

#close {
    vertical-align: top;
    background-color: red;
    color: white;
    border-radius: 5px;
    padding: 4px;
    margin-left: -13px;
    margin-top: 1px;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Post</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" name="edit_post" id="edit_post" method="POST"
                        action="<?php echo e(url('/admin/page/'.$pages->id.'/update')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-xs-12 col-md-9">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Post Title</label>
                                            <input type="text" name="name" id="post_title" class="form-control"
                                                placeholder="Post Title" value="<?php echo e($pages->title); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Sub Title</label>
                                            <textarea name="sub_title" id="sub_title"
                                                class="form-control" cols="30" rows="3"><?php echo e($pages->sub_title); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><strong>Url</strong></span>
                                                <input type="text" name="url" id="post_url" class="form-control"
                                                placeholder="Post Url" value="<?php echo e($pages->url); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" id="cat_description"
                                                class="form-control my-editor" cols="30" rows="5"><?php echo e($pages->content); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        
                        <div class="col-xs-12 col-md-3">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="Post Image">Page Type</label>
                                            <select name="post_type" id="post_type" class="form-control">  
                                                <option value="1" selected>Statnderd</option>
                                                <option value="2">Video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="Template Type">Template</label>
                                            <select name="template_type" id="template_type" class="form-control">  
                                                <option value="1" <?php if($pages->template_type == '1'): ?> selected <?php endif; ?>>Statnderd</option>
                                                <option value="2" <?php if($pages->template_type == '2'): ?> selected <?php endif; ?>>Sidebar</option>
                                                <!-- <option value="2">Sidebar</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <input name="contact_form" id="form_1" type="checkbox" class="flat-green" value="1" <?php if($pages->contact_form == '1'): ?> checked <?php endif; ?>> Contact form &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="career_form" id="form_2" type="checkbox" class="flat-green" value="2" <?php if($pages->career_form == '1'): ?> checked <?php endif; ?>> Career form
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <input name="feature_post" id="feature_post" type="checkbox" class="flat-green" value="1"> Featured  <small class="text-purple pl-1">( If you check this set Featured Page )</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <input name="status" id="post_status" type="checkbox" class="flat-green" value="1"> Enable  <small class="text-purple pl-1">( If you check this, Page will bwe published)</small>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="Post Image">Featured Image</label>
                                            <input type="file" name="featured_image" id="featured_image" accept="image/x-png,image/gif,image/jpeg" />
                                        </div>
                                        <p><img width="200" src="<?php echo e(url('/images/frontend/page_images/large/'.$pages->page_image)); ?>" alt=""></p>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info btn-block">Publish</button>
                                    </div>
                                </div>
                            </div>
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
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/pages/edit_pages.blade.php ENDPATH**/ ?>