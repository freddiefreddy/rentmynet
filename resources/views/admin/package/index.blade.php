@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Packagies</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Show Packages
                  
                </header>
                <div class="panel-body table-responsive">
                    @if(count($package_details) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th> 
                            <th>Price</th>
                            <th>Time Span</th>
                            <th>Action</th>
                        </tr>
                        @foreach($package_details as $key => $package_detail)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $package_detail->id}}</td>
                            <td>{{ $package_detail->price }}</td>
                            <td>{{ $package_detail->time_span }}</td> 
                            <td>
                                {{ Form::open(array('route' => array('package_detail.destroy', $package_detail->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $package_details->render() }}  
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