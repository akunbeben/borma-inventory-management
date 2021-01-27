@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Produk Baru</h1>
      <a href="{{ route('administrator.new-product') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Produk Baru</h5>
      <p class="section-lead">Form tambah Produk Baru</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.new-product.store') }}" method="post" id="form-supplier">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="product_name">Nama Barang <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ old('product_name') }}" autocomplete="off">
                  @error('product_name')
                  <span class="invalid-feedback" id="product_nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="supplier_id">Supplier <span class="text-danger">*</span> <strong class="text-secondary">Pilih salah satu.</strong></label>
                  <select name="supplier_id" id="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror">
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if(old('supplier_id')) selected @endif>{{ $supplier->supplier_code }} - {{ $supplier->supplier_name }}</option>
                    @endforeach
                  </select>
                  @error('supplier_id')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
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
              <div class="card-footer text-right">
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
$(document).ready( function() {
  $('#supplier_id').select2({
    theme: 'bootstrap4'
  });
});
</script>
@endsection