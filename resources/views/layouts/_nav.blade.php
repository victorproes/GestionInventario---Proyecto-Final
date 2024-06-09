<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-name">
                    <p class="name">
                        @if (auth()->check())
                            Bienvenido {{ auth()->user()->name }}
                        @endif
                    </p>
                    <p class="designation">
                        @if (auth()->check() && auth()->user()->roles->isNotEmpty())
                            {{ auth()->user()->roles->first()->name }}
                        @endif
                    </p>
                </div>
            </div>
        </li>
        
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        
        @can('categories.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fa fa-list-alt menu-icon"></i>
                    <span class="menu-title">Categorías</span>
                </a>
            </li>
        @endcan

        @can('clients.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('clients.index') }}">
                    <i class="fa fa-users menu-icon"></i>
                    <span class="menu-title">Clientes</span>
                </a>
            </li>
        @endcan

        @can('products.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="fa fa-box menu-icon"></i>
                    <span class="menu-title">Productos</span>
                </a>
            </li>
        @endcan

        @can('providers.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('providers.index') }}">
                    <i class="fa fa-truck menu-icon"></i>
                    <span class="menu-title">Proveedores</span>
                </a>
            </li>
        @endcan

        @can('purchases.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('purchases.index') }}">
                    <i class="fa fa-shopping-cart menu-icon"></i>
                    <span class="menu-title">Compras</span>
                </a>
            </li>
        @endcan

        @can('sales.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sales.index') }}">
                    <i class="fa fa-shopping-bag menu-icon"></i>
                    <span class="menu-title">Ventas</span>
                </a>
            </li>
        @endcan

        @can('reports.day')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false"
                    aria-controls="page-layouts">
                    <i class="fa fa-chart-line menu-icon"></i>
                    <span class="menu-title">Reportes</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="page-layouts">
                    <ul class="nav flex-column sub-menu">
                        @can('reports.day')
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link" href="{{ route('reports.day') }}">Reportes por día</a>
                            </li>
                        @endcan
                        @can('reports.date')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reports.date') }}">Reportes por fecha</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

        @can('users.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fa fa-user menu-icon"></i>
                    <span class="menu-title">Usuarios</span>
                </a>
            </li>
        @endcan

        @can('roles.index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fa fa-user-tag menu-icon"></i>
                    <span class="menu-title">Roles</span>
                </a>
            </li>
        @endcan

        @can('business.index')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#page-layouts1" aria-expanded="false"
                    aria-controls="page-layouts1">
                    <i class="fa fa-cogs menu-icon"></i>
                    <span class="menu-title">Configuración</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="page-layouts1">
                    <ul class="nav flex-column sub-menu">
                        @can('business.index')
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link" href="{{ route('business.index') }}">Empresa</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan

    </ul>
</nav>
