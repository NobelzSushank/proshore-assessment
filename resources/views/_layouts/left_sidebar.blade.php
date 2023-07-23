<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @can('admin')
                <li>
                    <a href="{{ route('user.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Customer Section</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Questionnaire Section</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('questionnaire.create') }}">
                                <span data-key="t-calendar">Create</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('questionnaire.index') }}">
                                <span data-key="t-chat">List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                <li>
                    <a href="{{ route('questionnaire.list') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">Play Quiz</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}">
                        <i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                        <span data-key="t-dashboard">Logout</span>
                    </a>
                </li>

            </ul>

            
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
