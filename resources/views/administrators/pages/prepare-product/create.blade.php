@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Prepare</h1>
      <a href="{{ route('administrator.prepare-product') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Prepare</h5>
      <p class="section-lead">Form tambah Prepare</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.prepare-product.store') }}" method="post" id="form-supplier">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="product_id">Barang <span class="text-danger">*</span> <strong class="text-secondary">Pilih salah satu.</strong></label>
                  <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" @if(old('product_id')) selected @endif>{{ $product->product_plu }} - {{ $product->product_name }}</option>
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
                  <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity') }}" autocomplete="off">
                  @error('quantity')
                  <span class="invalid-feedback" id="quantityFeedback">
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
  $('#product_id').select2({
    theme: 'bootstrap4'
  });
});
</script>
@endsection