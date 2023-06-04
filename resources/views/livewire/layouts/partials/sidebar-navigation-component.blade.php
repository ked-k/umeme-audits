<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
     
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                 <li class="nav-devider"></li>
                <li class="nav-small-cap">Admin</li>
                <li> <a class="waves-effect waves-dark" href="{{route('home')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('audits')}}"><i class="fa fa-fax"></i><span class="hide-menu">Field Audits </span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('official.audit')}}"><i class="fa fa-vcard-o"></i><span class="hide-menu">Received Meters </span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('official.issued')}}"><i class="fa fa-vcard-o"></i><span class="hide-menu">Issued Meters </span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-cogs"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse">  
                        <li><a href="{{route('feeders')}}">Feeders</a></li>
                        <li><a href="{{route('meterTypes')}}">Meter Types</a></li>                      
                        <li><a href="{{route('districts')}}">Districts</a></li>                      
                        <li><a href="{{route('zones')}}">Zones</a></li>                      
                        @include('livewire.layouts.partials.inc.user-mgt-nav')
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>