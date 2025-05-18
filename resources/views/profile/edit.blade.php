@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <div class="d-flex justify-content-between align-items-center row">
                    <div class="col-12 col-md-6">
                        <h2 class="section-title">Hi, {{ $user->name }}!</h2>
                        <p class="section-lead">
                            Ubah informasi tentang diri Anda di halaman ini.
                        </p>
                    </div>
                    <div class="justify-content-end col-12 col-md-6 d-flex">
                        <form action="{{ route('history.destroy') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="py-2 profile-widget-name">{{ $user->name }}
                                            <div class="text-muted d-inline font-weight-normal">
                                                <div class="slash"></div> Visitor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                Sebagai visitor, Anda memiliki akses untuk melihat informasi pada sistem. Visitor merupakan
                                pengguna yang dapat mengakses dan melihat konten yang tersedia tanpa memiliki hak untuk
                                melakukan perubahan pada sistem.
                                <div class="d-flex justify-content-end">
                                    <form action="{{ route('profile.destroy') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Hapus Akun</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" class="needs-validation" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password</label>
                                            <input name="password" type="password" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Konfirmasi Password</label>
                                            <input name="password_confirmation" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush
