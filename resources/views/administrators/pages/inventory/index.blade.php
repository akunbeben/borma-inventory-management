@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Inventory</h1>
    </div>
    <div class="section-body">
      <h5 class="section-title">Warehouse Stock</h5>
      <p class="section-lead">Actual stock of all products</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Foods</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.inventory.actual-stock') }}">
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
                    <th>Product Name</th>
                    <th class="text-center">Actual Stock</th>
                    <th class="text-center">Last Stock In</th>
                    <th class="text-center">Date Expired</th>
                    <th class="text-center">Last Stock In - Information</th>
                    <th>Category</th>
                  </tr>
                  @if($inventories->count() <= 0)
                  <tr>
                    <td colspan="7" class="text-center font-weight-normal">
                      <h6>There is no products found.</h6>
                    </td>
                  </tr>
                  @endif
                  @foreach($inventories as $inventory)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($inventory->products->first()->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $inventory->products->first()->product_name }}</td>
                    <td class="text-center">{{ $inventory->actual_stock }}</td>
                    <td class="text-center">{{ $inventory->date_stock_in->format('d / m / Y H:i:s') }}</td>
                    <td class="text-center">{{ $inventory->expired_date->format('d / m / Y') }}</td>
                    <td class="text-center">{{ $inventory->information }}</td>
                    <td>{!! $inventory->products->first()->product_type == 1 ? '<span class="badge badge-primary">Food</span>' : '<span class="badge badge-secondary">Non-Food</span>' !!}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection