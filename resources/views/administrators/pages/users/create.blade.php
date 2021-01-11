@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Users</h1>
      <a href="{{ route('administrator.users.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
      <h5 class="section-title">User</h5>
      <p class="section-lead">Registration form</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Form</h4>
            </div>
            <form action="{{ route('administrator.users.store') }}" method="post" onsubmit="handleOnSubmit()" id="form-user">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="name">User Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" autofocus autocomplete="off">
                  @error('name')
                  <span class="invalid-feedback" id="nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="npk">NPK</label>
                  <input type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control @error('npk') is-invalid @enderror" name="npk" id="npk" value="{{ old('npk') }}" autocomplete="off">
                @error('npk')
                <span class="invalid-feedback" id="npkFeedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="form-group">
                  <label for="division">Division</label>
                  <select name="division" id="division" class="form-control">
                    @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
  $(document).ready(function() {
    $('#division').select2({
      theme: 'bootstrap4',
    });

  });
  
  function handleOnSubmit() {
    event.preventDefault();
    
    let formSerialized = $('#form-user').serializeArray();

    let mapDataToObject = formSerialized.reduce(
      (object, item) => Object.assign(object, { [item.name]: item.value }), {}
    );

    let rules = {
      name: 'required',
      npk: 'required|numeric',
      division: 'required'
    };

    let validation = new Validator(mapDataToObject, rules);

    if (!validation.fails()) {
      document.getElementById('form-user').submit();
    }

  }
</script>
@endsection