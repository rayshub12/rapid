<?php $__env->startSection('content'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
#loading { 
    display:none; margin:3em auto; width:10%; height:10%;
       }
</style>  

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
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                <?php $__currentLoopData = \App\Property::select('l_id','city','community','sub_community','tower')->orderBy('l_id', 'asc')->where('community','!=','')->distinct()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option id="city_search" value="<?php echo e($p->l_id); ?>">
                                    <?php if(!empty($p->tower)): ?>
                                        <?php echo e($p->tower); ?>, <?php echo e($p->sub_community); ?>, <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                    
                                    <?php else: ?>
                                        <?php if(!empty($p->sub_community)): ?>
                                                <?php echo e($p->sub_community); ?>, <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                            <?php else: ?>
                                                <?php if(!empty($p->community)): ?>
                                                    <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                                <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                <?php $__currentLoopData = \App\Property::select('l_id','city','community','sub_community','tower')->orderBy('l_id', 'asc')->where('community','!=','')->distinct()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option id="city_search" value="<?php echo e($p->l_id); ?>">
                                    <?php if(!empty($p->tower)): ?>
                                        <?php echo e($p->tower); ?>, <?php echo e($p->sub_community); ?>, <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                    
                                    <?php else: ?>
                                        <?php if(!empty($p->sub_community)): ?>
                                                <?php echo e($p->sub_community); ?>, <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                            <?php else: ?>
                                                <?php if(!empty($p->community)): ?>
                                                    <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                                <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    <select class="selectpicker form-control" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                <?php $__currentLoopData = \App\Property::select('l_id','city','community','sub_community','tower')->orderBy('l_id', 'asc')->where('community','!=','')->distinct()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option id="city_search" value="<?php echo e($p->l_id); ?>">
                                    <?php if(!empty($p->tower)): ?>
                                        <?php echo e($p->tower); ?>, <?php echo e($p->sub_community); ?>, <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                    
                                    <?php else: ?>
                                        <?php if(!empty($p->sub_community)): ?>
                                                <?php echo e($p->sub_community); ?>, <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                            <?php else: ?>
                                                <?php if(!empty($p->community)): ?>
                                                    <?php echo e($p->community); ?>, <?php echo e($p->city); ?>

                                                <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </option>
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
    <div class="search_mainsec">
        <div class="properties_catlist">
            <div class="container">
                <div class="prop_inn">
                    <div class="protitle_box">
                        <?php if($properties): ?>
                            <h4>Properties
                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($p->offering_type == 'sale'): ?> for Sale
                                <?php elseif($p->offering_type == 'rent'): ?> for Rent
                                <?php endif; ?></h4>
                            <?php break; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <h2>In UAE</h2>
                        <?php endif; ?>
                    </div>
                    
                    <div class="proplistbox">
                        <ul>
                        <?php $__currentLoopData = $type_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <li>
                            <?php if($p->project_status == 'off_plan'): ?>
                            <a href="<?php echo e(url('/properties/for/'.$p->project_status.'/'.$tn->t_name)); ?>"><?php echo e($tn->t_name); ?> (<?php echo e(\App\Property::where('t_name', $tn->t_name)->where('project_status', 'off_plan')->count()); ?>)</a>
                            <?php else: ?>
                                <a href="<?php echo e(url('/properties/for/'.$p->offering_type.'/'.$tn->t_name)); ?>"><?php echo e($tn->t_name); ?> (<?php echo e(\App\Property::where('t_name', $tn->t_name)->where('offering_type', $p->offering_type)->count()); ?>)</a>
                            <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="property_sec" id="dta">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter_top">
                            <!--<span>Sort By:</span>-->
                            <!--<select name="allusers-table_length">-->
                            <!--    <option value="1">Latest</option>-->
                            <!--    <option value="2">Price: Low to High</option>-->
                            <!--    <option value="3">Price: High to Low</option>-->
                            <!--</select>-->
                            <strong id="pro"><?php echo $property_count; ?> results</strong>
                        </div>
                        <div id="loading">
                            <img src="/images/frontend/images/LoadingCircle_firstani.gif" /> 
                        </div>
                        <div class="property_list" id="pro">
                        
                            <?php if(count($properties) == 0): ?>
                            <div class="pro_con p-3">
                                <p style="text-align: center;"><img src="<?php echo e(url('/images/frontend/images/error.png')); ?>"
                                        alt=""></p>
                                <h5 style="text-align: center;">Sorry, no results found!</h5>
                                <h6 style="text-align: center;">Oh Snap! Zero Results found for your search.</h6>
                            </div>
                            <?php endif; ?>

                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="proplist">
                                <div class="proplist_img" style="text-align: center;">
                                    <?php if(!empty($p->images_mlink)): ?>
                                        <?php $__currentLoopData = explode(',',$p->images_mlink); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image_m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key == 0): ?>
                                            <img style="max-height:225px;" class="img-responsive" src="<?php echo e($image_m); ?>">
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0): ?>
                                        <?php $__currentLoopData = \App\PropertyImage::where('property_id', $p->id)->take(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img class="img-responsive" src="<?php echo e(url('images/frontend/property_images/large/'.$pim->image_name)); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <img src="<?php echo e(url('images/frontend/property_images/large/default.png')); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="proplist_item">
                                    <div class="pro_con">
                                        <label class="badge badge-warning"><?php echo e($p->t_name); ?></label> <?php if(!empty($p->project_status)): ?><label class="badge badge-info">Off Plan </label><?php endif; ?>
                                        <label class="badge badge-success"><?php if($p->offering_type == 'sale'): ?> Buy
                                            <?php elseif($p->offering_type == 'rent'): ?> Rent <?php elseif($p->offering_type == 'off-plan'): ?> Off Plan
                                            <?php endif; ?></label>
                                        <h5><?php echo e($p->community); ?>, <?php echo e($p->city); ?></h5>
                                        <p><?php echo e($p->pro_title); ?></p>
                                        <h6><?php if($p->offering_type == 2): ?>
                                            <?php if(!empty($p->price_value)): ?>AED <?php echo e($p->price_value); ?> <span>/Year</span><?php endif; ?>
                                            <?php else: ?>
                                            <?php if(!empty($p->price_value)): ?>AED <?php echo e($p->price_value); ?><?php endif; ?>
                                            <?php endif; ?></h6>
                                        <ul>
                                            <?php if(!empty($p->bedrooms)): ?><li>
                                                <img
                                                    src="<?php echo e(url('/images/frontend/images/bedroom.svg')); ?>"><?php echo e($p->bedrooms); ?>

                                            </li><?php endif; ?>
                                            <?php if(!empty($p->bedrooms)): ?><li>
                                                <img
                                                    src="<?php echo e(url('/images/frontend/images/bathroom.svg')); ?>"><?php echo e($p->bathrooms); ?>

                                            </li><?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="callquiery">
                                    <!--<p>Posted on <?php echo e(date('M d, Y', strtotime($p->created_at))); ?></p>-->
                                    <a href="<?php echo e(url('/properties/'.$p->reference)); ?>" class="readmore_btn">Read More</a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="product_loadding center">
                    <?php if( !empty($type)): ?>
                    <?php echo $properties->appends(array("property_type" => $type, "location_id" => $scityID ))->render(); ?>

                    <?php else: ?>
                        <?php echo $properties->render(); ?>

                    <?php endif; ?>
                    <!-- <img src="/images/frontend_images/images/loadder.svg"> -->
                </div>
            </div>
        </section>
    </div>
    <section class="nearby_sec pt-1 pb-1">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="nearby_txtbox">
                        <h4>Nearby</h4>
                        <h3>Areas</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="proplistbox nearby_item">
                        <ul>
                            <li><a href="<?php echo e(url('/property/in/International City')); ?>">Buy Properties in International City</a></li>
                            <li><a href="<?php echo e(url('/property/in/Greens')); ?>">Buy Properties in Greens</a></li>
                            <li><a href="<?php echo e(url('/property/in/Dubai Hills Estate')); ?>">Buy Properties in Dubai Hills Estate</a></li>
                            <li><a href="<?php echo e(url('/property/in/Jumeirah Lake Towers')); ?>">Buy Properties in Jumeirah Lake Towers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="<?php echo e(url('/images/frontend/images/dubai.png')); ?>">
                </div>
            </div>
        </div>
    </section>
</div>


<script>
// $(window).on('hashchange', function() {
//       if (window.location.hash) {
//           var page = window.location.hash.replace('#', '');
//           if (page == Number.NaN || page <= 0) {
//               return false;
//           } else {
//             filterSearch(page);
//           }
//       }
//   });

//   $(document).ready(function() {
//       $(document).on('click', '.pagination a', function (e) {
//           filterSearch($(this).attr('href').split('page=')[1]);
//           e.preventDefault();
//       });
//   });
$(document).ready(function() {
    $('select[name="allusers-table_length"]').change(function() {
        filterSearch();
    });
});

function filterSearch() {
    $('#pro').fadeOut(600);
    showLoading();
    var id = $('select[name="allusers-table_length"]').val();
    var url = $(location).attr('href'); 
    var filename = url.substring(url.lastIndexOf('/')+1);
    $.ajax({
        url: "/filter",
        method: "get",
        dataType: "html",
        data: {
            sort: id,
            id: filename
        },
        success:function(data){
       if(data != '') 
        {
            $('#pro').fadeIn(2000);
            $('#dta').html(data);
            // location.hash = page;
            hideLoading();
        }
        else
        {
          $('.product_loadding').html("No Data");
        }
    }
});
}
function getFilterData(className) {
    var filter = [];
    $('.' + className + ':checked').each(function() {
        filter.push($(this).val());
    });
    return filter;
}
function showLoading() {
    $("#loading").fadeIn(600);
}

function hideLoading() {
    $("#loading").fadeOut(600);
}
</script>
     
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/frontend/property/property_category.blade.php ENDPATH**/ ?>