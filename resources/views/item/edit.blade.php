@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Ubah Data Barang</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form class="row" method="POST" action="{{ route('items.update', $item->id) }}">
            @method('PUT')
            @csrf
            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label for="nama">Nama Barang</label>
                <input id="nama" value="{{ $item->nama }}" type="text" name="nama"
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
                <input id="harga" value="{{ $item->harga }}" type="text" name="harga"
                  class="form-control @error('harga') is-invalid @enderror">

                @error('harga')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <button class="btn btn-primary float-right" type="submit">Ubah</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
