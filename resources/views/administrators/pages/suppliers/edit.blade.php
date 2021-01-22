@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Supplier</h1>
      <a href="{{ route('administrator.suppliers.show', $supplier->id) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Supplier</h5>
      <p class="section-lead">Form edit supplier &mdash; {{ $supplier->supplier_name }}</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.suppliers.update', $supplier->id) }}" method="post" id="form-supplier">
              <div class="card-body">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $supplier->id }}">
                <div class="form-group">
                  <label for="supplier_name">Nama Supplier <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" id="supplier_name" value="{{ old('supplier_name') ?? $supplier->supplier_name }}" autofocus autocomplete="off">
                  @error('supplier_name')
                  <span class="invalid-feedback" id="supplier_nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="supplier_address">Alamat <span class="text-danger">*</span></label>
                  <textarea class="form-control @error('supplier_address') is-invalid @enderror" name="supplier_address" id="supplier_address">{{ old('supplier_address') ?? $supplier->supplier_address }}</textarea>
                  @error('supplier_address')
                  <span class="invalid-feedback" id="supplier_addressFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="supplier_telephone">Telepon <span class="text-danger">*</span> <strong class="text-secondary">Contoh. (821345678)</strong></label>
                  <input type="number" class="form-control @error('supplier_telephone') is-invalid @enderror" name="supplier_telephone" id="supplier_telephone" value="{{ old('supplier_telephone') ?? $supplier->supplier_telephone }}">
                  @error('supplier_telephone')
                  <span class="invalid-feedback" id="supplier_telephoneFeedback">
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