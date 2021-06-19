@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Routers</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Show Routers
                </header>
                <div class="panel-body table-responsive">
                    @if(count($wifi_infos) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                        
                            <th>SSID</th> 
                            <th>BSSID</th>
                            <th>Password</th>
                            <th>LinkSpeed</th>
                            <th>UpSpeed</th>
                            <th>Downspeed</th>
                            <th>Action</th>
                        </tr>
                        @foreach($wifi_infos as $key => $wifi_info)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $wifi_info->name }}</td>
                            <td>{{ $wifi_info->phone }}</td>
                            <td>{{ $wifi_info->email }}</td> 
                            
                            <td>{{ $wifi_info->type }}</td> 
                            <td>
                                {{ Form::open(array('route' => array('wifi_info.destroy', $wifi_info->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $wifi_infos->render() }}  
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