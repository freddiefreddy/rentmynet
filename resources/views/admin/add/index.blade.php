@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Companies</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Show Companies
                  
                </header>
                <div class="panel-body table-responsive">
                    @if(count($adds) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Company</th> 
                            <th>Display Iteration</th>
                            <th>Display</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                        @foreach($adds as $key => $add)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $add->company_name }}</td>
                            <td>{{ $add->display_iteration }}</td>
                            <td>{{ $add->display }}</td>
                            <td>{{ $add->cost }}</td>  
                            <td>
                                {{ Form::open(array('route' => array('add.destroy', $add->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $adds->render() }}  
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