@extends('layouts.app')

@section('title', 'Tambah Pengeluaran')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Tambah Pengeluaran</h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <form id="createForm" class="row" method="POST" action="{{ route('expenses.store') }}">
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
              <div class="form-group">
                <label for="">Detail Pengeluaran</label>

                <div id="input_container">
                  <div class="row">
                    <div class="form-group col-xl-4">
                      <input placeholder="Pengeluaran" id="tanggal" type="text" name="pengeluaran[]"
                        class="form-control @error('pengeluaran.*') is-invalid @enderror">
                      @error('pengeluaran.*')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group col-xl-2">
                      <input placeholder="Kuantitas" id="tanggal" type="number" name="kuantitas[]"
                        class="form-control @error('kuantitas.*') is-invalid @enderror">
                      @error('kuantitas.*')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group col-xl-4">
                      <input placeholder="Harga" id="tanggal" type="number" name="harga[]"
                        class="form-control @error('harga.*') is-invalid @enderror">
                      @error('harga.*')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group col-xl-2">
                      <a class="btn btn-success" href="javascript:void(0);" id="add_button" title="Add field">TAMBAH</a>
                    </div>

                  </div>
                </div>
              </div>

              <button class="btn btn-primary float-right" type="submit">Simpan</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection


@push('javascript')
  <script>
    var maxField = 10;
    var addButton = $('#add_button');
    var wrapper = $('#input_container');
    var fieldHTML = `
            <div class="row">
                <div class="form-group col-xl-4">
                 <input placeholder="Pengeluaran" id="tanggal" type="text"
                    name="pengeluaran[]" class="form-control @error('pengeluaran[]') is-invalid @enderror">
                  @error('pengeluaran[]')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group col-xl-2">
                  <input placeholder="Kuantitas" id="tanggal" type="number"
                    name="kuantitas[]" class="form-control @error('kuantitas[]') is-invalid @enderror">
                  @error('kuantitas[]')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group col-xl-4">
                  <input placeholder="Harga" id="tanggal"  type="number" name="harga[]"
                    class="form-control @error('harga[]') is-invalid @enderror">
                  @error('harga[]')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group col-xl-2">
                  <a class="remove_button btn btn-danger" href="javascript:void(0);">HAPUS</a>
                </div>
            </div>

    `;
    var x = 1;

    addButton.on('click', function() {
      console.log('test')
      if (x < maxField) {
        console.log(x)
        x++;
        wrapper.append(fieldHTML); //Add field html
      }
    });

    wrapper.on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).parent('').parent('').remove(); //Remove field html
      x--;
    });

$("#createForm").validate({
  rules: {
    'pengeluaran[]': {
      required: true
    },
    'harga[]': {
      required: true
    },
    'kuantitas[]': {
      required: true
    },
  },
  errorElement: "em",
	errorPlacement: function ( error, element ) {
	    error.addClass( "invalid-feedback" );
	},
	highlight: function ( element, errorClass, validClass ) {
	    $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
	},
	unhighlight: function (element, errorClass, validClass) {
	    $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
	}
});
  </script>
@endpush
