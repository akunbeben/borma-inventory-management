@extends('users.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Profile</h1>
    </div>

    <div class="section-body">
      <h5 class="section-title">Profil Saya</h5>
      <p class="section-lead">Data detail dari &mdash; {{ $profile->name }}</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Detail</h4>
            </div>
            <div class="card-body">
              <div class="card profile-widget">
                <div class="profile-widget-header">                     
                  <img alt="image" src="{{ $profile->image ? asset('storage/' . $profile->image->path) : asset('img/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">NPK</div>
                      <div class="profile-widget-item-value">{{ $profile->npk }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Terakhir dirubah</div>
                      <div class="profile-widget-item-value">{{ $profile->updated_at->diffForHumans() }}</div>
                    </div>
                  </div>
                </div>
                <div class="profile-widget-description text-center">
                  <div class="profile-widget-name">{{ $profile->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $profile->division->division_name }}</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-6 col-md-6 col-lg-6 col-sm-6">
          <div class="card shadow">
            <form method="POST" action="{{ route('users.profile.change-password') }}">
              @csrf
              <div class="card-header">
                <h4>Ganti Password</h4>
              </div>
              <div class="card-body pb-0">
                <div class="form-group">
                  <label>Password Sekarang <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                      </div>
                    </div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password sekarang" name="password" value="{{ old('password') }}">
                    @error('password')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label>Password Baru <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                      </div>
                    </div>
                    <input type="password" class="form-control @error('new-password') is-invalid @enderror" placeholder="Password baru" name="new-password" value="{{ old('new-password') }}">
                    @error('new-password')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                      </div>
                    </div>
                    <input type="password" class="form-control @error('conf-password') is-invalid @enderror" placeholder="Konfirmasi password" name="conf-password" value="{{ old('conf-password') }}">
                    @error('conf-password')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer pt-0 text-right">
                <button type="submit" class="btn btn-primary" id="passwordButton" onclick="passwordSaveButton(this)"><i class="fas fa-save"></i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-6 col-md-6 col-lg-6 col-sm-6">
          <div class="card shadow">
            <form method="POST" action="{{ route('users.profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-header">
                <h4>Edit Profil</h4>
              </div>
              <div class="card-body pb-0">
                <div class="form-group">
                  <label for="first_name">Nama Depan <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-font"></i>
                      </div>
                    </div>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="Nama Depan" name="first_name" value="{{ old('first_name') ?? count($fullName) >= 3 ? $fullName[0] . ' ' . $fullName[1] : $fullName[0] }}">
                    @error('first_name')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="last_name">Nama Belakang <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-font"></i>
                      </div>
                    </div>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Nama Belakang" name="last_name" value="{{ old('last_name') ?? count($fullName) >= 3 ? $fullName[2] : $fullName[1] }}">
                    @error('last_name')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="photo">Foto Profil</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-image"></i>
                      </div>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo" onchange="changeLabel()" accept="image/*">
                      <label class="custom-file-label" for="photo" aria-describedby="photo" id="photoLabel">
                        Pilih file foto
                      </label>
                    </div>
                    @error('conf-password')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer pt-0 text-right">
                <button type="submit" class="btn btn-primary" id="profileButton" onclick="profileSaveButton(this)"><i class="fas fa-save"></i> Simpan Perubahan</button>
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
function changeLabel() {
  let input = document.getElementById('photo');
  let label = document.getElementById('photoLabel');

  if (input.files.length > 0) {
    label.innerHTML = input.files[0].name;
  }
}

function profileSaveButton(button) {
  let passwordButton = document.getElementById('passwordButton');
  passwordButton.disabled = true;
  button.form.submit();
  button.disabled=true; 
  button.innerText='Mengirim...';
}

function passwordSaveButton(button) {
  let profileButton = document.getElementById('profileButton');
  profileButton.disabled = true;
  button.form.submit();
  button.disabled = true;
  button.innerText='Mengirim...';
}
</script>
@endsection