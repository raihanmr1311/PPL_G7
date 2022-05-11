<form class="form-inline mr-auto" action="">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
  </ul>
</form>
<ul class="navbar-nav navbar-right">
  <li class="dropdown">
    @owner
    <div id="liveMoney" class="text-white pt-lg-1">Rp</div>
    @endowner
  </li>
  <li class="dropdown"><a href="#" data-toggle="dropdown"
      class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->nama_lengkap }}</div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-title">Halo, {{ auth()->user()->nama_lengkap }}</div>
      @employe
      <a href="{{ route('profile') }}" class="dropdown-item has-icon">
        <i class="far fa-user"></i> Profil
      </a>
      @endemploye
      <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
        <i class="fas fa-sign-out-alt"></i> Keluar
      </a>
    </div>
  </li>
</ul>

@owner
@push('javascript')
  <script>
    function getData(ajaxurl) {
      return $.ajax({
        url: "{{ route('liveMoney') }}",
        type: 'GET',
      });
    };

    async function changeHtmlBalance() {
      var result = await getData();
      $('#liveMoney').html(new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
      }).format(result.data.balance));
      setTimeout(changeHtmlBalance, 5000);
    }

    changeHtmlBalance();
  </script>
@endpush
@endowner
