@extends('layouts.backend.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="{{ url('admin/property/add') }}" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Property List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Properties</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Listed For</th>
                                    <th>Price</th>
                                    <th>Project Status</th>
                                    <th>Loacation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    @foreach($properties as $p)
                                    <?php $i++ ?>
                                    <td>{{ $i }}</td>
                                    <td>
                                        @if(!empty($p->images_mlink))
                                        @foreach(explode(',',$p->images_mlink) as $key => $image_m)
                                        @if($key == 0)
                                        <img width="80" class="img-responsive" src="{{ $image_m }}">
                                        @endif
                                        @endforeach
                                        @elseif(\App\PropertyImage::where('property_id', $p->id)->count() > 0)
                                        @foreach(\App\PropertyImage::where('property_id', $p->id)->take(1)->get() as $pim)
                                        <img width="80" class="img-responsive" src="{{ url('images/frontend/property_images/large/'.$pim->image_name) }}">
                                        @endforeach
                                        @else
                                        <img width="80" src="{{ url('images/frontend/property_images/large/default.png') }}">
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/properties/'.$p->reference) }}">{{ $p->pro_title}}</a></td>
                                    <td><label class="label label-md label-success">@if($p->offering_type == 'sale')
                                            Sale @elseif($p->offering_type == 'rent') Rent @endif</label></td>
                                    <td>@if($p->offering_type == 'sale') AED {{ $p->price_value }}
                                        @elseif($p->offering_type == 'rent') AED {{ $p->price_value }} /year @endif</td>
                                    <td><label class="label label-md- label-info">@if($p->project_status == 'off_plan')
                                            Off Plan @endif</label></td>
                                    <td>{{ $p->community }}, {{ $p->city }}</td>
                                    <td>
                                        <div id="donate">
                                            <a href="{{ url('/admin/property/'.$p->reference.'/edit') }}" title="Edit"
                                                class="label label-success label-sm"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('/admin/property/'.$p->reference.'/delete') }}"
                                                title="Delete" class="label label-danger label-sm"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info_1" id="allusers-table_info_1" role="status" aria-live="polite">
                                Showing 1 to 10 of 10 entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers_1" id="allusers-table_paginate_1">
                                {!! $properties->render() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
.dataTables_info,
.paging_simple_numbers {
    display: none;
}

.pagination {
    margin: 10px 20px 20px 0px;
    float: right;
}

.dataTables_info_1 {
    margin: 20px;
}
</style>

@endsection