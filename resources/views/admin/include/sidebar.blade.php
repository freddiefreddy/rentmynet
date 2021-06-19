<aside class="left-side sidebar-offcanvas">
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <ul class="sidebar-menu">
         <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
            <a href="{{ Route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
         </li>

         <li class="{{ Request::segment(2) === 'listusersadmin' ? 'active' : '' }}">
            <a href="{{ Route('listusersadmin') }}">
            <i class="fa fa-list"></i> <span>Users</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'listusersvendor' ? 'active' : '' }}">
            <a href="{{ Route('listusersvendor') }}">
            <i class="fa fa-user"></i> <span>Vendors</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'companies' ? 'active' : '' }}">
            <a href="{{ Route('companies') }}">
            <i class="fa fa-envelope-o"></i> <span>Add</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'listrouters' ? 'active' : '' }}">
            <a href="{{ Route('listrouters') }}">
            <i class="fa fa-book"></i> <span>Routers</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'listpackages' ? 'active' : '' }}">
            <a href="{{ Route('listpackages') }}">
            <i class="fa fa-gift"></i> <span>Package Details</span>
            </a>
         </li>


         <li class="{{ Request::segment(2) === 'transactions' ? 'active' : '' }}">
            <a href="{{ Route('transactions') }}">
            <i class="fa fa-shopping-cart"></i> <span>Payment Request</span>
            </a>
         </li>

         <li class="{{ Request::segment(2) === 'redeemcards' ? 'active' : '' }}">
            <a href="{{ Route('redeemcards') }}">
            <i class="fa fa-credit-card"></i> <span>Redeem Card</span>
            </a>
         </li>




      </ul>
   </section>
   <!-- /.sidebar -->
</aside>