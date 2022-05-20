@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Profil</h1>
    </div>

    <div class="section-body">
      <h2 class="section-title">Halo, {{ auth()->user()->nama_lengkap }}!</h2>
      <p class="section-lead">
        Ubah data diri anda disini
      </p>

      <div class="row">
        <div class="col">
          <div class="card">
            <form method="post" action="{{ route('updateProfile') }}">
              @csrf
              <div class="card-header">
                <h4>Ubah Profil</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input id="nama_lengkap" name="nama_lengkap" type="text"
                      class="form-control @error('nama_lengkap') is-invalid @enderror"
                      value="{{ auth()->user()->nama_lengkap }}" required>

                    @error('nama_lengkap')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6 col-12">
                    <label for="nama_pengguna">Username</label>
                    <input id="nama_pengguna" name="nama_pengguna" type="text"
                      class="form-control @error('nama_pengguna') is-invalid @enderror"
                      value="{{ auth()->user()->nama_pengguna }}" required>

                    @error('nama_pengguna')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6 col-12">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" name="alamat" type="text"
                      class="form-control @error('alamat') is-invalid @enderror" value="{{ auth()->user()->alamat }}"
                      required>

                    @error('alamat')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6 col-12">
                    <label for="no_hp">Nomor HP</label>
                    <input id="no_hp" name="no_hp" type="tel" class="form-control @error('no_hp') is-invalid @enderror"
                      value="{{ auth()->user()->no_hp }}" required>

                    @error('no_hp')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>

          <div class="card">
            <form method="post" action="{{ route('updatePassword') }}">
              @csrf
              <div class="card-header">
                <h4>Ubah Kata Sandi</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-12">
                    <label for="current_password">Kata sandi sekarang</label>
                    <input id="current_password" name="current_password" type="password"
                      class="form-control @error('current_password') is-invalid @enderror" required>

                    @error('current_password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6 col-12">
                    <label for="password">Kata sandi baru</label>
                    <input id="password" name="password" type="password"
                      class="form-control @error('password') is-invalid @enderror" required>

                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6 col-12">
                    <label for="password_confirmation">Konfirmasi kata sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                      class="form-control @error('password_confirmation') is-invalid @enderror" required>

                    @error('password_confirmation')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Ubah kata sandi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@push('javascript')
  <script>
    @if ($message = Session::get('success'))
      iziToast.success({
        title: '{{ $message }}',
        position: 'topRight',
      });
    @else
      if ($message = Session::get('error'))
        iziToast.error({
          title: '{{ $message }}',
          position: 'topRight',
        });
    @endif
  </script>
@endpush
