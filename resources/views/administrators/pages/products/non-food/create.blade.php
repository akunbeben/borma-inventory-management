@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Non-Food Products</h1>
      <a href="{{ route('administrator.products.non-food.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Non-Food Products</h5>
      <p class="section-lead">Register product form</p>

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
                  <label for="product_name">Product Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ old('product_name') }}" autofocus autocomplete="off">
                  @error('product_name')
                  <span class="invalid-feedback" id="product_nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="product_plu">PLU <span class="text-danger">*</span> <strong class="text-secondary">Example. (PRD00012)</strong></label>
                  <input type="text" class="form-control @error('product_plu') is-invalid @enderror" name="product_plu" id="product_plu" value="{{ old('product_plu') }}" autofocus autocomplete="off">
                  @error('product_plu')
                  <span class="invalid-feedback" id="product_pluFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="product_initial_quantity">Initial Stock (Qty) <strong class="text-secondary">Leave blank if no stock.</strong></label>
                  <input type="number" class="form-control @error('product_initial_quantity') is-invalid @enderror" name="product_initial_quantity" id="product_initial_quantity" value="{{ old('product_initial_quantity') ?? 0 }}" autofocus autocomplete="off">
                  @error('product_initial_quantity')
                  <span class="invalid-feedback" id="product_initial_quantityFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-4 col-md-4 col-lg-4">
                      <label for="product_expired_date">Expired Date <span class="text-danger">*</span> <strong class="text-secondary">Example. (19/12/2021)</strong></label>
                      <input type="date" class="form-control @error('product_expired_date') is-invalid @enderror" name="product_expired_date" id="product_expired_date" value="{{ old('product_expired_date') }}" autofocus autocomplete="off">
                      @error('product_expired_date')
                      <span class="invalid-feedback" id="product_expired_dateFeedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="col-8 col-md-8 col-lg-8">
                      <label for="product_supplier">Supplier <span class="text-danger">*</span> <strong class="text-secondary">Choose supplier below.</strong></label>
                      <select name="product_supplier" id="product_supplier" class="form-control @error('product_supplier') is-invalid @enderror">
                        <option aria-readonly="true" value="">-- Select Supplier --</option>
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
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create</button>
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