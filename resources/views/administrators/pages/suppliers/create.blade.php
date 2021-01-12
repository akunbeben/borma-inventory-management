@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Suppliers</h1>
      <a href="{{ route('administrator.suppliers.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Supplier</h5>
      <p class="section-lead">Registration form</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.suppliers.store') }}" method="post" id="form-supplier">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="supplier_name">Supplier Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" id="supplier_name" value="{{ old('supplier_name') }}" autofocus autocomplete="off">
                  @error('supplier_name')
                  <span class="invalid-feedback" id="supplier_nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="supplier_address">Address <span class="text-danger">*</span></label>
                  <textarea class="form-control @error('supplier_address') is-invalid @enderror" name="supplier_address" id="supplier_address">{{ old('supplier_address') !== null ? old('supplier_address') : null }}</textarea>
                  @error('supplier_address')
                  <span class="invalid-feedback" id="supplier_addressFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="supplier_telephone">Telephone <span class="text-danger">*</span> <strong class="text-secondary">Example. (821345678)</strong></label>
                  <input type="number" class="form-control @error('supplier_telephone') is-invalid @enderror" name="supplier_telephone" id="supplier_telephone" value="{{ old('supplier_telephone') }}" autocomplete="off">
                  @error('supplier_telephone')
                  <span class="invalid-feedback" id="supplier_telephoneFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="card-footer text-right">
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