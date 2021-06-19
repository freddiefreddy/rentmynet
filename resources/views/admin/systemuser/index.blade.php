@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active"System Users</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    No of System Users
                </header>
                <div class="panel-body table-responsive">
                    @if(count($system_users) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th> 
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Blocked</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        @foreach($system_users as $key => $system_user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $system_user->name }}</td>
                            <td>{{ $system_user->phone }}</td>
                            <td>{{ $system_user->email }}</td> 
                            <td>{!! $system_user->blocked == No ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' !!}</td>
                            <td>{{ $system_user->type }}</td> 
                            <td>
                                {{ Form::open(array('route' => array('system_user.destroy', $system_user->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $system_users->render() }}  
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