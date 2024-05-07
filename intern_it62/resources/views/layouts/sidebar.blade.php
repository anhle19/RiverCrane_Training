<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('users') }}">Admin RiverCrane</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('users') }}"></a>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ Request::is('/') || Request::is('users') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('users') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý User"><i
                        class="fas fa-hand-point-right"></i>
                    <span>Quản lý User</span>
                </a>
            </li>
            <li class="{{ Request::is('customers') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('customers') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Customer"><i
                        class="fas fa-hand-point-right"></i>
                    <span>Quản lý Customer</span>
                </a>
            </li>
            <li class="{{ Request::is('products') || Request::is('products/add') || Request::is('products/edit/*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('products') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Product"><i
                        class="fas fa-hand-point-right"></i>
                    <span>Quản lý Product</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('logout') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Đăng xuất"><i
                        class="fas fa-hand-point-right"></i>
                    <span class="text-danger">Đăng xuất</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
