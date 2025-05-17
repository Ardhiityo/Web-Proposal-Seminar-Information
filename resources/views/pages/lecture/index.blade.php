@extends('layouts.app')

@section('title', 'Data Dosen')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Dosen</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Dosen</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Dosen yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <a href="{{ route('lectures.create') }}" class="btn btn-primary">Tambah Data</a>
                                </h4>
                            </div>
                            <div class="overflow-auto card-body">
                                @if ($lectures->isEmpty())
                                    <p>Data belum tersedia...</p>
                                @else
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
                                            @foreach ($lectures as $lecture)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $lecture->name }}</td>
                                                    <td>{{ $lecture->phone ?? '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('lectures.edit', ['lecture' => $lecture->id]) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <button id="btn-delete" class="btn btn-danger">Hapus</button>
                                                        <form id="form-delete"
                                                            action="{{ route('lectures.destroy', ['lecture' => $lecture->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
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
