@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Barang - Non Food</h1>
      <a href="{{ route('administrator.products.non-food.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Barang - Non Food</h5>
      <p class="section-lead">Form tambah barang Non Food</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.products.non-food.store') }}" method="post" id="form-product">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="product_name">Nama Barang <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ old('product_name') }}" autofocus autocomplete="off">
                  @error('product_name')
                  <span class="invalid-feedback" id="product_nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="product_barcode">Barcode <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('product_barcode') is-invalid @enderror" name="product_barcode" id="product_barcode" value="{{ old('product_barcode') }}" autofocus autocomplete="off">
                  @error('product_barcode')
                  <span class="invalid-feedback" id="product_barcodeFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="product_plu">PLU <span class="text-danger">*</span> <strong class="text-secondary">Contoh. (PRD00012)</strong></label>
                  <input type="text" class="form-control @error('product_plu') is-invalid @enderror" name="product_plu" id="product_plu" value="{{ old('product_plu') }}" autofocus autocomplete="off">
                  @error('product_plu')
                  <span class="invalid-feedback" id="product_pluFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="product_initial_quantity">Stok Awal (Qty) <strong class="text-secondary">Biarkan 0 jika tidak ada stok awal.</strong></label>
                  <input type="number" class="form-control @error('product_initial_quantity') is-invalid @enderror" name="product_initial_quantity" id="product_initial_quantity" value="{{ old('product_initial_quantity') ?? 0 }}" autofocus autocomplete="off">
                  @error('product_initial_quantity')
                  <span class="invalid-feedback" id="product_initial_quantityFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6 col-md-6 col-lg-6 col-sm-12">
                      <label for="min">Min <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('min') is-invalid @enderror" name="min" id="min" value="{{ old('min') }}" autofocus autocomplete="off">
                      @error('min')
                      <span class="invalid-feedback" id="minFeedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="col-6 col-md-6 col-lg-6 col-sm-12">
                      <label for="max">Max <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('max') is-invalid @enderror" name="max" id="max" value="{{ old('max') }}" autofocus autocomplete="off">
                      @error('max')
                      <span class="invalid-feedback" id="maxFeedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-4 col-md-4 col-lg-4">
                      <label for="product_package">Kemasan <span class="text-danger">*</span> <strong class="text-secondary">Contoh. (PCS or Packs)</strong></label>
                      <input type="text" class="form-control @error('product_package') is-invalid @enderror" name="product_package" id="product_package" value="{{ old('product_package') }}" autofocus autocomplete="off">
                      @error('product_package')
                      <span class="invalid-feedback" id="product_packageFeedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="col-4 col-md-4 col-lg-4">
                      <label for="product_expired_date">Tanggal Expired <span class="text-danger">*</span> <strong class="text-secondary">Contoh. (19/12/2021)</strong></label>
                      <input type="date" class="form-control @error('product_expired_date') is-invalid @enderror" name="product_expired_date" id="product_expired_date" value="{{ old('product_expired_date') }}" autofocus autocomplete="off">
                      @error('product_expired_date')
                      <span class="invalid-feedback" id="product_expired_dateFeedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="col-4 col-md-4 col-lg-4">
                      <label for="product_supplier">Supplier <span class="text-danger">*</span> <strong class="text-secondary">Pilih salah satu supplier.</strong></label>
                      <select name="product_supplier" id="product_supplier" class="form-control @error('product_supplier') is-invalid @enderror">
                        <option aria-readonly="true" value="">Daftar Supplier</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                        @endforeach
                      </select>
                      @error('product_supplier')
                      <span class="invalid-feedback" id="product_supplierFeedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right pt-0">
                <button type="submit" class="btn btn-primary" onclick="disableButton(this)"><i class="fas fa-save"></i> Buat</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
$(document).ready(function() {
  $('#product_supplier').select2({
    theme: 'bootstrap4',
  });
});
</script>
@endsection