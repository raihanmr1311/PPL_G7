@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Tambah Pengeluaran</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form class="row" method="POST" action="{{ route('expenses.store') }}">
            @csrf
            <div class="col">
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input id="tanggal" value="{{ old('tanggal') }}" type="text" name="tanggal"
                  class="form-control datepicker @error('tanggal') is-invalid @enderror">

                @error('tanggal')
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
