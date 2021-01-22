@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Barang Masuk</h1>
      <div class="text-center">
        <button class="btn btn-primary" data-toggle="modal" data-target="#fire-modal-create"><i class="fas fa-receipt"></i> Tambahkan</button>
      </div>
    </div>
    <div class="section-body">
      <h5 class="section-title">Barang Masuk</h5>
      <p class="section-lead">Daftar data barang masuk</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Barang Masuk</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.inventories.stock-in') }}">
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
                <h2>Tidak ada data barang masuk ditemukan.</h2>
                <p class="lead">
                  Anda bisa menambahkan data barang masuk di form ini.
                </p>
                <a href="#" class="btn btn-primary mt-4" data-toggle="modal" data-target="#fire-modal-create">Tambahkan</a>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>ID Order</th>
                    <th>Tanggal dibuat</th>
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
                      <a href="{{ route('users.inventories.stock-in.show', $stock->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                    @if($stock->status->status == 'Draft')
                      <a href="{{ route('users.inventories.stock-in.order', $stock->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pallet"></i> Proses</a>
                    @endif
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            @if($stocks->total() > $stocks->perPage())
            <div class="card-footer">
              {{ $stocks->links() }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="fire-modal-create">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Barang Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{ route('users.inventories.stock-in.store-order') }}" method="post" id="form-create" onsubmit="handleOnSubmit()">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <select name="stock_in_type" id="stock_in_type" class="form-control @error('stock_in_type') is-invalid @enderror">
              @foreach($types as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer text-right pt-0">
          <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Buat</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js-section')
<script>
  $(document).ready(function(){
    $('#stock_in_type').select2({
      theme: 'bootstrap4',
    });
  });

  function handleOnSubmit() {
    event.preventDefault();
    
    let formSerialized = $('#form-create').serializeArray();

    let mapDataToObject = formSerialized.reduce(
      (object, item) => Object.assign(object, { [item.name]: item.value }), {}
    );

    let rules = {
      stock_in_type: 'required',
    };

    let validation = new Validator(mapDataToObject, rules);
    
    if (!validation.fails()) {
      document.getElementById('form-create').submit();
    }

  }
</script>
@endsection