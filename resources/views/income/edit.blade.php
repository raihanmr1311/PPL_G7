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
          <form id="formUpdate" class="row" method="POST" action="{{ route('incomes.update', $income->id) }}">
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

              <div class="form-group">
                <label for="">Detail Pemasukan</label>

                <div id="input_container">
                  @foreach ($income->details as $key => $income)
                    <div class="row">

                      <input type="hidden" value="{{ $income->id }}" name="id[]" class="incomeId">
                      <div class="form-group col-xl-4">
                        <select required class="form-control @error('id_barang.*') is-invalid @enderror"
                          name="id_barang.*" id="">
                          @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $income->item->id ? 'selected' : '' }}>
                              {{ $item->nama }}
                            </option>
                          @endforeach
                        </select>
                        @error('id_barang[]')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group col-xl-2">
                        <input placeholder="Kuantitas" id="kuantitas" required
                          value="{{ old('kuantitas[]', $income->kuantitas) }}" type="number" name="kuantitas[]"
                          class="form-control @error('kuantitas.*') is-invalid @enderror">
                        @error('kuantitas.*')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group col-xl-4">
                        <input placeholder="Harga" required id="tanggal" value="{{ old('harga[]', $income->harga) }}"
                          type="number" name="harga[]" class="form-control @error('harga.*') is-invalid @enderror">
                        @error('harga.*')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      @if ($key == 0)
                        <div class="form-group col-xl-2">
                          <a class="btn btn-success" href="javascript:void(0);" id="add_button"
                            title="Add field">TAMBAH</a>
                        </div>
                      @else
                        <div class="form-group col-xl-2">
                          <a class="remove_button btn btn-danger" data-id="{{ $income->id }}"
                            href="javascript:void(0);">HAPUS</a>
                        </div>
                      @endif

                    </div>
                  @endforeach

                </div>
              </div>
              <span onclick="confirmUpdate(updateForm)" class="btn btn-primary float-right" type="submit">Simpan</span>
              <a href="{{ route('incomes.index') }}" class="btn btn-outline-primary mr-2 float-right"
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
    var deleteArray = [];


    var maxField = 10;
    var addButton = $('#add_button');
    var wrapper = $('#input_container');
    var fieldHTML = `
            <div class="row">
                <input type="hidden" value="" name="id[]" class="incomeId">
                <div class="form-group col-xl-4">
                    <select required class="form-control @error('id_barang[]') is-invalid @enderror" name="id_barang[]" id="">
                        @foreach ($items as $item)
                          <option value="{{ $item->id }}" {{ $item->id == $income->item->nama }}>
                            {{ $item->nama }}
                          </option>
                        @endforeach
                    </select>
                    @error('id_barang[]')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                </div>

                <div class="form-group col-xl-2">
                  <input required placeholder="Kuantitas" id="tanggal" value="{{ old('kuantitas[]') }}" type="number"
                    name="kuantitas[]" class="form-control @error('kuantitas[]') is-invalid @enderror">
                  @error('kuantitas[]')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group col-xl-4">
                  <input required placeholder="Harga" id="tanggal" value="{{ old('harga[]') }}" type="number" name="harga[]"
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
      if (x < maxField) {
        x++;
        wrapper.append(fieldHTML);
      }
    });

    wrapper.on('click', '.remove_button', function(e) {
      if ($(this).attr('data-id')) {
        var id = parseInt($(this).attr('data-id'));
        deleteArray.push(id);

        wrapper.append(`<input type="hidden" value=${id} name="deleteId[]" id="deleteId">`)
      }
      e.preventDefault();
      $(this).parent('').parent('').remove(); //Remove field html
      x--;
    });

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
