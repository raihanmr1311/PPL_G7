<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Manajemen</li>
    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-chart-area"></i> <span>Dasbor</span>
      </a>
    </li>


    <li class="dropdown {{ request()->routeIs('incomes.*') ? 'active' : '' }}">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-dollar-sign"></i> <span>Pemasukan</span></a>
      <ul class="dropdown-menu">
        <li class="{{ request()->routeIs('incomes.index') || request()->routeIs('incomes.show') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('incomes.index') }}">Data Pemasukan</a></li>
        <li class="{{ request()->routeIs('incomes.create') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('incomes.create') }}">Tambah Pemasukan</a></li>
        <li class="{{ request()->routeIs('incomes.statistic') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('incomes.statistic') }}">Statistik Pemasukan</a></li>
      </ul>
    </li>


    <li class="dropdown {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
      <a href="" class="nav-link has-dropdown"><i class="fas fas fa-cart-plus"></i> <span>Pengeluaran</span></a>
      <ul class="dropdown-menu">
        <li class="{{ request()->routeIs('expenses.index') || request()->routeIs('expenses.show') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('expenses.index') }}">Data Pengeluaran</a></li>
        <li class="{{ request()->routeIs('expenses.create') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('expenses.create') }}">Tambah Pengeluaran</a></li>
        <li class="{{ request()->routeIs('expenses.statistic') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('expenses.statistic') }}">Statistik Pengeluaran</a></li>
      </ul>
    </li>

    <li class="dropdown {{ request()->routeIs('items.*') ? 'active' : '' }}">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-industry"></i> <span>Barang</span></a>
      <ul class="dropdown-menu">
        <li class="{{ request()->routeIs('items.index') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('items.index') }}">Data Barang</a></li>
        <li class="{{ request()->routeIs('items.create') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('items.create') }}">Tambah Barang</a></li>
      </ul>
    </li>

    <li class="menu-header">Karyawan</li>

    <li class="dropdown {{ request()->routeIs('employes.*') ? 'active' : '' }}">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Karyawan</span></a>
      <ul class="dropdown-menu">
        <li class="{{ request()->routeIs('employes.index') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('employes.index') }}">Data Karyawan</a></li>
        <li class="{{ request()->routeIs('employes.create') ? 'active' : '' }}"><a class="nav-link"
            href="{{ route('employes.create') }}">Tambah Karyawan</a></li>
      </ul>
    </li>
  </ul>
</aside>
