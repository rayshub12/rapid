@extends('layouts.backend.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="{{ url('admin/team_member/add') }}" class="label label-lg label-success">+ Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">List of Subscribers</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">List of Subscribers</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    @foreach($Team_member as $team)
                                    <?php $i++ ?>
                                    <td><strong>{{ $i }}</strong></td>
                                    <td><strong>{{ $team->name }}</strong></td>
                                    <td>{{ $team->designation}}</td>
                                    <td>{{ $team->description}}</td>
                                    <td>{{ date('d M, Y', strtotime($team->created_at)) }}</td>
                                    <td>
                                        <div id="donate">

                                            @if($team->status == 1)
                                            <a title="Enable" class="label label-success label-sm">Enable</a>
                                            @else
                                            <a title="Disable" class="label label-danger label-sm">Disable</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection