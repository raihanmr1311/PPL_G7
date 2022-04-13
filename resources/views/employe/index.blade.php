@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Data Karyawan</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('employes.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah data
                karyawan</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Nama</th>
                      <th>Nama Pengguna</th>
                      <th>Alamat</th>
                      <th>Nomor</th>
                      <th>Nomor HP</th>
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
@endsection




@push('javascript')
  <script>
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
      ajax: '{{ route('employes.index') }}',
      order: [],
      columns: [{
          searchable: false,
          orderable: false,
          class: 'text-center',
          data: 'DT_RowIndex'
        },
        {
          data: 'nama_lengkap'
        },
        {
          data: 'nama_pengguna'
        },
        {
          data: 'alamat'
        },
        {
          data: 'nomor'
        },
        {
          data: 'no_hp'
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
