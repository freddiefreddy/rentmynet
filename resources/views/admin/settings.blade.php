@extends('admin.layout.master')

@section('pagetitle', 'Settings - ' . config('app.name'))

@section('content')
	<div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Setting</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>      

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <header class="panel-heading">
                    API URLs
                </header>

                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Purpose</th>
                            <th>URL</th>
                            <th>Type</th>
                        </tr>
                        <tr>
                            <td>Get all System Users</td>
                            <td>{{ url('/') }}/api/system_users</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get a specific system user</td>
                            <td>{{ url('/') }}/api/system_users/{id}</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get all verified system users</td>
                            <td>{{ url('/') }}/api/system_users/verified/</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get a list of all routers</td>
                            <td>{{ url('/') }}/api/list_routers</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get router password</td>
                            <td>{{ url('/') }}/api/router/password</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                        <tr>
                            <td>Get transactions information</td>
                            <td>{{ url('/') }}/api/transaction_details</td>
                            <td><span class="label label-success">GET</span></td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@push('styles')
   <style>
      /* Page Specific Custom Style Here */
   </style>
@endpush

@push('scripts')
   <script>
      // Page Specific Custom Script Here 
   </script>
@endpush