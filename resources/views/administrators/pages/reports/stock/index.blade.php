@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Report</h1>
      <button class="btn btn-primary" data-toggle="modal" data-target="#fire-modal-create"><i class="fas fa-file-alt"></i> Buat Laporan</button>
    </div>

    <div class="section-body">
      <h5 class="section-title">Laporan Stok</h5>
      <p class="section-lead">Data laporan stok</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4>Laporan Stok</h4>
            </div>

            <div class="card-body p-0">
              @if($data->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>Data laporan tidak ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data laporan, silahkan buat data laporan baru.
                </p>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>No Dokumen</th>
                    <th>Dibuat pada</th>
                    <th>Periode</th>
                    <th>Dibuat oleh</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                  @foreach($data as $laporan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $laporan->document_number }}</td>
                    <td>{{ $laporan->created_at->format('d M Y - H:i:s') }}</td>
                    <td>{{ $laporan->start_date->format('d M Y') }} - {{ $laporan->end_date->format('d M Y') }}</td>
                    <td>{{ $laporan->created_by }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.reports.stock.show', $laporan->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            @if($data->total() > $data->perPage())
            <div class="card-footer">
              {{ $data->links() }}
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
        <h5 class="modal-title">Buat Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{ route('administrator.reports.stock.store') }}" method="post" id="form-create" onsubmit="handleOnSubmit()">
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="col-6 col-md-6 col-lg-6">
              <label for="start_date">Tanggal Awal <span class="text-danger">*</span></label>
              <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date') }}" autocomplete="off">
              @error('start_date')
              <span class="invalid-feedback" id="start_dateFeedback">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-6 col-md-6 col-lg-6">
              <label for="end_date">Tanggal Akhir <span class="text-danger">*</span></label>
              <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date') }}" autocomplete="off">
              @error('end_date')
              <span class="invalid-feedback" id="end_dateFeedback">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
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
@if($errors->any())
<script>
  $(document).ready(function(){
    $('#fire-modal-create').modal('show');
  });
</script>
@endif

<script>
  function handleOnSubmit() {
    event.preventDefault();
    
    let formSerialized = $('#form-create').serializeArray();

    let mapDataToObject = formSerialized.reduce(
      (object, item) => Object.assign(object, { [item.name]: item.value }), {}
    );

    let rules = {
      start_date: 'required',
      end_date: 'required',
    };

    let validation = new Validator(mapDataToObject, rules);
    
    if (!validation.fails()) {
      document.getElementById('form-create').submit();
    }

  }
</script>
@endsection