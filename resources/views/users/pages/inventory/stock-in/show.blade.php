@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Inventories</h1>
      <a class="btn btn-primary" href="{{ route('users.inventories.stock-in') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Stock In - {{ $stock->type->name }}</h5>
      <p class="section-lead">Stock in order Detail: <strong>{{ $stock->order_id }}</strong></p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>{{ $stock->order_id }}</h4>
            </div>

            <div class="card-body">

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection