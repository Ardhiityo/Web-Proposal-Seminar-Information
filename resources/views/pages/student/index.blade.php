@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Mahasiswa</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Mahasiswa</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Mahasiswa yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>

                @role('admin')
                    <div class="card">
                        <div class="card-header">
                            <h4>Import From Excel</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                                <div class="custom-file">
                                    @csrf
                                    <input type="file" class="custom-file-input" required id="excel" name="excel">
                                    @error('excel')
                                        <p class="mt-2 text-danger">{{ $message }}</p>
                                    @enderror
                                    <label class="custom-file-label" for="excel">Excel File</label>
                                    <button class="mt-4 mb-5 btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endrole

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @role('admin')
                                <div class="card-header">
                                    <h4>
                                        <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Data</a>
                                    </h4>
                                </div>
                            @endrole
                            <div class="overflow-auto card-body">
                                @if ($students->isEmpty())
                                    <p>Data belum tersedia...</p>
                                @else
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="form-group">
                                                <div class="mb-3 input-group">
                                                    <form action="{{ route('students.index', ['keyword']) }}" method="get"
                                                        class="d-flex">
                                                        <input type="text" class="form-control"
                                                            placeholder="Cari disini..." name="keyword">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NIM</th>
                                                <th scope="col">Pembimbing 1</th>
                                                <th scope="col">Pembimbing 2</th>
                                                @role('admin')
                                                    <th scope="col">Aksi</th>
                                                @endrole
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr class="text-nowrap">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->nim }}</td>
                                                    <td>{{ $student->lecture1->name }}</td>
                                                    <td>{{ $student->lecture2->name }}</td>
                                                    @role('admin')
                                                        <td>
                                                            <a href="{{ route('students.edit', ['student' => $student->id]) }}"
                                                                class="btn btn-warning">Edit</a>
                                                            <form id="form-delete"
                                                                action="{{ route('students.destroy', ['student' => $student->id]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="btn-delete"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </td>
                                                    @endrole
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="my-auto d-flex justify-content-end">
                                        {{ $students->links('pagination::bootstrap-4') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
