@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Inventories</h1>
    </div>
    <div class="section-body">
      <h5 class="section-title">Stocks</h5>
      <p class="section-lead">Actual stock of all products</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Stocks</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.inventories.actual-stock') }}">
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
              @if($inventories->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>No inventory data are found.</h2>
                <p class="lead">
                  Sorry we can't find any data, to get rid of this message, make at least 1 entry of product.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th class="text-center">Actual Stock</th>
                    <th class="text-center">Last Stock In</th>
                    <th class="text-center">Date Expired</th>
                    <th class="text-center">Last Stock - Information</th>
                    <th>Category</th>
                  </tr>
                  @foreach($inventories as $inventory)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($inventory->products->first()->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $inventory->products->first()->product_name }}</td>
                    <td class="text-center">{{ $inventory->actual_stock }} {{ $inventory->products->first()->product_package }}</td>
                    <td class="text-center">{{ $inventory->date_stock_in->format('d / m / Y H:i:s') }}</td>
                    <td class="text-center">{{ $inventory->expired_date->format('d / m / Y') }}</td>
                    <td class="text-center">{{ $inventory->information }}</td>
                    <td>{!! $inventory->products->first()->product_type == 1 ? '<span class="badge badge-primary">Food</span>' : '<span class="badge badge-secondary">Non-Food</span>' !!}</td>
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