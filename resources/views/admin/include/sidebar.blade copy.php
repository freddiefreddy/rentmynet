<aside class="left-side sidebar-offcanvas">
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <ul class="sidebar-menu">
         <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
            <a href="{{ Route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'list_users_admin' ? 'active' : '' }}">
            <a href="{{ Route('list_users_admin) }}">
            <i class="fa fa-list"></i> <span>Users</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'list_users_vendor' ? 'active' : '' }}">
            <a href="{{ Route('list_users_vendor') }}">
            <i class="fa fa-question"></i> <span>Vendors</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'list_routers_admin' ? 'active' : '' }}">
            <a href="{{ Route('list_routers_admin') }}">
            <i class="fa fa-book"></i> <span>Routers</span>
            </a>
         </li>         
         <li class="{{ Request::segment(2) === 'package_details' ? 'active' : '' }}">
            <a href="{{ Route('notification') }}">
            <i class="fa fa-bell"></i> <span>Package Details</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'upload' ? 'active' : '' }}">
            <a href="{{ Route('upload') }}">
            <i class="fa fa-upload"></i> <span>Add</span>
            </a>
         </li>

         <li class="{{ Request::segment(2) === 'upload' ? 'active' : '' }}">
            <a href="{{ Route('upload') }}">
            <i class="fa fa-upload"></i> <span>Payment Request</span>
            </a>
         </li>
         
         <li class="{{ Request::segment(2) === 'upload' ? 'active' : '' }}">
            <a href="{{ Route('upload') }}">
            <i class="fa fa-upload"></i> <span>Reedem Card</span>
            </a>
         </li>
         
         <li class="{{ Request::segment(2) === 'setting' ? 'active' : '' }}">
            <a href="{{ Route('setting') }}">
            <i class="fa fa-cog"></i> <span>Settings</span>
            </a>
         </li>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>