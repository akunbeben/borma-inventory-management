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
              <h4 class="font-weight-normal">Promo Terbaru</h4>
            </div>

            <div class="card-body p-0">
              @if($promo->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>Belum ada promo.</h2>
                <p class="lead">
                  Belum ada promo yang ditambahkan ke sistem.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Nama Barang</th>
                    <th>Periode</th>
                    <th>Keterangan</th>
                  </tr>
                  @foreach($promo as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->product->product_name }}</td>
                    <td>{{ $data->start_date->format('d M Y') }} &mdash; {{ $data->end_date->format('d M Y') }}</td>
                    <td>{{ $data->information }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
          </div>
        </div>
        <div class="col-6 col-md-6 col-lg-6-col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="font-weight-normal">Realisasi Ordering</h4>
            </div>

            <div class="card-body">
              <canvas id="myChart" width="400" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
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