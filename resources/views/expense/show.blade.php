@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Detail Pengeluaran</h1>
    </div>

    <div class="section-body">
      <div class="invoice">
        <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-icon icon-left mb-4">
          <i class="fas fas fa-arrow-left"></i> Kembali
        </a>
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-md-6">
                  <strong>Karyawan</strong> <br>
                  {{ $expense->employe->nama_lengkap }}<br>
                  <br>
                  <strong>Tanggal</strong> <br>
                  {{ $expense->tanggal }}
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-12">
              <div class="section-title">Daftar Pengeluaran</div>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                  <tr>
                    <th data-width="40">#</th>
                    <th>Pengeluaran</th>
                    <th class="text-center">Kuantitas</th>
                    <th class="text-right">Harga</th>
                  </tr>

                  @foreach ($expense->details as $key => $detail)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $detail->pengeluaran }}</td>
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
                    <div class="invoice-detail-value invoice-detail-value-lg">@money($expense->total_harga)</div>
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
