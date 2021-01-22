@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Promo</h1>
      <div class="section-header-button">
        <a href="{{ route('administrator.promotions.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Tambahkan</a>
      </div>
    </div>
    <div class="section-body">
      <h5 class="section-title">Promo</h5>
      <p class="section-lead">Daftar semua promo</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Promo</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.promotions.list') }}">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari..." name="search" value="{{ request('search') ?? old('search') }}">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              @if($data->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-check"></i>
                </div>
                <h2>Data promo tidak ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data promo, silahkan buat atau tambahkan promo baru.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th>Nama Barang</th>
                    <th>Periode Promo</th>
                    <th>Keterangan</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                  @foreach($data as $promo)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($promo->product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $promo->product->product_name }}</td>
                    <td>{{ $promo->start_date->format('d-m-Y') }} - {{ $promo->end_date->format('d-m-Y') }}</td>
                    <td>{{ $promo->information }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.promotions.edit', $promo->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                      <a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault(); deleteConfirmation();"><i class="fas fa-trash"></i> Hapus</a>
                      <form id="delete-form" action="{{ route('administrator.promotions.destroy', $promo->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            @if($data->total() > $data->perPage())
            <div class="card-footer">
              {{ $data->links() }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
  function deleteConfirmation() {
    swal.fire({
      title: 'Hapus promo ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
          document.getElementById('delete-form').submit();
      }
    })
  }
</script>
@endsection