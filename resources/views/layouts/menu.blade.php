<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/pideya/home"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
</li>


<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-toolbox"></i><span>Administrador</span></a>
    <ul class="dropdown-menu">
        @can('usuarios.index')
            <li class="side-menus {{ Request::is('usuarios') ? 'active' : '' }}">
                <a class="nav-link" href="/pideya/usuarios"><i class="fas fa-users"></i><span>Usuarios</span></a>
            </li>
        @endcan

        @can('roles.index')
            <li class="side-menus {{ Request::is('roles') ? 'active' : '' }}">
                <a class="nav-link" href="/pideya/roles"><i class="fas fa-user-lock"></i><span>Roles</span></a>
            </li>
        @endcan
        @can('companies.index')
            <li class="side-menus {{ Request::is('companies') ? 'active' : '' }}">
                <a class="nav-link" href="/pideya/companies"><i class="fas fa-briefcase"></i><span>Empresas</span></a>
            </li>
        @endcan
    </ul>
</li>


<li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-address-book"></i><span>Movimientos</span></a>
    <ul class="dropdown-menu">
        <li class="side-menus {{ Request::is('documents') ? 'active' : '' }}">
            <a class="nav-link beep beep-sidebar" href="/pideya/documents"><i class="fa fa-user-clock"></i>Orden Pedido</a>
        </li>
    </ul>
</li>
