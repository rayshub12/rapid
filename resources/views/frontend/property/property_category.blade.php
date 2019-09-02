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
                                <?php $i = 0;?>
                                @foreach($location_data as $key =>$loc)
                                <?php
                                    
                                        if($loc->sub_community != null){
                                            $a[$loc->id] = $loc->sub_community.','.$loc->community.','.$loc->city;
                                        }else{
                                            if($loc->community != null){
                                                $a[$loc->id] = $loc->community.','.$loc->city;
                                            }else{
                                                $a[$loc->id] = $loc->city;
                                            }
                                        }
                                   
                                    $i++;
                                ?>
                                @endforeach
                                <?php $a = array_unique($a); 
                                asort($a);
                                ?>
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body" data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                @foreach($a as $key => $p)
                                    <option id="city_search" value='<?=$key?>'><?=$p?></li>
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
                                <?php $i = 0;?>
                                @foreach($location_data as $key =>$loc)
                                <?php
                                    
                                        if($loc->sub_community != null){
                                            $a[$loc->id] = $loc->sub_community.','.$loc->community.','.$loc->city;
                                        }else{
                                            if($loc->community != null){
                                                $a[$loc->id] = $loc->community.','.$loc->city;
                                            }else{
                                                $a[$loc->id] = $loc->city;
                                            }
                                        }
                                   
                                    $i++;
                                ?>
                                @endforeach
                                <?php $a = array_unique($a); 
                                asort($a);
                                ?>
                                <select class="selectpicker form-control" name="location_id" id="number" data-container="body" data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                @foreach($a as $key => $p)
                                    <option id="city_search" value='<?=$key?>'><?=$p?></li>
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
                                    <select class="selectpicker form-control" name="search_text" id="number" data-container="body" data-live-search="true" title="Type your location to search" data-hide-disabled="true">
                                    @foreach(\App\City::where('country_id', 231)->orderBy('name', 'asc')->get() as $key => $p )
                                        <option id="city_search" value='<?=$p['id']?>'><?=$p['name']?></li>
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
                            @if($p->property_for == 1) for Sale
                            @elseif($p->property_for == 2) for Rent
                            @endif</h4>
                        <h2>In UAE</h2>
                        @break
                        @endforeach
                        @else
                        <h4>Properties</h4>
                        <h2>In UAE</h2>
                        @endif
                    </div>
                    
                    <div class="proplistbox">
                        <ul>
                            <?php $prop_type = array(); 
                            $i=0;
                            ?>
                            @foreach($properties1 as $key => $p)
                            <?php 
                            
                            $prop_type[$p->type->id] = $p->property_type; 
                           
                            ?> 
                            @endforeach  
                            @foreach($prop_type as $key => $prop_value)
                             <li> 
                                 <?php
                                    
                                    if($properties1[0]->property_for == 1){
                                 ?>
                                <a href="{{ url( '/category/property/sale/'.$key.'/'.$prop_value.'/1' ) }}">{{$prop_value}} </a>
                                <?php
                                    }elseif($properties1[0]->property_for == 2){
                                ?>
                                <a href="{{ url( '/category/property/rent/'.$key.'/'.$prop_value.'/1' ) }}">{{$prop_value}}</a>
                                <?php
                                }
                                ?>
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
                            <strong id="pro"><?php echo count($properties); ?> results</strong>
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
                                    @if(!empty($p->image_name))
                                    <img src="{{ url('/images/frontend/property_images/large/'.$p->image_name) }}">
                                    @elseif(!empty($p->images[0]->medium->link))
                                    <img height="200" src="{{ $p->images[0]->medium->link }}">
                                    @else
                                    <img src="{{ url('images/frontend/property_images/large/default.png') }}">
                                    @endif
                                </div>
                                <div class="proplist_item">
                                    <div class="pro_con">
                                        <label
                                            class="badge badge-warning">{{ $p->property_type }}</label>
                                        <label class="badge badge-success">@if($p->property_for == 1) Buy
                                            @elseif($p->property_for == 2) Rent @elseif($p->property_for == 3) Off Plan
                                            @endif</label>
                                        <h5>{{ $p->city_name }}, {{ $p->state_name }}</h5>
                                        <p>{{ $p->name }}</p>
                                        <h6>@if($p->property_for == 2)
                                            @if(!empty($p->property_price))AED {{ $p->property_price }} <span>/Year</span>@endif
                                            @else
                                            @if(!empty($p->property_price))AED {{ $p->property_price }}@endif
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
                                    <a href="{{ url('/properties/'.$p->id) }}" class="readmore_btn">Read More</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="center" style="text-align: center; width: 100%;">
                        <div class="pagination" style="display: inline-block;">
                        @if($counter != null)
                            @if(isset($current_page))
                            <?php $prev = $current_page - 1; ?>
                            <?php $next_page = $current_page + 1; ?>

                            @if(($has_next_page == true) && ($has_previous_page == false))

                            <li style="float:right;list-style:none;padding-top: 0.5em;padding-left: 1em;"><a
                                    href="{{ Route::current()->getName().$next_page }}"
                                    class="btn btn-sm btn-info">Next &raquo;</a></li>



                            @elseif(($has_next_page == false) && ($has_previous_page == true))
                            <li style="float:left;list-style:none;padding-top: 0.5em;padding-left: 1em;"><a
                                    href="{{ Route::current()->getName().$prev }}"
                                    class="btn btn-sm btn-info">&laquo; Previous</a></li>

                            @elseif(($has_next_page == true) && ($has_previous_page == true))
                            <li style="float:left;list-style:none;padding-top: 0.5em;padding-left: 1em;"><a
                                    href="{{ Route::current()->getName().$prev }}"
                                    class="btn btn-sm btn-info">&laquo;  Previous</a></li>

                            <li style="float:right;list-style:none;padding-top: 0.5em;padding-left: 1em;"><a
                                    href="{{ Route::current()->getName().$next_page }}"
                                    class="btn btn-sm btn-info">Next &raquo;</a></li>

                            @endif
                            @endif
                        @endif
                        </div>
                    </div>
                    
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
                            <li><a href="{{ url('/property/48003/al-quoz') }}">Buy Properties in Al Quoz</a></li>
                            <li><a href="{{ url('/property/47987/dubai-city') }}">Buy Properties in Dubai City</a></li>
                            <li><a href="{{ url('/property/48008/hatta') }}">Buy Properties in Hatta</a></li>
                            <li><a href="{{ url('/property/48064/arjan') }}">Buy Properties in Arjan</a></li>
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