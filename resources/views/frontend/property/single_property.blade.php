@extends('layouts.frontend.home_design_2')
@section('content')

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
    <section class="pt-1 pb-1">
        <div class="breadcrumb_sec">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom_breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/properties') }}">Properties</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $property->pro_title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="pt-1">
        <div class="container">
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-dismissible">
                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            <div class="details_headding">
                <div class="row">
                    <div class="col-md-7">
                        <h5>{{ $property->pro_title }}</h5>
                        <p>{{ $property->pro_title }}</p>
                    </div>
                    <div class="col-md-5">
                        <div class="share_query">
                            <div class="callquery">
                                <a href="mailto:info@rapiddeals.com"><img
                                        src="{{ url('/images/frontend/images/mail.svg') }}"></a>
                                <a href="#"><img src="{{ url('/images/frontend/images/wp.svg') }}"></a>
                                <a href="tel:+97142432977"><img src="{{ url('/images/frontend/images/call.svg') }}"></a>
                            </div>
                            <a href="#" class="enquirebtn" data-toggle="modal" data-target="#getQuerymodal"><i
                                    class="fa fa-info"></i>Enquiry Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo">
                <div class="item">
                    <div class="clearfix">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @if(!empty($property->images_flink))
                            @foreach(explode(',',$property->images_flink) as $pim)
                            <li style="text-align: center;background:#f8f8f8;" height="100" width="200"
                                data-thumb="{{ $pim }}">
                                <img height="450" src="{{ $pim }}" />
                            </li>
                            @endforeach
                            @elseif(\App\PropertyImage::where('property_id', $property->id)->count() > 0)
                            @foreach(\App\PropertyImage::where('property_id', $property->id)->get() as $pim)
                            <li style="text-align: center;background:#f8f8f8;" height="100" width="200"
                                data-thumb="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}">
                                <img height="450"
                                    src="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}" />
                            </li>
                            @endforeach
                            @else
                            <li style="text-align: center;background:#f8f8f8;">
                                <img height="450" src="{{ url('images/frontend/property_images/large/default.png') }}">
                            </li>
                            @endif
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
                    <div class="prop_table @if($property->offering_type == 'off_plan') d-none @endif">
                        <h5>FACTS</h5>
                        <table class="table-responsive table table-bordered ">
                            <tbody>
                                <tr>
                                    <td scope="row">Price</td>
                                    <td>@if($property->offering_type == 'rent')
                                        AED {{ $property->price_value }} @if(!empty($property->price_period))
                                        {{ $property->price_period }} @else /year @endif
                                        @elseif($property->offering_type == 'sale')
                                        AED {{ $property->price_value }}
                                        @endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Type</td>
                                    <td>@if(!empty($property->t_name)){{ $property->t_name }}@endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Reference Code</td>
                                    <td>@if(!empty($property->reference)){{ $property->reference }}@endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Bedrooms</td>
                                    <td>@if(!empty($property->bedrooms)){{ $property->bedrooms }}@endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Bathrooms</td>
                                    <td>@if(!empty($property->bathrooms)){{ $property->bathrooms }}@endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Parkings</td>
                                    <td>@if(!empty($property->parking)){{ $property->parking }}@endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Furnished</td>
                                    <td>@if($property->furnished) {{ $property->furnished }} @endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Area</td>
                                    <td>@if(!empty($property->size)){{ $property->size }} sqft. @endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Area</td>
                                    <td>@if(!empty($property->size)){{ $property->size }} sqft. @endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Project Status</td>
                                    <td>@if(!empty($property->offering_type)) @if($property->offering_type == 'rent')
                                        Rent @else Sale @endif @endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">Project Status</td>
                                    <td>@if(!empty($property->project_status)) Off Plan @endif</td>
                                </tr>
                                <tr>
                                    <td scope="row">License</td>
                                    <td>@if(!empty($property->licenses_number)) {{ $property->selected_license }} -
                                        {{ $property->licenses_number }} @endif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prop_table @if($property->offering_type == 'off_plan') d-none @endif">
                        <h5>AMENITIES</h5>
                        <div class="amenties">
                            <ul>
                                @if(!empty($property->amenities_name))
                                @foreach(explode(',', $property->amenities_name) as $amenities_name)
                                <li>{{ $amenities_name }}</li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h5>DESCRIPTION</h5>
            <p>{!! nl2br($property->pro_description) !!}</p>
        </div>
    </section>

    <section class="pt-1 @if($property->project_status == 'off_plan') d-block @else d-none @endif">
        <div class="container">
            @if(\App\FloorImage::where('property_id', $property->id)->count() > 0)
            <h3 class="mb-3">Floor Plans</h3>
            @endif
            <div class="demo">
                <div class="item">
                    <div class="clearfix">
                        <ul id="image-gallery2" class="gallery2 list-unstyled cS-hidden">
                            @if(\App\FloorImage::where('property_id', $property->id)->count() > 0)
                            @foreach(\App\FloorImage::where('property_id', $property->id)->get() as $pim)
                            <li style="text-align: center;background: #f8f8f8;"
                                data-thumb="{{ url('/images/frontend/property_images/large/'.$pim->image_name) }}">
                                <img src="{{ url('/images/frontend/property_images/large/'.$pim->image_name) }}" />
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="property_sec">
        <div class="container">
            <h3 class="mb-3">More available in {{ $property->community }} </h3>
            <div class="row">
                <?php $counter = 0; ?>
                @foreach(\App\Property::where('community',$property->community)->orderBy('created_at',
                'desc')->take(4)->get() as $prel)
                <div class="col-md-3">
                    <div class="probox">
                        <a href="{{ url('/properties/'.$prel->reference) }}">
                            <span
                                class="tag_top @if($prel->offering_type == 'rent') rent @elseif($prel->offering_type == 'sale') sell @endif">
                                @if($prel->offering_type == 'rent') Rent @elseif($prel->offering_type == 'sale') Buy
                                @endif</span>
                            <div class="pro_img">
                                @if(!empty($prel->images_mlink))
                                @foreach(explode(',',$prel->images_mlink) as $key => $image_m)
                                    @if($key == 0)
                                    <img class="img-responsive" src="{{ $image_m }}">
                                    @endif
                                @endforeach
                                @elseif(\App\PropertyImage::where('property_id', $prel->id)->count() > 0)
                                    @foreach(\App\PropertyImage::where('property_id', $prel->id)->take(1)->get() as $pim)
                                    <img class="img-responsive"
                                        src="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}">
                                    @endforeach
                                @else
                                <img src="{{ url('images/frontend/property_images/large/default.png') }}">
                                @endif
                            </div>
                            <div class="pro_con">
                                <h5>{{ str_limit($prel->community, $limit=13) }}, {{ $prel->city }}</h5>
                                <a class="badge badge-warning badge-sm"
                                    href="{{ url('/properties/for/'.$prel->offering_type.'/'.$prel->t_name) }}">
                                    {{ $prel->t_name }}
                                </a>
                                <p>{{ $prel->pro_title }}</p>
                                <h6>@if($prel->offering_type == 'rent')AED {{ $prel->price_value }}
                                    <span>/{{ $prel->price_period }}</span>@elseif($prel->offering_type == 'sale') AED
                                    {{ $prel->price_value }} @endif</h6>
                                <ul>
                                    @if(!empty($prel->bedrooms))<li><img
                                            src="{{ url('images/frontend/images/bedroom.svg') }}">{{ $prel->bedrooms }}
                                    </li>@endif
                                    @if(!empty($prel->bathrooms))<li><img
                                            src="{{ url('images/frontend/images/bathroom.svg') }}">{{ $prel->bathrooms }}
                                    </li>@endif
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
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
                <h5 class="modal-title" id="getQuerymodalTitle">Enquiry Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="enquiry_form" id="EnquiryForm"
                    action="{{ url('/properties/'.$property->reference) }}">
                    {{ csrf_field() }}
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
                            value="{{ $property->pro_title }}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="prop_url" id="prop_url"
                            value="{{ url('/properties/'.$property->reference) }}">
                    </div>
                    <div class="form-group">
                        <label for="Enquiry Details">Enquiry Details</label>
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

@endsection