@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Barang Keluar</h1>
      <a class="btn btn-primary" href="{{ route('administrator.inventory.stock-out') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Barang Keluar - {{ $stock->type->name }}</h5>
      <p class="section-lead">Detail data barang keluar : <strong>{{ $stock->order_id }}</strong></p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>{{ $stock->order_id }}</h4>
              @if($stock->status_id == 1 || $stock->status_id == 2)
              <div class="card-header-action">
                <a href="#" class="btn btn-primary" onclick="event.preventDefault(); approveConfirmation();"><i class="fas fa-check"></i> Terima</a>
                <form id="approve-form" action="{{ route('administrator.inventory.stock-out.approve', $stock->id) }}" method="POST" class="d-none">
                  @csrf
                </form>
                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); rejectConfirmation();"><i class="fas fa-times"></i> Tolak</a>
                <form id="reject-form" action="{{ route('administrator.inventory.stock-out.reject', $stock->id) }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
              @endif
            </div>
            <div class="card-body">
              <div class="card profile-widget">
                <div class="profile-widget-header">
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">ID Order</div>
                      <div class="profile-widget-item-value" style="align-items: center;">{{ $stock->order_id }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Dibuat pada</div>
                      <div class="profile-widget-item-value">{{ $stock->created_at->format('l, d-m-Y H:i') }}</div>
                    </div>
                    @if($stock->status_id == 3)
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Diterima pada</div>
                      <div class="profile-widget-item-value">{{ $stock->updated_at->format('l, d-m-Y H:i') }}</div>
                    </div>
                    @endif
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Tipe</div>
                      <div class="profile-widget-item-value"><span class="badge badge-primary">{{ $stock->type->name }}</span></div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Status</div>
                      <div class="profile-widget-item-value"><span class="badge badge-{{ $stock->status->status == 'Draft' ? 'info' : ($stock->status->status == 'Pending' ? 'primary' : ($stock->status->status == 'Approved' ? 'success' : 'danger' ) ) }}">{!! $stock->status->status !!}</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Daftar barang</h4>
            </div>
            <div class="card-body p-0">
              @if($stock->body->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>Data barang tidak ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data barang.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th>PLU</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                  </tr>
                  @foreach($stock->body as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($data->product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $data->product->product_plu }}</td>
                    <td>{{ $data->product->product_name }}</td>
                    <td>{{ $data->quantity }} {{ $data->product->product_package }}</td>
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
      </div>
      
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
  function approveConfirmation() {
    swal.fire({
      title: 'Terima permintaan barang keluar?',
      text: "Pastikan barang yang akan keluar sudah sesuai.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Terima',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('approve-form').submit();
      }
    })
  }

  function rejectConfirmation() {
    swal.fire({
      title: 'Tolak permintaan barang keluar?',
      text: "Pastikan barang yang akan keluar sudah sesuai.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Tolak',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('reject-form').submit();
      }
    })
  }
</script>
@endsection