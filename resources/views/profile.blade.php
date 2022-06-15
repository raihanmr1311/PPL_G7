@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Profil</h1>
    </div>

    <div class="section-body">
      <h2 class="section-title">Halo, {{ auth()->user()->nama_lengkap }}!</h2>

      <div class="card">
        <div class="card-body row">
          <div class="col-md-6">
            <strong>Nama</strong>
            <br>
            <p>{{ auth()->user()->nama_lengkap }}</p>
          </div>

          <div class="col-md-6">
            <strong>Username</strong>
            <br>
            <p>{{ auth()->user()->nama_pengguna }}</p>
          </div>

          <div class="col-md-6">
            <strong>Alamat</strong>
            <br>
            <p>{{ auth()->user()->alamat }}</p>
          </div>

          <div class="col-md-6">
            <strong>Nomor HP</strong>
            <br>
            <p>{{ auth()->user()->no_hp }}</p>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
