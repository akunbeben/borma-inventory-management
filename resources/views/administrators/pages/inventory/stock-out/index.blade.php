@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Barang Keluar</h1>
    </div>
    <div class="section-body">
      <h5 class="section-title">Barang Keluar</h5>
      <p class="section-lead">Daftar semua data barang keluar</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Barang Keluar</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.inventory.stock-out') }}">
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
              @if($stocks->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-check"></i>
                </div>
                <h2>Data barang tidak ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data barang keluar.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>No Registrasi</th>
                    <th>Dibuat pada</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                  @foreach($stocks as $stock)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $stock->order_id }}</strong></td>
                    <td>{{ $stock->created_at->format('l, d-m-Y H:i') }}</td>
                    <td><span class="badge badge-primary">{{ $stock->type->name }}</span></td>
                    <td><span class="badge badge-{{ $stock->status->status == 'Draft' ? 'info' : ($stock->status->status == 'Pending' ? 'primary' : ($stock->status->status == 'Approved' ? 'success' : 'danger' ) ) }}">{!! $stock->status->status !!}</span></td>
                    <td class="text-center">
                      <a href="{{ route('administrator.inventory.stock-out.show', $stock->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
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