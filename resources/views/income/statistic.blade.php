@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Statistik</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Pemasukan per minggu</h4>
            </div>
            <div class="card-body">
              <canvas id="incomesChart" height="120"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('javascript')
  <script>
    var ctx = document.getElementById("incomesChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: {!! $incomesChart->map(fn(Flowframe\Trend\TrendValue $value) => $value->date) !!},
        datasets: [{
          label: 'Pengeluaran',
          data: {!! $incomesChart->map(fn(Flowframe\Trend\TrendValue $value) => $value->aggregate) !!},
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
  </script>
@endpush
