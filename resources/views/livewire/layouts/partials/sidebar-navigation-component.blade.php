<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
     
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                 <li class="nav-devider"></li>
                <li class="nav-small-cap">Admin</li>
                <li> <a class="waves-effect waves-dark" href="{{route('home')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Visas </span></a></li>
                @include('livewire.layouts.partials.inc.user-mgt-nav')

               
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>