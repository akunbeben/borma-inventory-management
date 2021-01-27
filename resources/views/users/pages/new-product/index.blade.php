@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Produk Baru</h1>
    </div>

    <div class="section-body">
      <h5 class="section-title">Produk Baru</h5>
      <p class="section-lead">Daftar semua barang - Produk Baru</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Produk Baru</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.new-product') }}">
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
              @if($products->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>Tidak ada data barang ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data barang, silahkan tambahkan data barang.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Keterangan</th>
                  </tr>
                  @foreach($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->supplier->supplier_name }}</td>
                    <td>{{ $product->information }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            @if($products->total() > $products->perPage())
            <div class="card-footer">
              {{ $products->links() }}
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
    title: 'Hapus up produk?',
    icon: 'question',
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