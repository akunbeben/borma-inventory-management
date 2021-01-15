@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Non-Food Products</h1>
      <a href="{{ route('administrator.products.non-food.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Add New</a>
    </div>
    <div class="section-body">
      <h5 class="section-title">Non-Food Products</h5>
      <p class="section-lead">List of all Non-food products</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Non-Foods</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.products.non-food.list') }}">
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
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th class="text-center">PLU</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Initial Stock (Qty)</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @if($products->count() <= 0)
                  <tr>
                    <td colspan="6" class="text-center font-weight-normal">
                      <h6>There is no products found.</h6>
                    </td>
                  </tr>
                  @endif
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td class="text-center">{{ $product->product_plu }}</td>
                    <td class="text-center">{{ $product->product_name }}</td>
                    <td class="text-center">{{ $product->product_initial_quantity }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.products.non-food.show', $product->id) }}" class="btn btn-primary btn-sm" title="Details"><i class="fas fa-eye"></i> View</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
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