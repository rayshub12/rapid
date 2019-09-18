@extends('layouts.frontend.home_design')
@section('content')

<div class="slider">
    <div class="search_sec">
        <div class="search_inn">
            <div class="search_header">
                <p>Click here to search property for buy, sell and rent.</p>
                <button id="showsearch"><img src="{{ asset('images/frontend/images/searchicon.svg') }}"></button>
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
                        <form action="{{ url('/search-result') }}" method="post">
                            <div class="search_input">
                                <input type="hidden" value="1" name="property_type">
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                @foreach(\App\Property::select('l_id','city','community','sub_community','tower')->orderBy('l_id', 'asc')->where('community','!=','')->distinct()->get() as $key => $p)
                                <option id="city_search" value="{{ $p->l_id }}">
                                    @if(!empty($p->tower))
                                        {{ $p->tower }}, {{ $p->sub_community }}, {{ $p->community }}, {{ $p->city}}
                                    
                                    @else
                                        @if(!empty($p->sub_community))
                                                {{ $p->sub_community }}, {{ $p->community }}, {{ $p->city}}
                                            @else
                                                @if(!empty($p->community))
                                                    {{ $p->community }}, {{ $p->city}}
                                                @endif
                                        @endif
                                    @endif
                                </option>
                                @endforeach
                                </select>
                                <button type="submit"><i class="icon ion-md-search"></i></button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
                        <form action="{{ url('/search-result') }}" method="post">
                            <div class="search_input">
                                <input type="hidden" value="2" name="property_type">
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                @foreach(\App\Property::select('l_id','city','community','sub_community','tower')->orderBy('l_id', 'asc')->where('community','!=','')->distinct()->get() as $key => $p)
                                <option id="city_search" value="{{ $p->l_id }}">
                                    @if(!empty($p->tower))
                                        {{ $p->tower }}, {{ $p->sub_community }}, {{ $p->community }}, {{ $p->city}}
                                    
                                    @else
                                        @if(!empty($p->sub_community))
                                                {{ $p->sub_community }}, {{ $p->community }}, {{ $p->city}}
                                            @else
                                                @if(!empty($p->community))
                                                    {{ $p->community }}, {{ $p->city}}
                                                @endif
                                        @endif
                                    @endif
                                </option>
                                @endforeach
                                </select>
                                <button type="submit"><i class="icon ion-md-search"></i></button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="tab-pane fade" id="offPlan" role="tabpanel" aria-labelledby="off-plan-tab">
                        <form action="{{ url('/search-result') }}" method="post">
                            <div class="search_input">
                                <input type="hidden" value="3" name="property_type">
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body"
                                    data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                @foreach(\App\Property::select('l_id','city','community','sub_community','tower')->orderBy('l_id', 'asc')->where('community','!=','')->distinct()->get() as $key => $p)
                                <option id="city_search" value="{{ $p->l_id }}">
                                    @if(!empty($p->tower))
                                        {{ $p->tower }}, {{ $p->sub_community }}, {{ $p->community }}, {{ $p->city}}
                                    
                                    @else
                                        @if(!empty($p->sub_community))
                                                {{ $p->sub_community }}, {{ $p->community }}, {{ $p->city}}
                                            @else
                                                @if(!empty($p->community))
                                                    {{ $p->community }}, {{ $p->city}}
                                                @endif
                                        @endif
                                    @endif
                                </option>
                                @endforeach
                                </select>
                                <button type="submit"><i class="icon ion-md-search"></i></button>
                            </div>
                            {{ csrf_field() }}
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
            @foreach(\App\Banner::where('status', '1')->get() as $key => $bim)
            <li data-target="#carouselExampleFade" data-slide-to="<?php echo $key; ?>"
                class="@if($key == 0)active @endif"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">
            @foreach(\App\Banner::where('status', '1')->get() as $key => $bim)
            <div class="carousel-item @if($key == 0) active @endif <?php echo $key; ?>"
                style="background-image:url({{ url('images/frontend/banner/large/'.$bim->image) }});">
                <div class="carousel-caption custom_caption text-left">
                    <h1><a href="{{ $bim->link }}" style="color: #fff;">{{ $bim->title }}</a></h1>
                    <p>{{ $bim->description }}</p>
                </div>
                <span class="overlay"></span>
            </div>
            @endforeach
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
                @foreach($properties as $p)
                @if($p->offering_type == 'sale')
                <?php $counter++ ?>
                @if($counter <= 8) <div class="item">
                    <div class="probox">
                        <a href="{{ url('/properties/'.$p->reference) }}">
                            <span
                                class="tag_top @if($p->offering_type == 'rent') Rent @elseif($p->offering_type == 'sale') buy @endif">
                                @if($p->offering_type == 'rent') Rent @elseif($p->offering_type == 'sale') Buy @endif
                            </span>
                            <div class="pro_img">
                                @if(!empty($p->images_mlink))
                                    @foreach(explode(',',$p->images_mlink) as $key => $image_m)
                                        @if($key == 0)
                                        <img class="img-responsive" src="{{ $image_m }}">
                                        @endif
                                    @endforeach
                                    @elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0)
                                @foreach(\App\PropertyImage::where('property_id', $p->id)->get() as $pim)
                                    <img class="img-responsive" src="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}">
                                @endforeach
                            @else
                            <img src="{{ url('images/frontend/property_images/large/default.png') }}">
                            @endif
                            </div>
                            <div class="pro_con">
                                <h5>{{ $p->community }}, {{ $p->city }}</h5>
                                @if(!empty($p->offering_type))
                                <a class="badge badge-warning badge-sm" href="{{ url('properties/for/'.$p->offering_type.'/'.$p->t_name) }}">{{ $p->t_name }}</a>
                                @endif
                                <p>{{ $p->pro_title }}</p>
                                <ul>
                                    @if(!empty($p->bedrooms))<li><img
                                            src="{{ url('images/frontend/images/bedroom.svg') }}">{{ $p->bedrooms }}
                                    </li>@endif
                                    @if(!empty($p->bathrooms))<li><img
                                            src="{{ url('images/frontend/images/bathroom.svg') }}">{{ $p->bathrooms }}
                                    </li>@endif
                                </ul>
                                <h6>@if($p->offering_type == 'rent')
                                    @if(!empty($p->price_value))AED {{ $p->price_value }} <span>@if(!empty($p->price_period))/Year @else {{ $p->price_period }} @endif</span>@endif
                                    @else
                                    @if(!empty($p->price_value))AED {{ $p->price_value }}@endif
                                    @endif
                                </h6>
                            </div>
                        </a>
                    </div>
            </div>
            @endif
            @endif
            @endforeach
        </div>

        <!-- Featured Property for Rent Section Starts -->
        <div class="product-carousel owl-carousel owl-theme">
            <?php $counterf = 0; ?>
            @foreach($properties as $p)
            @if($p->offering_type == 'rent')
            <?php $counterf++ ?>
            @if($counterf <= 8) <div class="item">
                <div class="probox">
                    <a href="{{ url('/properties/'.$p->reference) }}">
                        <span class="tag_top @if($p->offering_type == 'rent') rent @elseif($p->offering_type == 'sale') buy @endif">
                            @if($p->offering_type == 'rent') Rent @elseif($p->offering_type == 'sale') Buy @endif
                        </span>
                        <div class="pro_img">
                            @if(!empty($p->images_mlink))
                                @foreach(explode(',',$p->images_mlink) as $key => $image_m)
                                    @if($key == 0)
                                    <img class="img-responsive" src="{{ $image_m }}">
                                    @endif
                                @endforeach
                            @elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0)
                                @foreach(\App\PropertyImage::where('property_id', $p->id)->get() as $pim)
                                    <img class="img-responsive" src="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}">
                                @endforeach
                            @else
                            <img src="{{ url('images/frontend/property_images/large/default.png') }}">
                            @endif
                        </div>
                        <div class="pro_con">
                            <h5>{{ $p->community }}, {{ $p->city }}</h5>
                            <a class="badge badge-warning badge-sm" href="{{ url('properties/for/'.$p->offering_type.'/'.$p->t_name) }}">{{ $p->t_name }}</a>
                            <p>{{ $p->pro_title }}</p>
                            <ul>
                                @if(!empty($p->bedrooms))<li><img
                                        src="{{ url('images/frontend/images/bedroom.svg') }}">{{ $p->bedrooms }}
                                </li>@endif
                                @if(!empty($p->bathrooms))<li><img
                                        src="{{ url('images/frontend/images/bathroom.svg') }}">{{ $p->bathrooms }}
                                </li>@endif
                            </ul>
                            <h6>@if($p->offering_type == 'rent')
                                    @if(!empty($p->price_value))AED {{ $p->price_value }} <span>@if(!empty($p->price_period))/Year @else {{ $p->price_period }} @endif</span>@endif
                                    @else
                                    @if(!empty($p->price_value))AED {{ $p->price_value }}@endif
                                    @endif
                            </h6>
                        </div>
                    </a>
                </div>
        </div>
        @endif
        @endif
        @endforeach

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
                <a href="{{ url('/property/in/International City') }}">
                    <span class="count_overlay"></span>
                    <img src="{{ url('images/frontend/images/city1.jpg') }}">
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
                <a href="{{ url('/property/in/Greens') }}">
                    <span class="count_overlay"></span>
                    <img src="{{ url('images/frontend/images/city2.jpg') }}">
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
                <a href="{{ url('/property/in/Dubai Hills Estate') }}">
                    <span class="count_overlay"></span>
                    <img src="{{ url('images/frontend/images/city3.jpg') }}">
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
                <a href="{{ url('/property/in/Jumeirah Lake Towers') }}">
                    <span class="count_overlay"></span>
                    <img src="{{ url('images/frontend/images/city4.jpg') }}">
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
<section class="blogsec" id="subscribe">
    <div class="container">
        <div class="blog_headding mob">
            <h2>Form The <span>Blog</span></h2>
        </div>
        <div class="row">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="owl-carousel blog-carousel work-class1" id="work-class1">
                            @foreach(\App\Post::orderBy('created_at', 'desc')->where('status','1')->get() as $pim)
                            <div class="item">
                                <img src="{{ url('images/frontend/post_images/small/'.$pim->post_image) }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_headding web">
                            <h2>Form The <br /><span>Blog</span></h2>
                        </div>
                        <div class="owl-carousel work-class2" id="work-class2">
                            @foreach(\App\Post::orderBy('created_at', 'desc')->where('status','1')->get() as $p)
                            <div class="item">
                                <div class="blog_txt">
                                    <h6>{{ date('M d, Y', strtotime($p->created_at)) }}</h6>
                                    <p>{{ $p->title }}</p>
                                    <a href="{{ url('/blog/'.$p->url) }}">
                                        <h5>Read More <i class="icon ion-md-arrow-forward"></i></h5>
                                    </a>
                                </div>
                            </div>
                            @endforeach
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
                    @foreach(\App\Testimonial::where('status', 1)->orderBy('created_at', 'desc')->get() as $ttm)
                    <div class="item">
                        <div class="testimonials_box">
                            <div class="user_testimonial">
                                <img src="{{ url('/images/frontend/testimonial_images/large/'.$ttm->user_image) }}">
                            </div>
                            <q>
                                {{ $ttm->content }}
                            </q>
                            <p>{{ $ttm->user_name }}</p>
                        </div>
                    </div>
                    @endforeach
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
                <div class="subscribe_text" >
                    <h1>Subscribe Now</h1>
                    <p>Subscribe to our newsletters and be the first to know about exclusive deals,
                        property price trends and real estate news in the UAE.</p>
                </div>
            </div>
            <div class="col-md-6" >
                @if(Session::has('subscribe_message'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{!! session('subscribe_message') !!}</strong>
                </div>
                @endif
                <div class="subscribe_form">
                    <form method="post" name="subscribe_form" id="SubscribeForm" action="{{ url('/subscribe-now') }}">
                        {{ csrf_field() }}
                        <input type="email" name="email" placeholder="enter your email" required>
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

@endsection