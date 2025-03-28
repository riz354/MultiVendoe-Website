<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item   {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @if (Auth::guard('admin')->user()->type == 'super-admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ request()->routeIs('admin,update-password') ? 'active' : '' }} )"> <a
                                class="nav-link" href="{{ route('admin.update-password') }}">Update Password</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('admin.update-admin-details') }}">Update Details</a></li>

                    </ul>
                </div>
            </li>
        @elseif (Auth::guard('admin')->user()->type == 'vendor')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Vendor Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ request()->routeIs('admin.update-vendor-details') ? 'active' : '' }} )">
                            <a class="nav-link"
                                href="{{ route('admin.update-vendor-details', ['slug' => 'personal']) }}">Update
                                Details</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Catalogue Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.catelogue.section.index') ||request()->routeIs('admin.catelogue.section.create') ||request()->routeIs('admin.catelogue.section.edit') ? 'show' : '' }}" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('admin.catelogue.section.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.catelogue.section.index')}}">Sections</a></li>


                    <li class="nav-item {{ request()->routeIs('admin.catelogue.categories.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.catelogue.categories.index')}}">Categories</a></li>
                    <li class="nav-item {{ request()->routeIs('admin.catelogue.brand.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.catelogue.brand.index')}}">Brands</a></li>
                    <li class="nav-item {{ request()->routeIs('admin.catelogue.product.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.catelogue.product.index')}}">Products</a></li>
                    <li class="nav-item {{ request()->routeIs('admin.catelogue.coupon.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.catelogue.coupon.index')}}">Coupon</a></li>
                    <li class="nav-item {{ request()->routeIs('admin.permission.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.permission.index')}}">Permissions</a></li>
                    <li class="nav-item {{ request()->routeIs('admin.role.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.role.index')}}">Role</a></li>
                    <li class="nav-item {{ request()->routeIs('admin.index') ? 'active ' : '' }}"><a class="nav-link"  href="{{route('admin.index')}}">User</a></li>


                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic
                            table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html">
                            Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#error" aria-expanded="false"
                aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500
                        </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../../docs/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
