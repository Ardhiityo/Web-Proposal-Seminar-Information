@extends('layouts.app')

@section('title', 'Data Proposal')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Sidang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Sidang</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Sidang</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Sidang</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Sidang yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Mahasiswa</th>
                                            <th scope="col">Dosen Pembimbing 1</th>
                                            <th scope="col">Dosen Pembimbing 2</th>
                                            <th scope="col">Waktu</th>
                                            <th scope="col">Ruang</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proposals as $proposal)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <th scope="row">{{ $proposal->student->nim }}</th>
                                                <td>{{ $proposal->student->name }}</td>
                                                <td>{{ $proposal->lecture1->name }}</td>
                                                <td>{{ $proposal->lecture2->name }}</td>
                                                <td>{{ $proposal->session }}</td>
                                                <td>{{ $proposal->room->name }}</td>
                                                <td>C.A</td>
                                                <td>
                                                    <a href="{{ route('proposals.edit', ['proposal' => $proposal->id]) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <button id="btn-delete" class="btn btn-danger">Hapus</button>
                                                    <form id="form-delete"
                                                        action="{{ route('proposals.destroy', ['proposal' => $proposal->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
