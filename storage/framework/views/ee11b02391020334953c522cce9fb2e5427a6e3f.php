<?php $__env->startSection('content'); ?>

<section class="search_inside">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 m-auto">
                <div class="searchbox p-0">
                    <ul class="nav d-flex justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="tabnav active" id="buy-tab" data-toggle="tab" href="#buy" role="tab"
                                aria-controls="buy" aria-selected="true">BUY</a>
                        </li>
                        <li class="nav-item">
                            <a class="tabnav" id="rent-tab" data-toggle="tab" href="#rent" role="tab"
                                aria-controls="rent" aria-selected="false">Rent</a>
                        </li>
                        <li class="nav-item">
                            <a class="tabnav" id="off-plan-tab" data-toggle="tab" href="#offPlan" role="tab"
                                aria-controls="off-plan" aria-selected="false">OFF PLAN</a>
                        </li>
                    </ul>
                    <div class="tab-content searchbg" id="myTabContent">
                    <div class="tab-pane fade show active" id="buy" role="tabpanel" aria-labelledby="buy-tab">
                        <form action="<?php echo e(url('/search-result')); ?>" method="post">
                            <div class="search_input">
                                <input type="hidden" value="1" name="property_type">
                                <?php // $i = 0;?>
                                <!-- foreach($location_data as $key =>$loc) -->
                                <?php
                                    
                                    //     if($loc->sub_community != null){
                                    //         $a[$loc->id] = $loc->sub_community.','.$loc->community.','.$loc->city;
                                    //     }else{
                                    //         if($loc->community != null){
                                    //             $a[$loc->id] = $loc->community.','.$loc->city;
                                    //         }else{
                                    //             $a[$loc->id] = $loc->city;
                                    //         }
                                    //     }
                                   
                                    // $i++;
                                ?>
                                <!-- endforeach -->
                                <?php // $a = array_unique($a); 
                               // asort($a);
                                ?>
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body" data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                <!-- foreach($a as $key => $p) -->
                                    <option id="city_search" value='<?php // $key ?>'><?php // $p ?></li>
                                <!-- endforeach -->
                                </select>
                                <button type="submit"><i class="icon ion-md-search"></i></button>
                            </div>
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                    <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
                        <form action="<?php echo e(url('/search-result')); ?>" method="post">
                            <div class="search_input">
                                <input type="hidden" value="2" name="property_type">
                                <?php // $i = 0;?>
                                <!-- foreach($location_data as $key =>$loc) -->
                                <?php
                                    
                                    //     if($loc->sub_community != null){
                                    //         $a[$loc->id] = $loc->sub_community.','.$loc->community.','.$loc->city;
                                    //     }else{
                                    //         if($loc->community != null){
                                    //             $a[$loc->id] = $loc->community.','.$loc->city;
                                    //         }else{
                                    //             $a[$loc->id] = $loc->city;
                                    //         }
                                    //     }
                                   
                                    // $i++;
                                ?>
                                <!-- endforeach -->
                                <?php // $a = array_unique($a); 
                               // asort($a);
                                ?>
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body" data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                <!-- foreach($a as $key => $p) -->
                                    <option id="city_search" value='<?php // $key ?>'><?php // $p ?></li>
                                <!-- endforeach -->
                                </select>
                                <button type="submit"><i class="icon ion-md-search"></i></button>
                            </div>
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                        <div class="tab-pane fade" id="offPlan" role="tabpanel" aria-labelledby="off-plan-tab">
                            <form action="<?php echo e(url('/search-result')); ?>" method="post">
                                <div class="search_input">
                                    <input type="hidden" value="3" name="property_type">
                                    <select class="selectpicker form-control" name="search_text" id="number" data-container="body" data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                    <?php $__currentLoopData = \App\City::where('country_id', 231)->orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option id="city_search" value='<?=$p['id']?>'><?=$p['name']?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <button type="submit"><i class="icon ion-md-search"></i></button>
                                </div>
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </div>
                        <div id="searchlist"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="smart_container">
    <section class="pt-1 pb-1">
        <div class="breadcrumb_sec">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom_breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/properties')); ?>">Properties</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($property->pro_title); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="pt-1">
        <div class="container">
            <?php if(Session::has('flash_message_success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong><?php echo session('flash_message_success'); ?></strong>
                </div>
            <?php endif; ?>
            <div class="details_headding">
                <div class="row">
                    <div class="col-md-7">
                        <h5><?php echo e($property->pro_title); ?></h5>
                        <p><?php echo e($property->pro_title); ?></p>
                    </div>
                    <div class="col-md-5">
                        <div class="share_query">
                            <div class="callquery">
                                <a href="mailto:manjeet.singh@magicgroupinc.com"><img src="<?php echo e(url('/images/frontend/images/mail.svg')); ?>"></a>
                                <a href="#"><img src="<?php echo e(url('/images/frontend/images/wp.svg')); ?>"></a>
                                <a href="tel:+97101234567"><img src="<?php echo e(url('/images/frontend/images/call.svg')); ?>"></a>
                            </div>
                            <a href="#" class="enquirebtn" data-toggle="modal" data-target="#getQuerymodal"><i
                                    class="fa fa-info"></i>Enquire Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo">
                <div class="item">
                    <div class="clearfix">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            <?php if(!empty($property->images_flink)): ?>
                            <?php $__currentLoopData = explode(',',$property->images_flink); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="text-align: center;background:#f8f8f8;" height="100" width="200"
                                data-thumb="<?php echo e($pim); ?>">
                                <img height="450" src="<?php echo e($pim); ?>" />
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prop_detailsinfo">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="prop_table <?php if($property->offering_type == 'off_plan'): ?> d-none <?php endif; ?>">
                        <h5>FACTS</h5>
                        <table class="table-responsive table table-bordered ">
                            <tbody>
                                <tr>
                                    <td scope="row">Price</td>
                                    <td><?php if($property->offering_type == 'rent'): ?>
                                        AED <?php echo e($property->price_value); ?> <?php if(!empty($property->price_period)): ?> <?php echo e($property->price_period); ?> <?php else: ?> /year <?php endif; ?>
                                        <?php elseif($property->offering_type == 'sale'): ?> 
                                        AED <?php echo e($property->price_value); ?>

                                        <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Type</td>
                                    <td><?php if(!empty($property->t_name)): ?><?php echo e($property->t_name); ?><?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Reference Code</td>
                                    <td><?php if(!empty($property->reference)): ?><?php echo e($property->reference); ?><?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Bedrooms</td>
                                    <td><?php if(!empty($property->bedrooms)): ?><?php echo e($property->bedrooms); ?><?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Bathrooms</td>
                                    <td><?php if(!empty($property->bathrooms)): ?><?php echo e($property->bathrooms); ?><?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Parkings</td>
                                    <td><?php if(!empty($property->parking)): ?><?php echo e($property->parking); ?><?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Furnished</td>
                                    <td><?php if($property->furnished): ?> <?php echo e($property->furnished); ?> <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Area</td>
                                    <td><?php if(!empty($property->size)): ?><?php echo e($property->size); ?> sqft. <?php endif; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prop_table <?php if($property->offering_type == 'off_plan'): ?> d-none <?php endif; ?>">
                        <h5>AMENITIES</h5>
                        <div class="amenties">
                            <ul>
                            <?php if(!empty($property->amenities_name)): ?>
                            <?php $__currentLoopData = explode(',', $property->amenities_name); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenities_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($amenities_name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h5>DESCRIPTION</h5>
            <p><?php echo nl2br($property->pro_description); ?></p>
        </div>
    </section>

    

</div>

<!-- Modal Enquire -->
<div class="modal fade" id="getQuerymodal" tabindex="-1" role="dialog" aria-labelledby="getQuerymodalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getQuerymodalTitle">Enquire Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="enquiry_form" id="EnquiryForm"
                    action="<?php echo e(url('/properties/'.$property->reference)); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Full Name">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                placeholder="Full Name">
                                <span id="error_name"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Phone Number">Contact Number</label>
                            <input type="tel" class="form-control" name="phone" id="enq_phoneno" placeholder="Phone no.">
                            <span id="error_phone"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email Address">Email</label>
                        <input type="email" class="form-control" name="email" id="enq_email" placeholder="Email Address">
                        <span id="error_email"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="prop_name" id="prop_name"
                            value="<?php echo e($property->pro_title); ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="prop_url" id="prop_url"
                            value="<?php echo e(url('/properties/'.$property->reference)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="Enquiry Details">Enquery Details</label>
                        <textarea class="form-control" id="enquiry_message" name="enquiry_message" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="EnquiryForm" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Enquire End -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\rapid\resources\views/frontend/property/single_property.blade.php ENDPATH**/ ?>