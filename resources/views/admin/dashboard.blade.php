@extends('layouts.backend.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Recent Update</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Properties</span>
                        <span class="label label-success">Total &nbsp;{{ \App\Property::get()->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Property</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach($properties as $p)
                            <li class="item">
                                <div class="product-img">
                                @if(!empty($p->images_mlink))
                                    @foreach(explode(',',$p->images_mlink) as $key => $image_m)
                                        @if($key == 0)
                                        <img class="img-responsive" src="{{ $image_m }}">
                                        @endif
                                    @endforeach
                                @else
                                <img src="{{ url('images/frontend/property_images/large/default.png') }}">
                                @endif
                                </div>
                                <div class="product-info">
                                    <a href="{{ url('/properties/'.$p->reference) }}" target="_blank" class="product-title">{{ str_limit($p->pro_title, $limit=150) }}
                                        <span class="label label-success pull-right">@if($p->offering_type == 'rent')
                                            AED {{ $p->price_value }} <span>/Year</span>
                                            @else
                                            AED {{ $p->price_value }}
                                            @endif</span></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ url('/admin/property') }}" class="uppercase">View All Properties</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection