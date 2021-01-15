@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Products</h1>
    </div>

    <div class="section-body">
      <h5 class="section-title">Food Products</h5>
      <p class="section-lead">List of all food products</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Food</h4>
              @if($products->count() > 0)
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.products.food.list') }}">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') ?? old('search') }}">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              @endif
            </div>
            <div class="card-body p-0">
              @if($products->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>No products are found.</h2>
                <p class="lead">
                  Sorry we can't find any data, contact your administrators to submit the products.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th class="text-center">PLU</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Supplier</th>
                  </tr>
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td class="text-center">{{ $product->product_plu }}</td>
                    <td class="text-center">{{ $product->product_name }}</td>
                    <td class="text-center">{{ $product->supplier->supplier_name }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection