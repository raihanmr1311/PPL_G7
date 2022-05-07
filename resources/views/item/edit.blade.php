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
          <form id="updateForm" class="row" method="POST" action="{{ route('items.update', $item->id) }}">
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

              <span onclick="confirmUpdate(updateForm)" class="btn btn-primary float-right" type="submit">Ubah</span>
              <a href="{{ route('items.index') }}" class="btn btn-outline-primary mr-2 float-right"
              type="submit">Batal</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('javascript')
  <script>
    function confirmUpdate(form) {
      Swal.fire({
          title: 'Apakah anda yakin mengubah data?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          reverseButtons: true,
          cancelButtonText: 'Tidak',
        })
        .then((result) => {
          if (result.isConfirmed) {
            $(form).trigger('submit');
          }
        });
    }
  </script>
@endpush
