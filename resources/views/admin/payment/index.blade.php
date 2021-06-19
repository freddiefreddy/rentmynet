@extends('admin.layout.master')

@section('pagetitle', 'Users - ' . config('app.name'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active">Payment Details</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

	<div class="row">
        <div class="col-xs-12">
            <div class="panel">                
                <header class="panel-heading">
                    Payments
                  
                </header>
                <div class="panel-body table-responsive">
                    @if(count($vendor_transactions) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Owner</th> 
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($vendor_transactions as $key => $vendor_transaction)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $vendor_transaction->system_users->name }}</td>
                            <td>{{ $vendor_transaction->account_no }}</td>
                            <td>{{ $vendor_transaction->amount }}</td>
                            <td>{{ $vendor_transaction->status }}</td>   
                            <td>
                                {{ Form::open(array('route' => array('vendor_transaction.destroy', $vendor_transaction->id), 'method' => 'delete', 'style' => 'display:initial;')) }}
                                    <button data-placement="top" data-toggle="tooltip" class="btn btn-default btn-sm tooltips" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    
                    <p>&nbsp;</p>
                    
                    {{ $vendor_transactions->render() }}  
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