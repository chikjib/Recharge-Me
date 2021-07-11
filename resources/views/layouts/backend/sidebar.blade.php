<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="{{route('dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li> <a href="{{ route('airtime') }}"><i class="icon icon-signal"></i> <span>Airtime Top Up</span></a> </li>
    <li> <a href="{{ route('datashare') }}"><i class="icon icon-inbox"></i> <span>Mtn SME Data Share</span></a> </li>
    <li><a href="{{ route('corporate') }}"><i class="icon icon-th"></i> <span>Mtn Corporate Data</span></a></li>
    <li><a href="{{ route('direct_data') }}"><i class="icon icon-fullscreen"></i> <span>Direct Data Top up</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Cable Subscriptions</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="{{ route('dstv') }}">Dstv</a></li>
        <li><a href="{{ route('gotv') }}">Gotv</a></li>
        <li><a href="{{ route('startimes') }}">Startimes</a></li>
      </ul>
    </li>
    <li><a href="{{ route('waec') }}"><i class="icon icon-pencil"></i> <span>Waec Pin</span></a></li>
    <li><a href="{{ route('neco') }}"><i class="icon icon-pencil"></i> <span>Neco Pin</span></a></li>
    <li><a href="{{ route('market') }}"><i class="icon icon-tint"></i> <span>MarketPlace</span></a></li>
   
    @if(Auth::user()->role == 2)
    {{-- Admin Dashboard --}}
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin Tools</span> <span class="label label-important">6</span></a>
      <ul>
        <li><a href="{{ route('admin') }}">Admin Dashboard</a></li>
        <li><a href="{{ route('users') }}">All Users</a></li>
        <li><a href="{{ route('orders') }}">All Transactions</a></li>
        <li><a href="{{ route('post') }}">Posts</a></li>
        <li><a href="{{ route('settings') }}">Site Settings</a></li>
      </ul>
    </li>
    @endif


  </ul>
</div>
<!--sidebar-menu-->