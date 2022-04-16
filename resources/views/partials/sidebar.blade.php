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


    <li class="dropdown">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-dollar-sign"></i> <span>Pemasukan</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Data Pemasukan</a></li>
        <li><a class="nav-link" href="">Tambah Pemasukan</a></li>
      </ul>
    </li>

    <li class="dropdown">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-cart-plus"></i> <span>Pengeluaran</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Data Pengeluaran</a></li>
        <li><a class="nav-link" href="">Tambah Pengeluaran</a></li>
      </ul>
    </li>


    <li class="dropdown {{ request()->routeIs('items.*') ? 'active' : '' }}">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-industry"></i> <span>Barang</span></a>
      <ul class="dropdown-menu">
        <li class="{{ request()->routeIs('items.index') ? 'active' : '' }}"><a class="nav-link" href="{{route('items.index')}}">Data Barang</a></li>
        <li class="{{ request()->routeIs('items.create') ? 'active' : '' }}"><a class="nav-link" href="{{route('items.create')}}">Tambah Barang</a></li>
      </ul>
    </li>

    <li class="menu-header">Karyawan</li>

    <li class="dropdown {{ request()->routeIs('employes.*') ? 'active' : '' }}">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Karyawan</span></a>
      <ul class="dropdown-menu">
        <li class="{{ request()->routeIs('employes.index') ? 'active' : '' }}"><a class="nav-link" href="{{route('employes.index')}}">Data Karyawan</a></li>
        <li class="{{ request()->routeIs('employes.create') ? 'active' : '' }}"><a class="nav-link" href="{{route('employes.create')}}">Tambah Karyawan</a></li>
      </ul>
    </li>
  </ul>
</aside>
