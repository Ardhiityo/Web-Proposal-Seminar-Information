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

                @role('admin')
                    <div class="card">
                        <div class="card-header">
                            <h4>Import From Excel</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lectures.import') }}" method="POST" enctype="multipart/form-data">
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

                <div class="mt-5 row">
                    <div class="col-12">
                        <div class="card">
                            @role('admin')
                                <div class="card-header">
                                    <h4>
                                        <a href="{{ route('lectures.create') }}" class="btn btn-primary">Tambah Data</a>
                                    </h4>
                                </div>
                            @endrole('admin')
                            <div class="overflow-auto card-body">
                                @if ($lectures->isEmpty())
                                    <p>Data belum tersedia...</p>
                                @else
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="form-group">
                                                <div class="mb-3 input-group">
                                                    <form action="{{ route('lectures.index', ['keyword']) }}" method="get"
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
                                                <th scope="col">NIDN</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lectures as $lecture)
                                                <tr class="text-nowrap">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $lecture->name }}</td>
                                                    <td>{{ $lecture->nidn }}</td>
                                                    <td>
                                                        <a href="{{ route('lectures.edit', ['lecture' => $lecture->id]) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form id="form-delete"
                                                            action="{{ route('lectures.destroy', ['lecture' => $lecture->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="btn-delete"
                                                                class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="my-auto d-flex justify-content-end">
                                        {{ $lectures->links('pagination::bootstrap-4') }}
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
