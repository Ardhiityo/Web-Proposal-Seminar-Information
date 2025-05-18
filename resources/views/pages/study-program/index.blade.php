@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Program Studi</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Program Studi</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Program Studi yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <a href="{{ route('study-programs.create') }}" class="btn btn-primary">Tambah Data</a>
                                </h4>
                            </div>
                            <div class="overflow-auto card-body">
                                @if ($studyPrograms->isEmpty())
                                    <p>Data belum tersedia...</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studyPrograms as $studyProgram)
                                                <tr class="text-nowrap">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $studyProgram->name }}</td>
                                                    <td>
                                                        <a href="{{ route('study-programs.edit', ['study_program' => $studyProgram->id]) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form id="form-delete"
                                                            action="{{ route('study-programs.destroy', ['study_program' => $studyProgram->id]) }}"
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
                                        {{ $studyPrograms->links('pagination::bootstrap-4') }}
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
