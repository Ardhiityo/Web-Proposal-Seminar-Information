@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Ruangan</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Ruangan</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Ruangan yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Data</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Narahubung</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Darpi Supriyanto</td>
                                            <td>0896-5055-7420</td>
                                            <td>
                                                <a href="#" class="btn btn-warning">Edit</a>
                                                <button class="btn btn-danger" id="btn-delete">Hapus</button>
                                                <form id="form-delete"
                                                    action="{{ route('rooms.destroy', ['room' => $room->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        const btnDelete = document.getElementById('btn-delete');
        const formDelete = document.getElementById('form-delete');

        btnDelete.addEventListener('click', function(e) {
            e.preventDefault();
            formDelete.submit();
        })
    </script>
@endpush
