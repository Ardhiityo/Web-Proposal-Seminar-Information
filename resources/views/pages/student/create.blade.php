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
                            <div class="card-body">
                                <div class="card">
                                    <form action="{{ route('students.store') }}" method="POST">
                                        @csrf
                                        <div class="card-header">
                                            <h4>Buat Data</h4>
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
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Nama Mahasiswa</label>
                                                    <input type="name" class="form-control" id="name" name="name"
                                                        placeholder="Nama lengkap Mahasiswa" value="{{ old('name') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="nim">NIM</label>
                                                    <input type="text" name="nim" class="form-control" id="nim"
                                                        placeholder="2204XXXX" value="{{ old('nim') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="study_program_id">Program Studi</label>
                                            <select id="study_program_id" name="study_program_id" class="form-control">
                                                <option selected>Choose...</option>
                                                @foreach ($studyPrograms as $studyProgram)
                                                    <option value="{{ $studyProgram->id }}"
                                                        {{ old('study_program_id') == $studyProgram->id ? 'selected' : '' }}>
                                                        {{ $studyProgram->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
