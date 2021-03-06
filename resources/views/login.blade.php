<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
  <title>Login &mdash; {{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="80"
              class="shadow-light rounded-circle mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">Selamat datang di <span
                class="font-weight-bold">{{ config('app.name') }}</span>
            </h4>
            <p class="text-muted">Silahkan login.</p>
            <form method="POST" action="{{ route('login') }}">
              @error('authError')
                <div class="alert alert-danger">
                  {{ $message }}
                </div>
              @enderror
              <div class="form-group">
                <label for="nama_pengguna">Nama Pengguna</label>
                <input id="nama_pengguna" oninvalid="this.setCustomValidity('Username dan password harus diisi')"
                  oninput="this.setCustomValidity('')" type="text" class="form-control" name="nama_pengguna"
                  tabindex="1" required autofocus>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Kata Sandi</label>
                </div>
                <input id="password" oninvalid="this.setCustomValidity('Username dan password harus diisi')"
                  oninput="this.setCustomValidity('')" type="password" name="password" class="form-control"
                  name="password" tabindex="2" required>
              </div>

              <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Masuk
                </button>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
            </div>
          </div>
        </div>
        <div
          class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
          data-background="{{ asset('assets/img/' . rand(1, 2) . '.jpeg') }}">
        </div>
      </div>
    </section>
  </div>
  <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
