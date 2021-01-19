@extends('administrators.layouts.auth')

@section('content')
<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
        </div>

        <div class="card card-primary">
          <div class="card-header"><h4>Sign in as Administrator</h4></div>

          <div class="card-body">
            <form method="POST" action={{ route('administrator.sign-in') }} class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="npk">NPK</label>
                <input id="npk" type="text" class="form-control" name="npk" required autofocus autocomplete="off">
                @error('npk')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" required>
                @error('password')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" onclick="disableButton(this)">
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; Borma Toserba 2021
        </div>
      </div>
    </div>
  </div>
</section>
@endsection