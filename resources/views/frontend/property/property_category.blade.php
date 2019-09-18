@extends('layouts.frontend.home_design_2')
@section('content')

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
                        @if($properties)
                            <h4>Properties
                            @foreach($properties as $p)
                                @if($p->offering_type == 'sale') for Sale
                                @elseif($p->offering_type == 'rent') for Rent
                                @endif</h4>
                            @break
                            @endforeach
                            <h2>In UAE</h2>
                        @endif
                    </div>
                    
                    <div class="proplistbox">
                        <ul>
                        @foreach($type_name as $tn) 
                            <li>
                            @if($p->project_status == 'off_plan')
                            <a href="{{ url('/properties/for/'.$p->project_status.'/'.$tn->t_name) }}">{{ $tn->t_name }} ({{ \App\Property::where('t_name', $tn->t_name)->where('project_status', 'off_plan')->count() }})</a>
                            @else
                                <a href="{{ url('/properties/for/'.$p->offering_type.'/'.$tn->t_name) }}">{{ $tn->t_name }} ({{ \App\Property::where('t_name', $tn->t_name)->where('offering_type', $p->offering_type)->count() }})</a>
                            @endif
                            </li>
                        @endforeach
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
                        
                            @if(count($properties) == 0)
                            <div class="pro_con p-3">
                                <p style="text-align: center;"><img src="{{ url('/images/frontend/images/error.png') }}"
                                        alt=""></p>
                                <h5 style="text-align: center;">Sorry, no results found!</h5>
                                <h6 style="text-align: center;">Oh Snap! Zero Results found for your search.</h6>
                            </div>
                            @endif

                            @foreach($properties as $p)
                            <div class="proplist">
                                <div class="proplist_img" style="text-align: center;">
                                    @if(!empty($p->images_mlink))
                                        @foreach(explode(',',$p->images_mlink) as $key => $image_m)
                                            @if($key == 0)
                                            <img style="max-height:225px;" class="img-responsive" src="{{ $image_m }}">
                                            @endif
                                        @endforeach
                                    @elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0)
                                        @foreach(\App\PropertyImage::where('property_id', $p->id)->take(1)->get() as $pim)
                                            <img class="img-responsive" src="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}">
                                        @endforeach
                                    @else
                                        <img src="{{ url('images/frontend/property_images/large/default.png') }}">
                                    @endif
                                </div>
                                <div class="proplist_item">
                                    <div class="pro_con">
                                        <label class="badge badge-warning">{{ $p->t_name }}</label> @if(!empty($p->project_status))<label class="badge badge-info">Off Plan </label>@endif
                                        <label class="badge badge-success">@if($p->offering_type == 'sale') Buy
                                            @elseif($p->offering_type == 'rent') Rent @elseif($p->offering_type == 'off-plan') Off Plan
                                            @endif</label>
                                        <h5>{{ $p->community }}, {{ $p->city }}</h5>
                                        <p>{{ $p->pro_title }}</p>
                                        <h6>@if($p->offering_type == 2)
                                            @if(!empty($p->price_value))AED {{ $p->price_value }} <span>/Year</span>@endif
                                            @else
                                            @if(!empty($p->price_value))AED {{ $p->price_value }}@endif
                                            @endif</h6>
                                        <ul>
                                            @if(!empty($p->bedrooms))<li>
                                                <img
                                                    src="{{ url('/images/frontend/images/bedroom.svg') }}">{{ $p->bedrooms }}
                                            </li>@endif
                                            @if(!empty($p->bedrooms))<li>
                                                <img
                                                    src="{{ url('/images/frontend/images/bathroom.svg') }}">{{ $p->bathrooms }}
                                            </li>@endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="callquiery">
                                    <!--<p>Posted on {{ date('M d, Y', strtotime($p->created_at)) }}</p>-->
                                    <a href="{{ url('/properties/'.$p->reference) }}" class="readmore_btn">Read More</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="product_loadding center">
                    @if( !empty($type))
                    {!! $properties->appends(array("property_type" => $type, "location_id" => $scityID ))->render() !!}
                    @else
                        {!! $properties->render() !!}
                    @endif
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
                            <li><a href="{{ url('/property/in/International City') }}">Buy Properties in International City</a></li>
                            <li><a href="{{ url('/property/in/Greens') }}">Buy Properties in Greens</a></li>
                            <li><a href="{{ url('/property/in/Dubai Hills Estate') }}">Buy Properties in Dubai Hills Estate</a></li>
                            <li><a href="{{ url('/property/in/Jumeirah Lake Towers') }}">Buy Properties in Jumeirah Lake Towers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="{{ url('/images/frontend/images/dubai.png') }}">
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
     
@endsection