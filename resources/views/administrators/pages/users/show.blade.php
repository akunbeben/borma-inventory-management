@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Users</h1>
      <div class="text-right">
        <a href="#" class="btn btn-dark" onclick="event.preventDefault(); deleteConfirmation();"><i class="fas fa-trash"></i> Hapus</a>
        <a href="{{ route('administrator.users.list') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
        <form id="delete-form" action="{{ route('administrator.users.destroy', $user->id) }}" method="POST" class="d-none">
          @csrf
          @method('DELETE')
        </form>
      </div>
    </div>

    <div class="section-body">
      <h5 class="section-title">Detail User</h5>
      <p class="section-lead">Data detail dari &mdash; {{ $user->name }}</p>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Detail</h4>
              <div class="card-header-action">
                <a href="{{ route('administrator.users.edit', $user->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah</a>
                <a href="{{ route('administrator.users.password-reset', $user->id) }}" class="btn btn-dark" onclick="event.preventDefault(); resetConfirmation();"><i class="fas fa-cog"></i> Reset Password</a>
                <form id="password-reset" action="{{ route('administrator.users.password-reset', $user->id) }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </div>
            <div class="card-body">
              <div class="card profile-widget">
                <div class="profile-widget-header">                     
                  <img alt="image" src="{{ asset('img/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Ditambahkan pada</div>
                      <div class="profile-widget-item-value">{{ $user->created_at->format('l, d F Y - H:i') }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Terakhir dirubah</div>
                      <div class="profile-widget-item-value">{{ $user->updated_at->diffForHumans() }}</div>
                    </div>
                  </div>
                </div>
                <div class="profile-widget-description">
                  <div class="profile-widget-name">{{ $user->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $user->division->division_name }}</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js-section')
<script>
  function deleteConfirmation() {
    swal.fire({
      title: 'Hapus user?',
      text: "Semua data terkait akan dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
          document.getElementById('delete-form').submit();
      }
    })
  }
  
  function resetConfirmation() {
    swal.fire({
      title: 'Anda yakin?',
      text: "Password akan diubah dengan password bawaan!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Reset',
      cancelButtonText: 'batal'
      }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('password-reset').submit();
      }
    })
  }
</script>
@endsection