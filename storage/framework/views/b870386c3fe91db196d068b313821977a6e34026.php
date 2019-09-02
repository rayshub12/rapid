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
                                    <input type="search" name="search_text" id="search_name" class="search_location"
                                        placeholder="Type Location or Project/Society or Keyword">
                                    <button type="submit"><i class="icon ion-md-search"></i></button>
                                </div>
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
                            <form action="<?php echo e(url('/search-result')); ?>" method="post">
                                <div class="search_input">
                                    <input type="hidden" value="2" name="property_type">
                                    <input type="search" name="search_text" id="search_name" class="search_location"
                                        placeholder="Type Location or Project/Society or Keyword">
                                    <button type="submit"><i class="icon ion-md-search"></i></button>
                                </div>
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="offPlan" role="tabpanel" aria-labelledby="off-plan-tab">
                            <form action="<?php echo e(url('/search-result')); ?>" method="post">
                                <div class="search_input">
                                    <input type="hidden" value="3" name="property_type">
                                    <input type="search" name="search_text" id="search_name" class="search_location"
                                        placeholder="Type Location or Project/Society or Keyword">
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
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($property->name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="pt-1">
        <div class="container">
            <div class="details_headding">
                <div class="row">
                    <div class="col-md-7">
                        <h5><?php echo e($property->name); ?></h5>
                        <p><?php echo e($property->name); ?></p>
                    </div>
                    <div class="col-md-5">
                        <div class="share_query">
                            <div class="callquery">
                                <a href="mailto:manjeet.singh@magicgroupinc.com"><img
                                        src="<?php echo e(url('/images/frontend/images/mail.svg')); ?>"></a>
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
                            <?php if(!empty($property->images[0]->thumb->link)): ?>
                            <?php $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="text-align: center;background:#f8f8f8;" height="100" width="200"
                                data-thumb="<?php echo e($pim->medium->link); ?>">
                                <img height="450" src="<?php echo e($pim->full->link); ?>" />
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <?php $__currentLoopData = \App\PropertyImage::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="text-align: center;background: #f8f8f8;"
                                data-thumb="<?php echo e(url('/images/frontend/property_images/large/'.$pim->image_name)); ?>">
                                <img src="<?php echo e(url('/images/frontend/property_images/large/'.$pim->image_name)); ?>" />
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
            <p><?php echo $property->description; ?></p>
        </div>
    </section>

    
    <section class="property_sec">
        <div class="container">
            <h3 class="mb-3">More available in <?php echo e($property->state_name); ?> </h3>
            <div class="row">
                <?php $counter = 0; ?>
                <?php $__currentLoopData = $property_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($prel->location->city == $property->state_name): ?>
                <?php $counter++; ?>
                <?php if($counter <= 4): ?> <div class="col-md-3">
                    <div class="probox">
                        <a href="<?php echo e(url('/properties/'.$prel->id)); ?>">
                            <span
                                class="tag_top <?php if($prel->price->offering_type == 'rent'): ?> rent <?php elseif($prel->price->offering_type == 'sale'): ?> sell <?php endif; ?>">
                                <?php echo e($prel->price->offering_type); ?></span>
                            <div class="pro_img">
                                <img height="190" src="<?php echo e($prel->images[0]->medium->link); ?>">
                            </div>
                            <div class="pro_con">
                                <h5><?php echo e(str_limit($prel->location->community, $limit=13)); ?>, <?php echo e($prel->location->city); ?>

                                </h5>
                                <a class="badge badge-warning badge-sm"
                                    href="<?php echo e(url('/properties/'.$prel->type->name)); ?>">
                                    <?php echo e($prel->type->name); ?>

                                </a>
                                <p><?php echo e($prel->languages[0]->title); ?></p>
                                <h6><?php if($prel->price->offering_type == 'rent'): ?>AED <?php echo e($prel->price->prices[0]->value); ?>

                                    <span>/<?php echo e($prel->price->prices[0]->period); ?></span><?php elseif($prel->price->offering_type
                                    == 'sale'): ?> AED <?php echo e($prel->price->value); ?> <?php endif; ?></h6>
                                <ul>
                                    <?php if(!empty($prel->bedrooms)): ?><li><img
                                            src="<?php echo e(url('images/frontend/images/bedroom.svg')); ?>"><?php echo e($prel->bedrooms); ?>

                                    </li><?php endif; ?>
                                    <?php if(!empty($prel->bathrooms)): ?><li><img
                                            src="<?php echo e(url('images/frontend/images/bathroom.svg')); ?>"><?php echo e($prel->bathrooms); ?>

                                    </li><?php endif; ?>
                                </ul>
                            </div>
                        </a>
                    </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
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
                    action="<?php echo e(url('/properties/'.$property->id)); ?>">
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
                            <input type="tel" class="form-control" name="phone" id="enq_phoneno"
                                placeholder="Phone no.">
                            <span id="error_phone"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email Address">Email</label>
                        <input type="email" class="form-control" name="email" id="enq_email"
                            placeholder="Email Address">
                        <span id="error_email"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="prop_name" id="prop_name"
                            value="<?php echo e($property->name); ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="prop_url" id="prop_url"
                            value="<?php echo e(url('/properties/'.$property->id)); ?>">
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
<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\rapid deals\server code\resources\views/frontend/property/single_offPlanProperty.blade.php ENDPATH**/ ?>