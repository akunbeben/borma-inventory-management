@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Supplier</h1>
      <a href="{{ route('administrator.suppliers.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Tambah supplier</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">Daftar Supplier</h5>
      <p class="section-lead">Daftar semua supplier</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Supplier</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.suppliers.list') }}">
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
                <h2>Data supplier tidak ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data supplier, silahkan buat atau tambahkan supplier baru.
                </p>
                <a href="{{ route('administrator.suppliers.create') }}" class="btn btn-primary mt-4">Tambahkan</a>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Nama Supplier</th>
                    <th>Kode Supplier</th>
                    <th>Telepon</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                  @foreach($suppliers as $supplier)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->supplier_code }}</td>
                    <td>+62 {{ $supplier->supplier_telephone }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.suppliers.show', $supplier->id) }}" class="btn btn-primary btn-sm" title="Details"><i class="fas fa-eye"></i> Lihat</a>
                    </td>
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