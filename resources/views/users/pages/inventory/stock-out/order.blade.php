@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Barang Keluar</h1>
      <a class="btn btn-primary" href="{{ route('users.inventories.stock-out') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Barang Keluar - {{ $stock->type->name }}</h5>
      <p class="section-lead">Form data barang keluar: <strong>{{ $stock->order_id }}</strong></p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>{{ $stock->order_id }}</h4>
            </div>
            <form action="{{ route('users.inventories.stock-out.storeChild', $stock->id) }}" method="post">
              @csrf
              <input type="hidden" name="header_id" value="{{ $stock->id }}">
              <div class="card-body">
                <div class="form-row">
                  <div class="col-6 col-md-6 col-lg-6">
                    <label for="product_id">Barang <span class="text-danger">*</span> <strong class="text-secondary">Pilih salah satu.</strong></label>
                    <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                      @foreach($products as $product)
                      <option value="{{ $product->id }}" @if(old('product_id')) selected @endif >{{ $product->product_plu }} - {{ $product->product_name }}</option>
                      @endforeach
                    </select>
                    @error('product_id')
                    <span class="invalid-feedback" id="productFeedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-6 col-md-6 col-lg-6">
                    <label for="quantity">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity') }}" autocomplete="off">
                    @error('quantity')
                    <span class="invalid-feedback" id="quantityFeedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-12 col-md-12 col-lg-12">
                    <label for="information">Keterangan <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('information') is-invalid @enderror" name="information" id="information">{{ old('information') ?? null }}</textarea>
                    @error('information')
                    <span class="invalid-feedback" id="informationFeedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit" onclick="disableButton(this)"><i class="fas fa-arrow-down"></i> Tambahkan kedalam daftar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Daftar barang keluar</h4>
            </div>
            <div class="card-body p-0">
              @if($stock->body->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>Belum ada data barang.</h2>
                <p class="lead">
                  Silahkan tambahkan barang melalui form diatas.
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
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach($stock->body as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->product->product_barcode }}</td>
                    <td>{{ $data->product->product_plu }}</td>
                    <td>{{ $data->product->product_name }}</td>
                    <td>{{ $data->quantity }} {{ $data->product->product_package }}</td>
                    <td>{{ $data->information }}</td>
                    <td class="text-center">
                      <a href="#" class="btn btn-primary btn-sm" onclick="event.preventDefault(); deleteConfirmation();"><i class="fas fa-trash"></i> Hapus</a>
                      <form id="delete-form" action="{{ route('users.inventories.stock-out.destroy', [$stock->id, $data->id]) }}" method="POST" class="d-none">
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
            <div class="card-footer text-right">
              <button onclick="submitConfirmation();" class="btn btn-{{ $stock->body->count() <= 0 ? 'secondary' : 'primary' }}" {{ $stock->body->count() <= 0 ? 'disabled' : null }}><i class="fas fa-pallet"></i> Proses</button>
              <form id="submit-form" action="{{ route('users.inventories.stock-out.submit', $stock->id) }}" method="POST" class="d-none">
                @csrf
              </form>
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
  $(document).ready( function() {
    $('#product_id').select2({
      theme: 'bootstrap4'
    });
  });

  function deleteConfirmation() {
    swal.fire({
      title: 'Hapus barang dari daftar?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, hapus!',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-form').submit();
      }
    })
  }

  function submitConfirmation() {
    swal.fire({
      title: 'Proses data barang masuk?',
      text: 'Pastikan semua barang sudah sesuai.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Lanjutkan Proses',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('submit-form').submit();
      }
    })
  }
</script>
@endsection