@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Users</h1>
      <div class="text-right">
        <a href="{{ route('administrator.users.show', $user->id) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
    </div>

    <div class="section-body">
      <h5 class="section-title">User Detail</h5>
      <p class="section-lead">Edit data user &mdash; {{ $user->name }}</p>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Edit Form</h4>
            </div>
            <form action="{{ route('administrator.users.update', $user->id) }}" method="post" onsubmit="handleOnSubmit()" id="form-user">
              @method('PUT')
              @csrf
              <input type="hidden" name="id" value="{{ $user->id }}">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">User Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ?? $user->name }}" autofocus autocomplete="off">
                  @error('name')
                  <span class="invalid-feedback" id="nameFeedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="division">Division</label>
                  <select name="division" id="division" class="form-control">
                    @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : null }}>{{ $division->division_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
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
</script>
@endsection