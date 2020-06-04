<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Admin Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('create.user') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                        <span>Create Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-grids"></i></div>
                        <span>Prospects</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->