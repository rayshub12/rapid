<?php $__env->startSection('content'); ?>

<?php
 
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
?>

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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Property</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Property</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-purple">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="post" action="<?php echo e(url('/admin/property/'.$property->reference.'/edit')); ?>"
                            name="edit_property" id="edit_property" novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-sm-12 col-md-9">
                                <div class="row">
                                    <div class="property_basic col-sm-12 col-md-12">
                                        <div class="property_heading col-xs-12 col-md-12">
                                            <h4><strong>Property Basic Details</strong></h4>
                                        </div>

                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label for="Property Name">Property Name</label>
                                                <input type="text" name="property_name" id="property_name"
                                                    class="form-control" value="<?php echo e($property->pro_title); ?>">
                                            </div>
                                        </div>
                                        <!-- <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label for="Url">Url</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Url</span>
                                                    <input type="text" name="slug" id="slug" class="form-control">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label for="Property For">Property For</label>
                                                <select name="property_for" id="property_for"
                                                    class="form-control select2" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option value="" selected>Properties</option>
                                                    <option value="sale" <?php if($property->offering_type == 'sale'): ?> selected <?php endif; ?>>Buy</option>
                                                    <option value="rent" <?php if($property->offering_type == 'rent'): ?> selected <?php endif; ?>>Rent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label for="Project Status">Project Status</label>
                                                <select name="project_status" id="project_status"
                                                    class="form-control select2" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option value="" selected>Select Project Status</option>
                                                    <option value="off_plan" <?php if($property->project_status == 'off_plan'): ?> selected <?php endif; ?>>Off Plan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label for="Property Type">Property Type</label>
                                                <select name="property_type" id="PropertyType" class="form-control"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="" selected>Select Property Type</option>
                                                    <?php $__currentLoopData = $propertytype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ptype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($ptype->name); ?>" <?php if($property->t_name == $ptype->name): ?> selected <?php endif; ?>>
                                                        <?php echo e($ptype->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label name="Property Price">Property Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><strong>AED</strong></span>
                                                    <input name="property_price" id="property_price" type="text"
                                                        class="form-control" value="<?php echo e($property->price_value); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="PropertyInfo" class="property_info col-sm-12 col-md-12">
                                        <div class="property_heading col-xs-12 col-md-12">
                                            <h4><strong>Property Information</strong></h4>
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label for="Description">Description</label>
                                                <textarea name="description" id="description"
                                                    class="form-control my-editor"><?php echo e($property->pro_description); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label name="Property Area">Property Area (in sq. ft)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">sq/ft</span>
                                                    <input name="property_area" id="property_area" type="text"
                                                        class="form-control" value="<?php echo e($property->size); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Property Facing">Property Category</label>
                                                <select name="property_category" id="property_category"
                                                    class="form-control">
                                                    <option value="" selected>Select Property Category</option>
                                                    <option value="residential" <?php if($property->t_category == 'residential'): ?> selected <?php endif; ?>>Residential</option>
                                                    <option value="commercial" <?php if($property->t_category == 'commercial'): ?> selected <?php endif; ?>>Commercial</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="FurnishStatus" class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Furnish Type">Furnish Type</label>
                                                <select name="furnish_type" id="furnish_type" class="form-control">
                                                    <option value="" selected>Select Furnish Type</option>
                                                    <option value="furnished" <?php if($property->furnished == 'furnished'): ?> selected <?php endif; ?>>Fully Furnished</option>
                                                    <option value="semi-furnished" <?php if($property->furnished == 'semi-furnished'): ?> selected <?php endif; ?>>Semi Furnished</option>
                                                    <option value="unfurnished" <?php if($property->furnished == 'unfurnished'): ?> selected <?php endif; ?>>Unfurnished</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Transection Type">Occupancy</label>
                                                <select name="occupancy" id="transection_type"
                                                    class="form-control">
                                                    <option value="" selected>Select Occupancy Type</option>
                                                    <option value="Vacant" <?php if($property->occupancy == 'Vacant'): ?> selected <?php endif; ?>>Vacant</option>
                                                    <option value="Booked" <?php if($property->occupancy == 'Booked'): ?> selected <?php endif; ?>>Booked</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label>Availability</label>
                                                <select name="availability" id="construction_status"
                                                    class="form-control">
                                                    <option value="" selected>Select Availability</option>
                                                    <option value="available" <?php if($property->status == 'available'): ?> selected <?php endif; ?>>Available</option>
                                                    <option value="under_offer" <?php if($property->status == 'under_offer'): ?> selected <?php endif; ?>>Under Offer</option>
                                                    <option value="reserved" <?php if($property->status == 'reserved'): ?> selected <?php endif; ?>>Reserved</option>
                                                    <option value="rented" <?php if($property->status == 'rented'): ?> selected <?php endif; ?>>Rented</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Bedrooms" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Bedrooms">Bedrooms</label>
                                                <select name="bedrooms" id="bedrooms" class="form-control">
                                                    <option value="" selected>Select Bedrooms</option>
                                                    <?php for($i=1; $i<250; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if($property->bedrooms ==  $i): ?> selected <?php endif; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Bathrooms" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Bathrooms">Bathrooms</label>
                                                <select name="bathrooms" id="bathrooms" class="form-control">
                                                    <option value="" selected>Select Bathrooms</option>
                                                    <?php for($i=1; $i<150; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if($property->bathrooms ==  $i): ?> selected <?php endif; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Parkings" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Parkings">Parkings</label>
                                                <select name="parking" id="parking" class="form-control">
                                                    <option value="" selected>Select Parking</option>
                                                    <?php for($i=1; $i<10; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if($property->parking ==  $i): ?> selected <?php endif; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="PDeveloper" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Property Developer">Property Developer</label>
                                                <input type="text" class="form-control" id="property_developer" name="property_developer" value="<?php echo e($property->developer); ?>">
                                            </div>
                                        </div>

                                        <div id="PropertyTenure" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Tenure of Property">Tenure of Property</label>
                                                <select name="property_tenure" id="property_tenure" class="form-control">
                                                    <option value="" selected>Select Property Tenure</option>
                                                    <option value="freehold" <?php if($property->freehold ==  'freehold'): ?> selected <?php endif; ?>>Freehold</option>
                                                    <option value="non-freehold" <?php if($property->freehold ==  'non-freehold'): ?> selected <?php endif; ?>>Non-Freehold</option>
                                                    <option value="leasehold" <?php if($property->freehold ==  'leasehold'): ?> selected <?php endif; ?>>Leasehold</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="FloorNo" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Floor Number">Floor Number</label>
                                                <input type="text" class="form-control" id="floor_number" name="floor_number" value="<?php echo e($property->floor_number); ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="RERA Listing Number">RERA Listing Number</label>
                                                <input type="text" name="rera_number" id="rera_number" class="form-control" value="<?php echo e($property->licenses_number); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="property_address col-sm-12 col-md-12">
                                        <div class="property_heading col-xs-12 col-md-12">
                                            <h4><strong>Property Address</strong></h4>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Street Number">Street Number</label>
                                                <input type="text" class="form-control" name="street_number" id="street_number" value="<?php echo e($property->street_number); ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Street Name">Street Name</label>
                                                <input type="text" name="street_name" id="street_name" class="form-control" value="<?php echo e($property->street_name); ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Unit no.">Unit no.</label>
                                                <input name="unit_no" id="unit_no" type="text"
                                                    class="form-control block-level" value="<?php echo e($property->unit_number); ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="State">Property Location</label>
                                                <select class="form-control select2 select2-hidden-accessible"
                                                    name="location_id" id="search_text" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true" data-placeholder="Tower, Community...">
                                                    <option value="" selected>Select Location</option>
                                                    <?php $__currentLoopData = $location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($locate->l_id); ?>" <?php if($property->l_id ==  $locate->l_id): ?> selected <?php endif; ?>><?php if(!empty($locate->tower)): ?><?php echo e($locate->tower); ?>, <?php echo e($locate->sub_community); ?>, <?php echo e($locate->community); ?>, <?php echo e($locate->city); ?><?php elseif(!empty($locate->sub_community)): ?> <?php echo e($locate->sub_community); ?>, <?php echo e($locate->community); ?>, <?php echo e($locate->city); ?> <?php elseif(!empty($locate->community)): ?> <?php echo e($locate->community); ?>, <?php echo e($locate->city); ?> <?php endif; ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Rows -->
                                <div class="property_images col-sm-12 col-md-12">
                                    <div class="property_heading">
                                        <h4><strong>Property Images</strong></h4>
                                    </div>
                                    <div class="form-group">
                                        <?php $__currentLoopData = \App\PropertyImage::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propImages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($propImages->image_name)): ?>
                                        <div class="abcd">
                                            <input type="hidden" name="current_image[]" multiple id="image" value="<?php echo e($propImages->image_name); ?>">           
                                            <img src="<?php echo e(url('/images/frontend/property_images/large/'.$propImages->image_name)); ?>"> <a href="<?php echo e(url('/admin/property-image/'.$propImages->id.'/delete')); ?>"><i id="close" alt="delete" class="fa fa-close"></i></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="add_image">
                                            <input type="button" id="add_more" class="btn btn-info" value="add image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="property_images col-sm-12 col-md-12">
                                    <div class="property_heading">
                                        <h4><strong>Floor Plans Images</strong></h4>
                                    </div>
                                    <div class="form-group">
                                        <?php $__currentLoopData = \App\FloorImage::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propImages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($propImages->image_name)): ?>
                                        <div class="abcd">
                                            <input type="hidden" name="current_image1[]" multiple id="image" value="<?php echo e($propImages->image_name); ?>" accept="image/x-png,image/gif,image/jpeg" />           
                                            <img src="<?php echo e(url('/images/frontend/property_images/large/'.$propImages->image_name)); ?>"> <a href="<?php echo e(url('/admin/floor-plan-image/'.$propImages->id.'/delete')); ?>"><i id="close" alt="delete" class="fa fa-close"></i></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="add_image1">
                                            <input type="button" id="add_more1" class="btn btn-info" value="add image" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="row">
                                    <div class="property_basic col-sm-12 col-md-12">
                                        <div class="property_heading col-xs-12 col-md-12">
                                            <h4><strong>Property Amenities</strong></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group">
                                            <label>
                                                    <input type="checkbox" name="amenity[]" id="<?php echo preg_replace('/[^a-zA-Z0-9-]/','' ,strtolower($a->name)); ?>"
                                                        class="flat-green" value="<?php echo e($a->name); ?>" <?php $__currentLoopData = explode(',', $property->amenities_name); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $am): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($a->name == $am): ?> checked <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> <?php echo e($a->name); ?>

                                                </label>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="box-footer">
                                            <input type="submit" class="btn btn-success btn-md btn-block"
                                                value="Submit Property">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/admin/property/edit_property.blade.php ENDPATH**/ ?>