@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Detail Pemasukan</h1>
    </div>

    <div class="section-body">
      <div class="section-body">
        <div class="invoice">
          <div class="invoice-print">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Karyawan</strong> <br>
                    {{ $income->employe->nama_lengkap }}<br>
                    <br>
                    <strong>Tanggal</strong> <br>
                    {{ $income->tanggal }}
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-12">
                <div class="section-title">Daftar Pemasukan</div>
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-md">
                    <tr>
                      <th data-width="40">#</th>
                      <th>Barang</th>
                      <th class="text-center">Kuantitas</th>
                      <th class="text-right">Harga</th>
                    </tr>

                    @foreach ($income->details as $key => $detail)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $detail->item->nama }}</td>
                        <td class="text-center">{{ $detail->kuantitas }}</td>
                        <td class="text-right">@money($detail->harga)</td>
                      </tr>
                    @endforeach

                  </table>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-8">
                  </div>
                  <div class="col-lg-4 text-right">
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-name">Total harga</div>
                      <div class="invoice-detail-value invoice-detail-value-lg">@money($income->total_harga)</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
