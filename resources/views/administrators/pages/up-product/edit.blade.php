@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Up Produk</h1>
      <a href="{{ route('administrator.up-product') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Up Produk</h5>
      <p class="section-lead">Form tambah Up Produk</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.up-product.update', $data->id) }}" method="post">
              <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="product_id">Barang <span class="text-danger">*</span> <strong class="text-secondary">Pilih salah satu.</strong></label>
                  <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $data->product_id ? 'selected' : null }}>{{ $product->product_plu }} - {{ $product->product_name }}</option>
                    @endforeach
                  </select>
                  @error('product_id')
                  <span class="invalid-feedback" id="productFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="quantity">Jumlah <span class="text-danger">*</span></label>
                  <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity') ?? $data->quantity }}" autocomplete="off">
                  @error('quantity')
                  <span class="invalid-feedback" id="quantityFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="information">Keterangan <span class="text-danger">*</span>
                  </label>
                  <textarea class="form-control @error('information') is-invalid @enderror" name="information" id="information">{{ old('information') ?? $data->information }}</textarea>
                  @error('information')
                  <span class="invalid-feedback" id="informationFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary" onclick="disableButton(this)"><i class="fas fa-save"></i> Simpan</button>
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
  $('#product_id').select2({
    theme: 'bootstrap4'
  });
});
</script>
@endsection