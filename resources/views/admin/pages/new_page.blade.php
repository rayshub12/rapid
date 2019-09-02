@extends('layouts.backend.admin_design')
@section('content')

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
        <h1>Add New Page</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" name="add_post" id="add_post" method="POST"
                        action="{{ url('/admin/new-pages') }}">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-md-9">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Page Title</label>
                                            <input type="text" name="name" id="post_title" class="form-control"
                                                placeholder="Page Title">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Sub Title</label>
                                            <textarea name="sub_title" id="sub_title"
                                                class="form-control" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><strong>Url</strong></span>
                                                <input type="text" name="url" id="post_url" class="form-control"
                                                placeholder="Page Url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label>Page Category</label>
                                            <select name="page_cat" id="post_cat" class="form-control">
                                                <!-- <option value="0">Main Category</option> -->
                                                <?php echo $page_category_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" id="cat_description"
                                                class="form-control my-editor" cols="30" rows="5"></textarea>
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
                                            <select name="page_type" id="post_type" class="form-control">  
                                                <option value="1" selected>Statnderd</option>
                                                <option value="2">Video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="Template Type">Template</label>
                                            <select name="template_type" id="template_type" class="form-control">  
                                                <option value="1">Statnderd</option>
                                                <option value="2" >Sidebar</option>
                                                <!-- <option value="2">Sidebar</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <input name="contact_form" id="form_1" type="checkbox" class="flat-green" value="1"> Contact form &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input name="career_form" id="form_2" type="checkbox" class="flat-green" value="2"> Career form
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
                                            <input type="file" name="featured_image" id="featured_image">
                                        </div>
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

@endsection