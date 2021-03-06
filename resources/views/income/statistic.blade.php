@extends('layouts.app')

@section('title', 'Statistik Pemasukan')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Statistik Pemasukan</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Pemasukan per minggu</h4>
              <div class="card-header-action">
                <form id="rangeForm" action="{{route('incomes.statistic')}}" method="get">
                    <input type="text" name="range" class="form-control incomerange">
                </form>
              </div>
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
          label: 'Pemasukan',
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

    $('.incomerange').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
        drops: 'down',
        startDate: '{{$startWeek}}',
        endDate: '{{$endWeek}}',
        maxDate: '{{$maxDate}}',
        opens: 'left',
        dateLimit: {
            'months': 1,
            'days': -1
        }
      })

    $('.incomerange').change(function () {
        $('#rangeForm').trigger('submit')
    })
  </script>
@endpush
