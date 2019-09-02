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
                        <form enctype="multipart/form-data" method="post" action="<?php echo e(url('/admin/property/'.$property->id.'/edit')); ?>"
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
                                                    class="form-control" value="<?php echo e($property->name); ?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label for="Url">Url</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Url</span>
                                                    <input type="text" name="slug" id="slug" class="form-control" value="<?php echo e($property->url); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label for="Property For">Property For</label>
                                                <select name="property_for" id="property_for"
                                                    class="form-control select2" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option value="" selected>Properties</option>
                                                    <option value="1" <?php if($property->property_for == 1): ?> selected <?php endif; ?>>Buy</option>
                                                    <option value="2" <?php if($property->property_for == 2): ?> selected <?php endif; ?>>Rent</option>
                                                    <option value="3" <?php if($property->property_for == 3): ?> selected <?php endif; ?>>Off Plan</option>
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
                                                    <option value="<?php echo e($ptype->type_code); ?>" <?php if($property->property_type == $ptype->type_code): ?> selected <?php endif; ?>>
                                                        <?php echo e($ptype->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-4 hidden">
                                            <div class="form-group">
                                                <label name="Property Code">Property Code</label>
                                                <div class="input-group">
                                                    <input name="property_code" id="property_code" type="text"
                                                        value="<?php echo e($property->property_code); ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label name="Property Price">Property Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><strong>AED</strong></span>
                                                    <input name="property_price" id="property_price" type="text"
                                                        class="form-control" value="<?php echo e($property->property_price); ?>">
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
                                                    class="form-control my-editor"><?php echo e($property->description); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="feature" id="feature"
                                                        class="flat-green" <?php if($property->featured == 1): ?> checked <?php endif; ?> value="1"> Featured <small
                                                        class="text-purple pl-1">( If you check this set Featured
                                                        Property )</small>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="commercial" id="commercial"
                                                        class="flat-green" <?php if($property->commercial == 1): ?> checked <?php endif; ?> value="1"> Commercial <small
                                                        class="text-purple pl-1">( If you check this set Commercial
                                                        Property )</small>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label name="Property Area">Property Area (in sq. ft)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">sq/ft</span>
                                                    <input name="property_area" id="property_area" type="text"
                                                        class="form-control" value="<?php echo e($property->property_area); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Property Facing">Property Facing</label>
                                                <select name="property_facing" id="property_facing"
                                                    class="form-control">
                                                    <option value="" selected>Select Property Facing</option>
                                                    <option value="East" <?php if($property->property_facing == 'East'): ?> selected <?php endif; ?>>East Facing</option>
                                                    <option value="West" <?php if($property->property_facing == 'West'): ?> selected <?php endif; ?>>West Facing</option>
                                                    <option value="North" <?php if($property->property_facing == 'North'): ?> selected <?php endif; ?>>North Facing</option>
                                                    <option value="South" <?php if($property->property_facing == 'South'): ?> selected <?php endif; ?>>South Facing</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="FurnishStatus" class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Furnish Type">Furnish Type</label>
                                                <select name="furnish_type" id="furnish_type" class="form-control">
                                                    <option value="" selected>Select Furnish Type</option>
                                                    <option value="F" <?php if($property->furnish_type == 'F'): ?> selected <?php endif; ?>>Fully Furnished</option>
                                                    <option value="S" <?php if($property->furnish_type == 'S'): ?> selected <?php endif; ?>>Semi Furnished</option>
                                                    <option value="U" <?php if($property->furnish_type == 'U'): ?> selected <?php endif; ?>>Unfurnished</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label for="Transection Type">Transaction Type</label>
                                                <select name="transection_type" id="transection_type"
                                                    class="form-control">
                                                    <option value="" selected>Select Transaction Type</option>
                                                    <option value="New Booking" <?php if($property->transection_type == 'New Booking'): ?> selected <?php endif; ?>>New Booking</option>
                                                    <option value="Resale" <?php if($property->transection_type == 'Resale'): ?> selected <?php endif; ?>>Resale</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label>Construction Status</label>
                                                <select name="construction_status" id="construction_status"
                                                    class="form-control">
                                                    <option value="" selected>Select Construction Status</option>
                                                    <option value="UC" <?php if($property->construction_status == 'UC'): ?> selected <?php endif; ?>>Under Construction</option>
                                                    <option value="RM" <?php if($property->construction_status == 'RM'): ?> selected <?php endif; ?>>Ready to Move</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Rooms" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Apple Trees">Rooms</label>
                                                <select name="rooms" id="rooms" class="form-control">
                                                    <option value="" selected>Select Rooms</option>
                                                    <?php for($i=1; $i<1000; $i++) { ?>
                                                    <option <?php if($property->rooms == $i): ?> selected <?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Bedrooms" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Bedrooms">Bedrooms</label>
                                                <select name="bedrooms" id="bedrooms" class="form-control">
                                                    <option value="" selected>Select Bedrooms</option>
                                                    <?php for($i=1; $i<250; $i++) { ?>
                                                    <option <?php if($property->bedrooms == $i): ?> selected <?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                                                    <option <?php if($property->bathrooms == $i): ?> selected <?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                                                    <option <?php if($property->parking == $i): ?> selected <?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="PWashroom" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Personal Washroom">Personal Washroom</label>
                                                <select name="p_washroom" id="p_washroom" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <option value="1" <?php if($property->p_washrooms == 1): ?> selected <?php endif; ?>>Yes</option>
                                                    <option value="0" <?php if($property->p_washrooms == 0): ?> selected <?php endif; ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Cafeteria" class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Cafeteria">Pantry/Cafeteria</label>
                                                <select name="cafeteria" id="cafeteria" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <option value="1" <?php if($property->cafeteria == 1): ?> selected <?php endif; ?>>Yes</option>
                                                    <option value="0" <?php if($property->cafeteria == 0): ?> selected <?php endif; ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="Property Age">Property Age</label>
                                                <select name="property_age" id="property_age" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <?php for($i=1; $i<100; $i++) { ?>
                                                    <option <?php if($property->property_age == $i): ?> selected <?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="property_address col-sm-12 col-md-12">
                                        <div class="property_heading col-xs-12 col-md-12">
                                            <h4><strong>Property Address</strong></h4>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Property Address">Property Address 1</label>
                                                <textarea name="property_address1" id="property_address1"
                                                    class="form-control" rows="3"
                                                    placeholder="Address Line 1"><?php echo e($property->addressline1); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Property Address">Property Address 2</label>
                                                <textarea name="property_address2" id="property_address2"
                                                    class="form-control" rows="3"
                                                    placeholder="Address Line 2"><?php echo e($property->addressline2); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Unit no.">Unit no.</label>
                                                <input name="unit_no" id="unit_no" type="text"
                                                    class="form-control block-level" value="<?php echo e($property->unitno); ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Locality">Locality</label>
                                                <input type="text" name="locality" id="locality" class="form-control" value="<?php echo e($property->locality); ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Country">Country</label>
                                                <select name="country" id="country" class="form-control"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <?php $__currentLoopData = $countrylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($c->iso2); ?>"><?php echo e($c->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="State">State</label>
                                                <select class="form-control select2 select2-hidden-accessible"
                                                    name="state" id="state_edit" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option value="" selected>Select State</option>
                                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($s->id); ?>" <?php if($s->id == $property->state): ?> selected <?php endif; ?>><?php echo e($s->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="City">City</label>
                                                <select class="form-control select2 select2-hidden-accessible"
                                                    name="city" id="city_edit" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true">
                                                    <!-- <option value="" selected>Select City</option> -->
                                                    <?php echo $city_dropdown; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="p_id" value="<?php echo e($property->id); ?>">

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="Zipcode/Postal Code">Zipcode/Postal Code</label>
                                                <input name="zipcode" id="zipcode" type="text" class="form-control" value="<?php echo e($property->postalcode); ?>">
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
                                            <input type="hidden" name="current_image1[]" multiple id="image" value="<?php echo e($propImages->image_name); ?>">           
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
                                                        class="flat-green" value="<?php echo e($a->amenity_code); ?>" <?php $__currentLoopData = explode(',', $property->amenities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $am): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($a->amenity_code == $am): ?> checked <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> <?php echo e($a->name); ?>

                                                </label>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="box-footer">
                                            <input type="submit" class="btn btn-success btn-md btn-block"
                                                value="Update Property">
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