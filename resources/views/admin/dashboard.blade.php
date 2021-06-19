@extends('admin.layout.master')

@section('pagetitle', 'Dashboard - ' . config('app.name'))

@section('content')
   <div class="row" style="margin-bottom:5px;">
      <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-user"></i></span>
            <div class="sm-st-info">
               <span>{{ $total_users}}</span>
               No of Connected Users
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-blue"><i class="fa fa-book"></i></span>
            <div class="sm-st-info">
               <span>{{ $total_routers}}</span>
               No of Routers
            </div>
         </div>
      </div>

      <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-user"></i></span>
            <div class="sm-st-info">
               <span>{{ $total_normals }}</span>
               No of Registered Users
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-3">
         <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-user"></i></span>
            <div class="sm-st-info">
               <span>{{ $total_vendors }}</span>
               No of Registered Vendors
            </div>
         </div>
      </div>
   <!-- Main row -->

   <!-- row end -->
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