@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-4 col-md-4 col-lg-4 col-sm-12">
          <div class="card card-warning bg-secondary">
            <div class="card-header">
              <h4 class="font-weight-normal text-dark">Up Produk</h4>
            </div>
            <div class="card-footer text-right">
              <a href="#" class="card-link">Lihat <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-4 col-lg-4 col-sm-12">
          <div class="card card-success bg-secondary">
            <div class="card-header">
              <h4 class="font-weight-normal text-dark">Produk Baru</h4>
            </div>
            <div class="card-footer text-right">
              <a href="#" class="card-link">Lihat <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-4 col-lg-4 col-sm-12">
          <div class="card card-danger bg-secondary">
            <div class="card-header">
              <h4 class="font-weight-normal text-dark">Prepare</h4>
            </div>
            <div class="card-footer text-right">
              <a href="#" class="card-link">Lihat <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-6 col-md-6 col-lg-6-col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="font-weight-normal">Chart 1</h4>
            </div>

            <div class="card-body">
              <canvas id="myChart" width="400" height="200"></canvas>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-6 col-lg-6-col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="font-weight-normal">Chart 2</h4>
            </div>

            <div class="card-body">
              <canvas id="myChart2" width="400" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>

      @if($promo)
      <div class="row">
        <div class="col-6 col-md-6 col-lg-6-col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="font-weight-normal">Promo Terbaru</h4>
            </div>

            <div class="card-body">
              <p>Product: {{ $promo->product->product_name }} &mdash; {{ $promo->product->product_plu }}</p>
              <p>{{ $promo->information }}</p>
              <p>Berakhir dalam {{ $promo->end_date->diffForHumans() }} &mdash; {{ $promo->end_date->format('d M Y') }}</p>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx2 = document.getElementById('myChart2');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection