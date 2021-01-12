@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Suppliers</h1>
      <a href="{{ route('administrator.suppliers.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Add New</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Suppliers List</h5>
      <p class="section-lead">List of all suppliers</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Suppliers</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.suppliers.list') }}">
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
                <table class="table table-striped table-md">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Suppliers Name</th>
                    <th>Suppliers Code</th>
                    <th>Telephone</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @if($suppliers->count() <= 0)
                  <tr>
                    <td colspan="6" class="text-center font-weight-normal">
                      <h6>There is no suppliers found.</h6>
                    </td>
                  </tr>
                  @endif
                  @foreach($suppliers as $supplier)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->supplier_code }}</td>
                    <td>+62 {{ $supplier->supplier_telephone }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.suppliers.show', $supplier->id) }}" class="btn btn-primary btn-sm" title="Details"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              {{ $suppliers->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection