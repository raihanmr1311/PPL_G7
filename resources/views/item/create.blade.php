@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Tambah Barang</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form class="row" method="POST" action="{{ route('items.store') }}">
            @csrf
            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label for="nama">Nama Barang</label>
                <input id="nama" value="{{ old('nama') }}" type="text" name="nama"
                  class="form-control @error('nama') is-invalid @enderror">

                @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label for="harga">Harga</label>
                <input id="harga" value="{{ old('harga') }}" type="number" name="harga"
                  class="form-control @error('harga') is-invalid @enderror">

                @error('harga')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <button class="btn btn-primary float-right" type="submit">Simpan</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
