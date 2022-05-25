@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Dasbor</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-boxes"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Produk</h4>
              </div>
              <div class="card-body">
                {{ $itemCount }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Admin</h4>
              </div>
              <div class="card-body">
                {{ $adminCount }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Penjualan bulan ini</h4>
              </div>
              <div class="card-body">
                {{ $monthIncome }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-cart-plus"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pembelian bulan ini</h4>
              </div>
              <div class="card-body">
                {{ $monthExpense }}
              </div>
            </div>
          </div>
        </div>
      </div>
      @owner
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Statistik</h4>
                <div class="card-header-action">
                  <form id="rangeForm" action="{{ route('dashboard') }}" method="get">
                    <input type="text" name="range" class="form-control incomerange">
                  </form>
                </div>
              </div>
              <div class="card-body">
                <canvas id="myChart" height="120"></canvas>
              </div>
            </div>
          </div>
        </div>
      @endowner
    </div>
  </section>
@endsection

@owner
  @push('javascript')
    <script>
      var statistics_chart = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(statistics_chart, {
        type: 'line',
        data: {
          labels: {!! $profitChart->map(fn(Flowframe\Trend\TrendValue $value) => $value->date) !!},
          datasets: [{
            label: 'Keuntungan',
            data: {!! $profitChart->map(fn(Flowframe\Trend\TrendValue $value) => $value->aggregate) !!},
            borderWidth: 5,
            borderColor: '#6777ef',
            backgroundColor: 'transparent',
            pointBackgroundColor: '#fff',
            pointBorderColor: '#6777ef',
            pointRadius: 4
          }]
        },
        options: {
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                stepSize: 150
              }
            }],
            xAxes: [{
              gridLines: {
                color: '#fbfbfb',
                lineWidth: 2
              }
            }]
          },
        }
      });

      $('.incomerange').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
        drops: 'down',
        startDate: '{{$startMonth}}',
        endDate: '{{$endMonth}}',
        maxDate: '{{$maxMonth}}',
        opens: 'left',
      })

    $('.incomerange').change(function () {
        $('#rangeForm').trigger('submit')
    })
    </script>
  @endpush
@endowner
