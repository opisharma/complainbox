<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('img/logo_nub.png')}}" class="logo-icon" alt="logo icon">
        </div>
        {{-- <div>
            <h4 class="logo-text">Syndron</h4>
        </div> --}}
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if(Request::is( 'admin*' ))
        <li class="{{ Request::is('admin/dashboard') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="treeview {{ Request::is('admin/category/*') || Request::is() ? 'mm-active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Department</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.category.create') }}">New Department</a>
                </li>
                <li>
                    <a href="{{ route('admin.category.index') }}">Department List</a>
                </li>
            </ul>
        </li>
        
        <li class="treeview {{ Request::is('admin/sub_category') || Request::is() ? 'mm-active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-user"></i>
            </div>
            <div class="menu-title">Employee</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.sub_category.create') }}">New Employee</a>
                </li>
                <li>
                    <a href="{{ route('admin.sub_category.index') }}">Employee List</a>
                </li>
            </ul>
        </li>
        <li class="treeview {{ Request::is('admin/users/*') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-group"></i>
            </div>
            <div class="menu-title">Student</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.users.create') }}">New Student</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}">Student List</a>
                </li>
            </ul>
        </li>

        <li class="{{ Request::is('admin/u/*') ? 'mm-active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-group"></i>
            </div>
            <div class="menu-title">Users</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.u.create') }}">New User</a>
                </li>
                <li>
                    <a href="{{ route('admin.u.index') }}">User Lists</a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::is('admin/emails/*') ? 'mm-active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-envelope-open"></i>
            </div>
            <div class="menu-title">Complains or Suggestions</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.emails') }}">Inboxes</a>
                </li>
            </ul>
        </li>
        @endif

        {{-- author route --}}
        @if(Request::is( 'author*' ))
        <li class="{{ Request::is('author/dashboard') ? 'mm-active' : '' }}">
            <a href="{{ route('author.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="{{ Request::is('author/emails/*') ? 'mm-active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-envelope-open"></i>
            </div>
            <div class="menu-title">Complains or Suggestions</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('author.emails') }}">Inboxes</a>
                </li>
            </ul>
        </li>
        @endif

        {{-- subscirber route --}}
        @if( Request::is( 'user*' ) || Request::is( 'email' ) || Request::is( 'email/*' ) )

            <li class="{{ Request::is('user/dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('user.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('user/emails/*') ? 'mm-active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><div class="parent-icon"><i class="bx bx-envelope-open"></i>
                </div>
                <div class="menu-title">Complains or Suggestions</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('user.emails') }}">Application Status</a>
                    </li>
                    <li>
                        <a href="{{ route('user.email.form') }}">Complain or Suggestion</a>
                    </li>
                </ul>
            </li>

        @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->