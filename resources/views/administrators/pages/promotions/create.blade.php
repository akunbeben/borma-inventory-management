@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Promotions</h1>
      <a href="{{ route('administrator.promotions.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Promotions</h5>
      <p class="section-lead">New promotion form</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.promotions.store') }}" method="post">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="product_id">Product <span class="text-danger">*</span> <strong class="text-secondary">Choose product below.</strong></label>
                  <select name="product_id" id="product_id" class="form-control">
                    <option value="">** Select product below. **</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                  </select>
                  @error('product_id')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-row">
                  <div class="col-6 col-md-6 col-lg-6">
                    <label for="start_date">Start date <span class="text-danger">*</span> <strong class="text-secondary">Promotion periode begin. Example. (19/10/2021) </strong></label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date') }}" autocomplete="off">
                    @error('start_date')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-6 col-md-6 col-lg-6">
                    <label for="end_date">End date <span class="text-danger">*</span> <strong class="text-secondary">Promotion periode end. Example. (19/12/2021) </strong></label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date') }}" autocomplete="off">
                    @error('end_date')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="information">Information <span class="text-danger">*</span></label>
                  <textarea class="form-control @error('information') is-invalid @enderror" name="information" id="information">{{ old('information') ?? null }}</textarea>
                  @error('information')
                  <span class="invalid-feedback" id="informationFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary" onclick="disableButton(this)"><i class="fas fa-save"></i> Create</button>
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
    $('#product_id').select2({
      theme: 'bootstrap4',
    });
  });
</script>
@endsection