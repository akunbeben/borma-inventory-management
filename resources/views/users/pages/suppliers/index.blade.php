@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Suppliers</h1>
    </div>

    <div class="section-body">
      <h5 class="section-title">Suppliers</h5>
      <p class="section-lead">List of all suppliers</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Suppliers</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.suppliers.list') }}">
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
              @if($suppliers->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>No suppliers are found.</h2>
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
                    <th>Supplier Name</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Telephone</th>
                    <th>Address</th>
                  </tr>
                  @foreach ($suppliers as $supplier)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td class="text-center">{{ $supplier->supplier_code }}</td>
                    <td class="text-center">+62 {{ $supplier->supplier_telephone }}</td>
                    <td>{{ $supplier->supplier_address }}</td>
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