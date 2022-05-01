<form class="form-inline mr-auto" action="">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
  </ul>
</form>
<ul class="navbar-nav navbar-right">
  <li class="dropdown">
    <div id="liveMoney" class="text-white pt-lg-1">Rp.</div>
  </li>
  <li class="dropdown"><a href="#" data-toggle="dropdown"
      class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->nama_lengkap }}</div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-title">Halo, {{ auth()->user()->nama_lengkap }}</div>
      <div class="dropdown-divider"></div>
      <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
        <i class="fas fa-sign-out-alt"></i> Keluar
      </a>
    </div>
  </li>
</ul>

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
      $('#liveMoney').html(`Rp. ${result.data.balance}`);
      setTimeout(changeHtmlBalance, 2000);
    }

    changeHtmlBalance();
  </script>
@endpush
