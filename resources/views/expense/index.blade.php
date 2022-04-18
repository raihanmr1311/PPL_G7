@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Data Pengeluaran</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('expenses.create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Pengeluaran</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Karyawan</th>
                      <th>Total Barang</th>
                      <th>Total Harga</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <form class="modal-part" id="modal_create" method="POST" action="{{ route('expenses.store') }}">
    @csrf
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
  </form>
@endsection




@push('javascript')
  <script>
    $("#modal_btn").fireModal({
      title: 'Tambah data pengeluaran',
      body: $("#modal_create"),
      footerClass: 'bg-whitesmoke',
      autoFocus: false,
      onFormSubmit: function(modal, e, form) {},
      shown: function(modal, form) {
        console.log(form)
      },
      buttons: [{
        text: 'Tambah',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function(modal) {}
      }]
    });


    @if ($message = Session::get('success'))
      iziToast.success({
      title: '{{ $message }}',
      position: 'topRight',
      });
    @elseif($message = Session::get('error'))
      iziToast.success({
      title: '{{ $message }}',
      position: 'topRight',
      });
    @endif
    $("#table-1").dataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: '{{ route('expenses.index') }}',
      columns: [{
          orderable: false,
          searchable: false,
          class: 'text-center',
          data: 'DT_RowIndex'
        },
        {
          data: 'karyawan',
          name: 'employe.nama_lengkap'
        },
        {
          data: 'total_barang'
        },
        {
          data: 'total_harga'
        },
        {
          data: 'tanggal'
        },
        {
          searchable: false,
          orderable: false,
          data: 'action'
        },
      ]
    });

    function confirmDelete(form) {
      Swal.fire({
          title: 'Apakah anda yakin?',
          text: 'Data yang sudah dihapus tidak bisa dikembalikan lagi',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya',
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
