@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Tambah Pemasukan</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form class="row" method="POST" action="{{ route('incomes.store') }}">
            @csrf
            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input id="nama_lengkap" value="{{ old('nama_lengkap') }}" type="text" name="nama_lengkap"
                  class="form-control @error('nama_lengkap') is-invalid @enderror">

                @error('nama_lengkap')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              <div class="form-group">
                <label for="nama_pengguna">Nama Pengguna (Username)</label>
                <input id="nama_pengguna" value="{{ old('nama_pengguna') }}" type="text" name="nama_pengguna"
                  class="form-control @error('nama_pengguna') is-invalid @enderror">

                @error('nama_pengguna')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input id="no_hp" value="{{ old('no_hp') }}" type="tel" name="no_hp"
                  class="form-control @error('no_hp') is-invalid @enderror">

                @error('no_hp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input id="alamat" value="{{ old('alamat') }}" type="text" name="alamat"
                  class="form-control @error('alamat') is-invalid @enderror">

                @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="nomor">Nomor</label>
                <input id="nomor" value="{{ old('nomor') }}" type="text" name="nomor"
                  class="form-control @error('nomor') is-invalid @enderror">

                @error('nomor')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>


              <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input id="password" type="password" name="password"
                  class="form-control @error('password') is-invalid @enderror">

                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <button class="btn btn-primary float-right" type="submit">Tambah</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
