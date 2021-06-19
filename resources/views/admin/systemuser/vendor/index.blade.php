@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">System Users</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Vendors
                </header>
                <div class="panel-body table-responsive">
                    @if(count($admin_vendors) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th> 
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Blocked</th>
                            <th>Action</th>
                        </tr>
                        @foreach($admin_vendors  as $key => $admin_vendor)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $admin_vendor->name }}</td>
                            <td>{{ $admin_vendor->phone }}</td>
                            <td>{{ $admin_vendor->email }}</td> 
                            <td>{!! $admin_vendor->blocked == No ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' !!}</td>
                            <td>
                                {{ Form::open(array('route' => array('admin_vendor.destroy', $admin_vendor->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $admin_vendors->render() }}  
                    @else
                        <p><h5 style="color:#F00;">No Data</h5></p>
                    @endif
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