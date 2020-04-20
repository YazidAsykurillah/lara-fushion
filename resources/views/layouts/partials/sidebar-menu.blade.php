<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <li class="nav-item">
      <a href="{{ url('home') }}" class="nav-link {{{ (Request::is('home') ? 'active' : '') }}}">
        <i class="nav-icon fa fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('user') }}" class="nav-link {{{ (Request::is('user') ? 'active' : '') }}}">
        <i class="nav-icon fa fa-users"></i>
        <p>
          User
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('period') }}" class="nav-link {{{ (Request::is('period') ? 'active' : '') }}}">
        <i class="nav-icon fa fa-calendar"></i>
        <p>
          Period
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('payroll') }}" class="nav-link {{{ (Request::is('payroll') ? 'active' : '') }}}">
        <i class="nav-icon fa fa-money-check-alt"></i>
        <p>
          Payroll
        </p>
      </a>
    </li>
    
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-database"></i>
        <p>
          Master Data
          <i class="right fa fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('role') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Role</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('permission') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Permission</p>
          </a>
        </li>

      </ul>
    </li>
  </ul>
</nav>