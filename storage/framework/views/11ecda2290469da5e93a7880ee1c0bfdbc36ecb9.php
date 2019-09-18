<?php $__env->startSection('content'); ?>

<div class="slider">
    <div class="search_sec">
        <div class="search_inn">
            <div class="search_header">
                <p>Click here to search property for buy, sell and rent.</p>
                <button id="showsearch"><img src="<?php echo e(asset('images/frontend/images/searchicon.svg')); ?>"></button>
            </div>
            <div class="searchbox" style="display: none;">
                <ul class="nav d-flex justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="tabnav active" id="buy-tab" data-toggle="tab" href="#buy" role="tab"
                            aria-controls="buy" aria-selected="true">BUY</a>
                    </li>
                    <li class="nav-item">
                        <a class="tabnav" id="rent-tab" data-toggle="tab" href="#rent" role="tab" aria-controls="rent"
                            aria-selected="false">Rent</a>
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
                                <select class="form-control sel" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Select a number" data-hide-disabled="true">
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
                                <select class="form-control sel" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Select a number" data-hide-disabled="true">
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
                                <select class="selectpicker form-control" name="search_text" id="number"
                                    data-container="body" data-live-search="true" title="Type your location to search"
                                    data-hide-disabled="true">
                                    <?php $__currentLoopData = \App\City::where('country_id', 231)->orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key
                                    => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option id="city_search" value='<?=$p['id']?>'><?=$p['name']?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button type="submit"><i class="icon ion-md-search"></i></button>
                            </div>
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                    <div id="searchlist">
                    </div>
                </div>
                <button id="hidesearch"><i class="icon ion-md-close"></i></button>
            </div>
        </div>
    </div>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators custom_indicator">
            <?php $__currentLoopData = \App\Banner::where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li data-target="#carouselExampleFade" data-slide-to="<?php echo $key; ?>"
                class="<?php if($key == 0): ?>active <?php endif; ?>"></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>

        <div class="carousel-inner">
            <?php $__currentLoopData = \App\Banner::where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?> <?php echo $key; ?>"
                style="background-image:url(<?php echo e(url('images/frontend/banner/large/'.$bim->image)); ?>);">
                <div class="carousel-caption custom_caption text-left">
                    <h1><a href="<?php echo e($bim->link); ?>" style="color: #fff;"><?php echo e($bim->title); ?></a></h1>
                    <p><?php echo e($bim->description); ?></p>
                </div>
                <span class="overlay"></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<div id="smart_container">

    <!-- Featured Property Section Starts -->
    <section class="property_sec">
        <div class="container">
            <div class="headding">
                <h1>Featured <span>Property</span></h1>
            </div>
            <!-- Featured Property for Buy Section Starts -->
            <div class="product-carousel owl-carousel owl-theme">
                <?php $counter = 0; ?>
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($p->offering_type == 'sale'): ?>
                <?php $counter++ ?>
                <?php if($counter <= 8): ?> <div class="item">
                    <div class="probox">
                        <a href="<?php echo e(url('/properties/'.$p->reference)); ?>">
                            <span
                                class="tag_top <?php if($p->offering_type == 'rent'): ?> Rent <?php elseif($p->offering_type == 'sale'): ?> buy <?php endif; ?>">
                                <?php if($p->offering_type == 'rent'): ?> Rent <?php elseif($p->offering_type == 'sale'): ?> Buy <?php endif; ?>
                            </span>
                            <div class="pro_img">
                                <?php if(!empty($p->images_mlink)): ?>
                                    <?php $__currentLoopData = explode(',',$p->images_mlink); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image_m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key == 0): ?>
                                        <img class="img-responsive" src="<?php echo e($image_m); ?>">
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0): ?>
                                <?php $__currentLoopData = \App\PropertyImage::where('property_id', $p->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img class="img-responsive" src="<?php echo e(url('images/frontend/property_images/large/'.$pim->image_name)); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <img src="<?php echo e(url('images/frontend/property_images/large/default.png')); ?>">
                            <?php endif; ?>
                            </div>
                            <div class="pro_con">
                                <h5><?php echo e($p->community); ?>, <?php echo e($p->city); ?></h5>
                                <?php if(!empty($p->offering_type)): ?>
                                <a class="badge badge-warning badge-sm" href="<?php echo e(url('properties/for/'.$p->offering_type.'/'.$p->t_name)); ?>"><?php echo e($p->t_name); ?></a>
                                <?php endif; ?>
                                <p><?php echo e($p->pro_title); ?></p>
                                <ul>
                                    <?php if(!empty($p->bedrooms)): ?><li><img
                                            src="<?php echo e(url('images/frontend/images/bedroom.svg')); ?>"><?php echo e($p->bedrooms); ?>

                                    </li><?php endif; ?>
                                    <?php if(!empty($p->bathrooms)): ?><li><img
                                            src="<?php echo e(url('images/frontend/images/bathroom.svg')); ?>"><?php echo e($p->bathrooms); ?>

                                    </li><?php endif; ?>
                                </ul>
                                <h6><?php if($p->offering_type == 'rent'): ?>
                                    <?php if(!empty($p->price_value)): ?>AED <?php echo e($p->price_value); ?> <span><?php if(!empty($p->price_period)): ?>/Year <?php else: ?> <?php echo e($p->price_period); ?> <?php endif; ?></span><?php endif; ?>
                                    <?php else: ?>
                                    <?php if(!empty($p->price_value)): ?>AED <?php echo e($p->price_value); ?><?php endif; ?>
                                    <?php endif; ?>
                                </h6>
                            </div>
                        </a>
                    </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Featured Property for Rent Section Starts -->
        <div class="product-carousel owl-carousel owl-theme">
            <?php $counterf = 0; ?>
            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($p->offering_type == 'rent'): ?>
            <?php $counterf++ ?>
            <?php if($counterf <= 8): ?> <div class="item">
                <div class="probox">
                    <a href="<?php echo e(url('/properties/'.$p->reference)); ?>">
                        <span class="tag_top <?php if($p->offering_type == 'rent'): ?> rent <?php elseif($p->offering_type == 'sale'): ?> buy <?php endif; ?>">
                            <?php if($p->offering_type == 'rent'): ?> Rent <?php elseif($p->offering_type == 'sale'): ?> Buy <?php endif; ?>
                        </span>
                        <div class="pro_img">
                            <?php if(!empty($p->images_mlink)): ?>
                                <?php $__currentLoopData = explode(',',$p->images_mlink); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image_m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key == 0): ?>
                                    <img class="img-responsive" src="<?php echo e($image_m); ?>">
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0): ?>
                                <?php $__currentLoopData = \App\PropertyImage::where('property_id', $p->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img class="img-responsive" src="<?php echo e(url('images/frontend/property_images/large/'.$pim->image_name)); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <img src="<?php echo e(url('images/frontend/property_images/large/default.png')); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="pro_con">
                            <h5><?php echo e($p->community); ?>, <?php echo e($p->city); ?></h5>
                            <a class="badge badge-warning badge-sm" href="<?php echo e(url('properties/for/'.$p->offering_type.'/'.$p->t_name)); ?>"><?php echo e($p->t_name); ?></a>
                            <p><?php echo e($p->pro_title); ?></p>
                            <ul>
                                <?php if(!empty($p->bedrooms)): ?><li><img
                                        src="<?php echo e(url('images/frontend/images/bedroom.svg')); ?>"><?php echo e($p->bedrooms); ?>

                                </li><?php endif; ?>
                                <?php if(!empty($p->bathrooms)): ?><li><img
                                        src="<?php echo e(url('images/frontend/images/bathroom.svg')); ?>"><?php echo e($p->bathrooms); ?>

                                </li><?php endif; ?>
                            </ul>
                            <h6><?php if($p->offering_type == 'rent'): ?>
                                    <?php if(!empty($p->price_value)): ?>AED <?php echo e($p->price_value); ?> <span><?php if(!empty($p->price_period)): ?>/Year <?php else: ?> <?php echo e($p->price_period); ?> <?php endif; ?></span><?php endif; ?>
                                    <?php else: ?>
                                    <?php if(!empty($p->price_value)): ?>AED <?php echo e($p->price_value); ?><?php endif; ?>
                                    <?php endif; ?>
                            </h6>
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
<!-- /.Featured Property Section Ends -->


<!-- Property By State Starts -->
<section class="country_sec">
    <div class="d-sm-flex flex-row">
        <div class="flex-fill">
            <div class="countrybox">
                <span class="tag_top buy">
                    Off Plan
                </span>
                <a href="<?php echo e(url('/property/in/International City')); ?>">
                    <span class="count_overlay"></span>
                    <img src="<?php echo e(url('images/frontend/images/city1.jpg')); ?>">
                    <div class="count_txt">
                        <h2>International City</h2>
                        <p>Check out some of the latest and
                            best properties in International City.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex-fill">
            <div class="countrybox">
                <span class="tag_top buy">
                    Off Plan
                </span>
                <a href="<?php echo e(url('/property/in/Greens')); ?>">
                    <span class="count_overlay"></span>
                    <img src="<?php echo e(url('images/frontend/images/city2.jpg')); ?>">
                    <div class="count_txt">
                        <h2>Greens</h2>
                        <p>Check out some of the latest and
                            best properties in Greens.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex-fill">
            <div class="countrybox">
                <span class="tag_top buy">
                    Off Plan
                </span>
                <a href="<?php echo e(url('/property/in/Dubai Hills Estate')); ?>">
                    <span class="count_overlay"></span>
                    <img src="<?php echo e(url('images/frontend/images/city3.jpg')); ?>">
                    <div class="count_txt">
                        <h2>Dubai Hills Estate</h2>
                        <p>Check out some of the latest and
                            best properties in Dubai Hills Estate.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex-fill">
            <div class="countrybox">
                <span class="tag_top buy">
                    Off Plan
                </span>
                <a href="<?php echo e(url('/property/in/Jumeirah Lake Towers')); ?>">
                    <span class="count_overlay"></span>
                    <img src="<?php echo e(url('images/frontend/images/city4.jpg')); ?>">
                    <div class="count_txt">
                        <h2>Jumeirah Lake Towers</h2>
                        <p>Check out some of the latest and
                            best properties in Jumeirah Lake Towers.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- /.Property By State Ends -->



<!-- Blog Section Starts -->
<section class="blogsec">
    <div class="container">
        <div class="blog_headding mob">
            <h2>Form The <span>Blog</span></h2>
        </div>
        <div class="row">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="owl-carousel blog-carousel work-class1" id="work-class1">
                            <?php $__currentLoopData = \App\Post::orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <img src="<?php echo e(url('images/frontend/post_images/small/'.$pim->post_image)); ?>">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_headding web">
                            <h2>Form The <br /><span>Blog</span></h2>
                        </div>
                        <div class="owl-carousel work-class2" id="work-class2">
                            <?php $__currentLoopData = \App\Post::orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="blog_txt">
                                    <h6><?php echo e(date('M d, Y', strtotime($p->created_at))); ?></h6>
                                    <p><?php echo e($p->title); ?></p>
                                    <a href="<?php echo e(url('/blog/'.$p->url)); ?>">
                                        <h5>Read More <i class="icon ion-md-arrow-forward"></i></h5>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Blog Section Ends -->

<!-- Testtimonial Section Starts -->
<!-- <section class="testimonials_sec">
    <div class="container">
        <div class="headding">
            <h1>Testimonials</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="owl-carousel testimonial-slider">
                    <?php $__currentLoopData = \App\Testimonial::where('status', 1)->orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ttm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="testimonials_box">
                            <div class="user_testimonial">
                                <img src="<?php echo e(url('/images/frontend/testimonial_images/large/'.$ttm->user_image)); ?>">
                            </div>
                            <q>
                                <?php echo e($ttm->content); ?>

                            </q>
                            <p><?php echo e($ttm->user_name); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- /.Testimonial Section Ends -->

<!-- Subscribe Section Starts -->
<section class="subscribe_sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="subscribe_text">
                    <h1>Subscribe Now</h1>
                    <p>Subscribe to our newsletters and be the first to know about exclusive deals,
                        property price trends and real estate news in the UAE.</p>
                </div>
            </div>
            <div class="col-md-6">
                <?php if(Session::has('subscribe_message')): ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><?php echo session('subscribe_message'); ?></strong>
                </div>
                <?php endif; ?>
                <div class="subscribe_form">
                    <form method="post" name="subscribe_form" id="SubscribeForm" action="<?php echo e(url('/subscribe-now')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="email" name="email" placeholder="enter your email">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Subscribe Section Ends -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
// var myVar = setInterval(myTimer, 10000);
//     function myTimer() {
    // $(document).ready(function() {
    //     $.ajax({
    //         url:'https://api.mycrm.com/properties?filters[]&sort_order=desc',
    //         method: "GET",
    //         dataType: 'json',
    //         headers: {
    //             "Authorization": "Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f"
    //         }
    //     }).then(function(response) {
    //         var _token = $('input[name="_token"]').val();
    //         var a = [];
    //         var a = response.properties;
    //         var counter = response.count;
    //         var remander = counter % 100;
    //             if (remander > 0) {
    //                 var counter1 = Math.ceil(counter / 100);
    //             }else{
    //                 var counter1 = counter / 100;
    //             }
    //         var i;
    //         for(i = 1; i<=counter1 ; i++){
    //             $.ajax({
    //                 url: '/request_api',
    //                 method: "post",
    //                 dataType: 'html',
    //                 data:{
    //                     count:i,
    //                     _token:_token 
    //                 },
    //                 success:function(data){
    //                     console.log(data);
    //                 }
    //             });
    //         }
    //     }).catch(function(err) {
    //         console.error(err);
    //     });
    // });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.home_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\RapidDeals\resources\views/homepage.blade.php ENDPATH**/ ?>