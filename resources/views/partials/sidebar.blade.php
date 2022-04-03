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


    <li class="dropdown">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-industry"></i> <span>Produk</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Data Produk</a></li>
        <li><a class="nav-link" href="">Tambah Produk</a></li>
      </ul>
    </li>

    <li class="menu-header">Karyawan</li>

    <li class="dropdown">
      <a href="" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Karyawan</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Data Karyawan</a></li>
        <li><a class="nav-link" href="">Tambah Karyawan</a></li>
      </ul>
    </li>
  </ul>
</aside>
