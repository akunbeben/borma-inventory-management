@extends('administrators.layouts.app')

@section('body')
<div class="main-content">
  <section class="section">

    <div class="section-header justify-content-between">
      <h1>Users</h1>
      <div class="section-header-button">
        <a href="{{ route('administrator.users.create') }}" class="btn btn-primary"><i class="fas fa-receipt"></i> Tambah User</a>
      </div>
    </div>

    <div class="section-body">
      <h5 class="section-title">Daftar User</h5>
      <p class="section-lead">Daftar semua user</p>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card shadow">
            <div class="card-header">
              <h4>Users</h4>
              <div class="card-header-form">
                <form method="GET" action="{{ route('administrator.users.list') }}">
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
              @if($users->count() <= 0)
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="fas fa-question"></i>
                </div>
                <h2>Data user tidak ditemukan.</h2>
                <p class="lead">
                  Maaf kami tidak menemukan data user, silahkan buat atau tambahkan user baru.
                </p>
                <a href="{{ route('administrator.users.create') }}" class="btn btn-primary mt-4">Tambah user baru</a>
              </div>
              @else
              <div class="table-responsive">
                <table class="table table-striped table-md">
                  <tbody>
                  <tr>
                    <th><strong>#</strong></th>
                    <th>Nama user</th>
                    <th>Divisi</th>
                    <th>NPK</th>
                    <th>Dibuat pada</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->division->division_name }}</td>
                    <td>{{ $user->npk }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td class="text-center">
                      <a href="{{ route('administrator.users.show', $user->id) }}" class="btn btn-primary btn-sm" title="Details"><i class="fas fa-eye"></i> Lihat</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
            @if($users->total() > $users->perPage())
            <div class="card-footer">
              {{ $users->links() }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection