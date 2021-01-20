@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Inventory</h1>
      <a class="btn btn-primary" href="{{ route('administrator.inventory.stock-out') }}"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Stock Out - {{ $stock->type->name }}</h5>
      <p class="section-lead">Stock out order Detail: <strong>{{ $stock->order_id }}</strong></p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>{{ $stock->order_id }}</h4>
            </div>
            <div class="card-body">
              <div class="card profile-widget">
                <div class="profile-widget-header">
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Order ID</div>
                      <div class="profile-widget-item-value" style="align-items: center;">{{ $stock->order_id }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Date Created</div>
                      <div class="profile-widget-item-value">{{ $stock->created_at->format('l, d-m-Y H:i') }}</div>
                    </div>
                    @if($stock->status_id == 3)
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Approved at</div>
                      <div class="profile-widget-item-value">{{ $stock->updated_at->format('l, d-m-Y H:i') }}</div>
                    </div>
                    @endif
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Stock Out Type</div>
                      <div class="profile-widget-item-value"><span class="badge badge-primary">{{ $stock->type->name }}</span></div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Status</div>
                      <div class="profile-widget-item-value"><span class="badge badge-{{ $stock->status->status == 'Draft' ? 'info' : ($stock->status->status == 'Pending' ? 'primary' : ($stock->status->status == 'Approved' ? 'success' : 'danger' ) ) }}">{!! $stock->status->status !!}</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Products to Stock Out</h4>
            </div>
            <div class="card-body p-0">
              @if($stock->body->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>There is no products to stock out.</h2>
                <p class="lead">
                  You can sumbit the products on the form above.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th>PLU</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Information</th>
                  </tr>
                  @foreach($stock->body as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($data->product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $data->product->product_plu }}</td>
                    <td>{{ $data->product->product_name }}</td>
                    <td>{{ $data->quantity }} {{ $data->product->product_package }}</td>
                    <td>{{ $data->information }}</td>
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