@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Food Products</h1>
      <a href="{{ route('administrator.products.food.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Add New</a>
    </div>
    <div class="section-body">
      <h5 class="section-title">Food Products</h5>
      <p class="section-lead">List of all food products</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Foods</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.products.food.list') }}">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') ?? old('search') }}">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              @if($products->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>No products data are found.</h2>
                <p class="lead">
                  Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                </p>
                <a href="{{ route('administrator.products.food.create') }}" class="btn btn-primary mt-4">Create new One</a>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th>PLU</th>
                    <th class="text-center">Product Name</th>
                    <th>Supplier</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $product->product_plu }}</td>
                    <td class="text-center">{{ $product->product_name }}</td>
                    <td>{{ $product->supplier->supplier_name }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.products.food.show', $product->id) }}" class="btn btn-primary btn-sm" title="Details"><i class="fas fa-eye"></i> View</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            @if($products->total() > $products->perPage())
            <div class="card-footer">
              {{ $products->links() }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection