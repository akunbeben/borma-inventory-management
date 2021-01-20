@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Inventories</h1>
      <div class="text-center">
        <button class="btn btn-primary" data-toggle="modal" data-target="#fire-modal-create"><i class="fas fa-receipt"></i> Stock Out</button>
      </div>
    </div>
    <div class="section-body">
      <h5 class="section-title">Stock Out</h5>
      <p class="section-lead">List of all stock out</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow card-primary">
            <div class="card-header">
              <h4>Stock Out</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('users.inventories.stock-out') }}">
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
              @if($stocks->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-check"></i>
                </div>
                <h2>There is no orders.</h2>
                <p class="lead">
                  You can submit Stock Out request or returned here.
                </p>
                <a href="#" class="btn btn-primary mt-4" data-toggle="modal" data-target="#fire-modal-create">Create new One</a>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md table-hover">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Order ID</th>
                    <th>Date Created</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach($stocks as $stock)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $stock->order_id }}</strong></td>
                    <td>{{ $stock->created_at->format('l, d-m-Y H:i') }}</td>
                    <td><span class="badge badge-primary">{{ $stock->type->name }}</span></td>
                    <td><span class="badge badge-{{ $stock->status->status == 'Draft' ? 'info' : ($stock->status->status == 'Pending' ? 'primary' : ($stock->status->status == 'Approved' ? 'success' : 'danger' ) ) }}">{!! $stock->status->status !!}</span></td>
                    <td class="text-center">
                      <a href="{{ route('users.inventories.stock-out.show', $stock->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                      @if($stock->status->status == 'Draft')
                      <a href="{{ route('users.inventories.stock-out.order', $stock->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pallet"></i> Stock In</a>
                      @endif
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

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="fire-modal-create">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Stock Out</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{ route('users.inventories.stock-out.create') }}" method="post" id="form-create" onsubmit="handleOnSubmit()">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="stock_out_type">Stock Out Type <span class="text-danger">*</span> <strong class="text-secondary">Choose order type below.</strong></label>
            <select name="stock_out_type" id="stock_out_type" class="form-control @error('stock_out_type') is-outvalid @enderror">
              <option aria-readonly="true" value="">-- Select stock out type --</option>
              @foreach($types as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer text-right pt-0">
          <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js-section')
<script>
  $(document).ready(function(){
    $('#stock_out_type').select2({
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
      stock_out_type: 'required',
    };

    let validation = new Validator(mapDataToObject, rules);
    
    if (!validation.fails()) {
      document.getElementById('form-create').submit();
    }

  }
</script>
@endsection