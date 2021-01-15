@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Non-Food Products</h1>
      <div class="text-right">
        <a href="{{ route('administrator.products.non-food.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
    </div>

    <div class="section-body">
      <h5 class="section-title">Product Detail</h5>
      <p class="section-lead">Detailed data of &mdash; {{ $product->product_name }}</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Detail</h4>
              <div class="card-header-action">
                <a href="{{ route('administrator.products.non-food.edit', $product->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
              </div>
            </div>
            <div class="card-body">
              <div class="card profile-widget">
                <div class="profile-widget-header">                     
                  <img alt="image" src="{{ asset('storage/images/box-preview.png') }}" class="rounded-circle profile-widget-picture">
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Actual Stock</div>
                      <div class="profile-widget-item-value">0</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Initial Stock (Qty)</div>
                      <div class="profile-widget-item-value">{{ $product->product_initial_quantity }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Created At</div>
                      <div class="profile-widget-item-value">{{ $product->created_at->format('d F Y - H:i') }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Barcode</div>
                      <div class="profile-widget-item-value" style="align-items: center;">{!! DNS1D::getBarcodeSVG($product->product_plu, 'C128B', 1.5, 33) !!}</div>
                    </div>
                  </div>
                </div>
                <div class="profile-widget-description text-center">
                  <div class="profile-widget-name"><strong class="font-weight-normal">{{ $product->product_name }}</strong> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>{{ $product->product_plu }}</div></div>
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
              <h4>Product Supplier</h4>
            </div>
            <div class="card-body">
              <div class="card author-box">
                <div class="card-body">
                  <div class="author-box-left">
                    <img alt="image" src="{{ asset('img/avatar-1.png') }}" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                  </div>
                  <div class="author-box-details">
                    <div class="author-box-name">
                      <a href="#">{{ $product->supplier->supplier_name }}</a>
                    </div>
                    <div class="author-box-job">+62 {{ $product->supplier->supplier_telephone }}</div>
                    <div class="author-box-description">
                      <p>{{ $product->supplier->supplier_address }}</p>
                    </div>
                    <div class="float-right mt-sm-0 mt-3">
                      <a href="{{ route('administrator.suppliers.show', $product->supplier->id ) }}" class="btn">View Supplier <i class="fas fa-chevron-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
  function deleteConfirmation() {
    swal.fire({
      title: 'Delete this Product?',
      text: "All related data to this Product will be deleted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-form').submit();
      }
    })
  }
</script>
@endsection