@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Supplier</h1>
    </div>

    <div class="section-body">
      <h5 class="section-title">Supplier</h5>
      <p class="section-lead">Daftar semua supplier</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Supplier</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.suppliers.list') }}">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari..." name="search" value="{{ request('search') ?? old('search') }}">
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
                <h2>Tidak ada data supplier ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data supplier, silahkan hubungi admin untuk menambahkan data supplier.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Nama Supplier</th>
                    <th class="text-center">Kode Supplier</th>
                    <th class="text-center">Telepon</th>
                    <th>Alamat</th>
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
            @if($suppliers->total() > $suppliers->perPage())
            <div class="card-footer">
              {{ $suppliers->links() }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection