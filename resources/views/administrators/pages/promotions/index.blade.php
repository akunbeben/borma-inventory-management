@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Promotions</h1>
      <div class="section-header-button">
        <a href="{{ route('administrator.promotions.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Add New</a>
      </div>
    </div>
    <div class="section-body">
      <h5 class="section-title">Promotions</h5>
      <p class="section-lead">List of all promotions</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Promotions</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.promotions.list') }}">
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
              @if($data->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-check"></i>
                </div>
                <h2>There is no <code>Promotion</code> found.</h2>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Periode</th>
                    <th>Information</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach($data as $promo)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! DNS1D::getBarcodeSVG($promo->product->product_plu, 'C128B', 1.5, 33); !!}</td>
                    <td>{{ $promo->product->product_name }}</td>
                    <td>{{ $promo->start_date->format('d-m-Y') }} - {{ $promo->end_date->format('d-m-Y') }}</td>
                    <td>{{ $promo->information }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.promotions.edit', $promo->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault(); deleteConfirmation();"><i class="fas fa-trash"></i> Delete</a>
                      <form id="delete-form" action="{{ route('administrator.promotions.destroy', $promo->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
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

@section('js-section')
<script>
  function deleteConfirmation() {
    swal.fire({
      title: 'Delete this promotion?',
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