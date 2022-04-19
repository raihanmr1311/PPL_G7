@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Ubah Data Pemasukan</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form class="row" method="POST" action="{{ route('incomes.update', $income->id) }}">
            @csrf
            @method('PUT')
            <div class="col">
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input id="tanggal" value="{{ $income->tanggal }}" type="text" name="tanggal"
                  class="form-control datepicker @error('tanggal') is-invalid @enderror">

                @error('tanggal')
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
