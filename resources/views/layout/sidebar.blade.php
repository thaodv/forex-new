<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('forex.dashboard')}}">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Forex <sup>v1</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="{{route('forex.dashboard')}}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Forex - Trading
</div>

<!-- Nav Item - Users Collapse Menu -->
@if(Session::get('user_type')=="Developer")
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
    <i class="fas fa-fw fa-cog"></i>
    <span>Users</span>
  </a>
  <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">User Management:</h6>
      <a class="collapse-item" href="{{route('forex.list')}}">Master List</a>
      <a class="collapse-item" href="{{route('forex.create')}}">Add New User</a>
    </div>
  </div>
</li>
@endif

@if(Session::get('user_type')=="Dev" || Session::get('user_type')=="Fao")
<!-- Nav Item - Leads Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeads" aria-expanded="true" aria-controls="collapseLeads">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Prospect Leads</span>
  </a>
  <div id="collapseLeads" class="collapse" aria-labelledby="headingLeads" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forex Leads:</h6>
      <a class="collapse-item" href="{{route('prospect.list')}}">List</a>
      <a class="collapse-item" href="{{route('prospect.new')}}">Add New Lead</a>
      <a class="collapse-item" href="{{route('prospect.onboard')}}">On-board Prospect Lead</a>      
      <a class="collapse-item" href="{{route('lead.approval')}}">For Approval</a>
    </div>
  </div>
</li>

{{-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeads" aria-expanded="true" aria-controls="collapseLeads">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Leads</span>
  </a>
  <div id="collapseLeads" class="collapse" aria-labelledby="headingLeads" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forex Leads:</h6>
      <a class="collapse-item" href="{{route('lead.list')}}">List</a>
      <a class="collapse-item" href="{{route('lead.new')}}">Add New Lead</a>
      <a class="collapse-item" href="{{route('lead.appointment')}}">For Appointment</a>
      <a class="collapse-item" href="{{route('lead.onboard')}}">On-board Lead</a>      
      <a class="collapse-item" href="{{route('lead.approval')}}">For Approval</a>
    </div>
  </div>
</li> --}}


<!-- Nav Item - Clients Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients" aria-expanded="true" aria-controls="collapseClients">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Clients</span>
  </a>
  <div id="collapseClients" class="collapse" aria-labelledby="headingClients" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forex Clients:</h6>
      <a class="collapse-item" href="{{route('client.list')}}">List</a>
      <a class="collapse-item" href="{{route('client.atp')}}">ATP Form</a>
    </div>
  </div>
</li>

 
@endif

@if(Session::get('user_type')=="Com")
<!-- Nav Item - Clients Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients" aria-expanded="true" aria-controls="collapseClients">
    <i class="fas fa-fw fa-wrench"></i>
    <span>On-Boarded Client</span>
  </a>
  <div id="collapseClients" class="collapse" aria-labelledby="headingClients" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">On-Boarded Client:</h6>
      <a class="collapse-item" href="{{route('client.onboard')}}">New On-board</a>
    </div>
  </div>
</li>

<!-- Nav Item - ATP Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseATP" aria-expanded="true" aria-controls="collapseATP">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Application To Purchase</span>
  </a>
  <div id="collapseATP" class="collapse" aria-labelledby="headingATP" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">ATP Forms:</h6>
      <a class="collapse-item" href="{{route('order.atp')}}">ATP of Today's Booking</a>
    </div>
  </div>
</li>
@endif

@if(Session::get('user_type')=="DeptHead")
<!-- Nav Item - Clients Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients" aria-expanded="true" aria-controls="collapseClients">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Trader Assignment</span>
  </a>
  <div id="collapseClients" class="collapse" aria-labelledby="headingClients" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forex Client:</h6>
      <a class="collapse-item" href="{{route('forex.assign-trader')}}">Trader Assignment</a>
    </div>
  </div>
</li>
@endif

@if(Session::get('user_type')=="Trader")
<!-- Nav Item - Clients Collapse Menu -->
{{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlotter" aria-expanded="true" aria-controls="collapseBlotter">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Blotter</span>
    </a>
    <div id="collapseBlotter" class="collapse" aria-labelledby="headingBlotter" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Forex Blotter:</h6>
        <a class="collapse-item" href="{{route('forex.liquidity')}}">Set Liquidity</a> 
      </div>
    </div>
  </li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients" aria-expanded="true" aria-controls="collapseClients">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Clients</span>
  </a>
  <div id="collapseClients" class="collapse" aria-labelledby="headingClients" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forex Clients:</h6>
      <a class="collapse-item" href="{{route('trader.list')}}">List</a> 
    </div>
  </div>
</li> --}}

<li class="nav-item">
<a class="nav-link collapsed" href="{{route('trader.blotter')}}"  aria-expanded="true" aria-controls="collapseClients">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Trading</span>
    </a>
    <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Clients' Order:</h6>
        <a class="collapse-item" href="{{route('trader.orders')}}">List</a>
        <a class="collapse-item" href="{{route('trader.create')}}">Book Order</a>
      </div>
    </div>
  </li>
@endif



<!-- Nav Item - Logs Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLogs" aria-expanded="true" aria-controls="collapseLeads">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Logs</span>
    </a>
    <div id="collapseLogs" class="collapse" aria-labelledby="headingLogs" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Forex Logs:</h6>
        <a class="collapse-item" href="{{route('forex.logs')}}">View Activity Log</a>
      </div>
    </div>
  </li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->