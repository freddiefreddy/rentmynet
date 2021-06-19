@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Reedem Cards</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Show Reedem Cards
                  
                </header>
                <div class="panel-body table-responsive">
                    @if(count($redeem_cards) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Card Owner</th> 
                            <th>Card Code</th>
                            <th>Used</th>
                            <th>Action</th>
                        </tr>
                        @foreach($redeem_cards as $key => $reedem_card)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $reedem_card->system_users->name }}</td>
                            <td>{{ $reedem_card->code }}</td>
                            <td>{{ $reedem_card->used }}</td>  
                            <td>
                                {{ Form::open(array('route' => array('redeem_card.destroy', $reedem_card->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $redeem_cards->render() }}  
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