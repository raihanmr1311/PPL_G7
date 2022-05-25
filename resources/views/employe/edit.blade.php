@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Ubah Data Karyawan</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form class="row" method="POST" action="{{ route('employes.update', $employe->id) }}">
            @method('PUT')
            @csrf

            <div class="col-12">
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input id="nama_lengkap" value="{{ $employe->nama_lengkap }}" type="text" name="nama_lengkap"
                  class="form-control @error('nama_lengkap') is-invalid @enderror">

                @error('nama_lengkap')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              <div class="form-group">
                <label for="nama_pengguna">Nama Pengguna (Username)</label>
                <input id="nama_pengguna" value="{{ $employe->nama_pengguna }}" type="text" name="nama_pengguna"
                  class="form-control @error('nama_pengguna') is-invalid @enderror">

                @error('nama_pengguna')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input id="alamat" value="{{ $employe->alamat }}" type="text" name="alamat"
                  class="form-control @error('alamat') is-invalid @enderror">

                @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select id="kabupaten" class="form-control regencySelect">
                    <option value="{{$employe->district->regency->id}}" selected="selected">
                        {{ ucwords(strtolower($employe->district->regency->name))}}
                    </option>
                </select>
              </div>

              <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input id="no_hp" value="{{ $employe->no_hp }}" type="tel" name="no_hp"
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
                <label for="kecamatan">Kecamatan</label>
                <select class="form-control districtSelect" name="district_id" id="kecamatan">
                    <option value="{{$employe->district->id}}" selected="selected">
                        {{ ucwords(strtolower($employe->district->name))}}
                    </option>
                </select>

                @error('district_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="nomor">Nomor</label>
                <input id="nomor" value="{{ $employe->nomor }}" type="text" name="nomor"
                  class="form-control @error('nomor') is-invalid @enderror">

                @error('nomor')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col">
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

              <button class="btn btn-primary float-right" type="submit">Ubah</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('javascript')
  <script>
    var regencyId = '{{$employe->district->regency->id}}';

    function refreshDistrict() {
      $('.districtSelect').select2({
        placeholder: "Pilih kecamatan",
        minimumResultsForSearch: Infinity,
        ajax: {
          url: '{{ route('districtList') }}',
          dataType: 'json',
          data: function(params) {
            var query = {
              regency_id: regencyId
            }
            return query;
          },
          processResults: function(data) {
            return {
              results: data.data
            };
          }
        }
      });
    }


    $(document).ready(function() {
      $('.regencySelect').on('select2:select', function(e) {
        var data = e.params.data;
        regencyId = data.id;

        $(".districtSelect").val('').trigger('change')
        refreshDistrict();
      });


      refreshDistrict(true);
      $('.regencySelect').select2({
        placeholder: "Pilih kabupaten",
        minimumResultsForSearch: Infinity,
        ajax: {
          url: '{{ route('regencyList') }}',
          dataType: 'json',
          processResults: function(data) {
            return {
              results: data.data
            };
          }
        }
      });
    })
  </script>
@endpush
