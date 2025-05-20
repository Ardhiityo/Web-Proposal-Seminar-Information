@extends('layouts.app')

@section('title', 'Data Mahasiswa')

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
                                <div class="overflow-auto card">
                                    <form action="{{ route('students.update', ['student' => $student->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-header">
                                            <h4>Edit Data</h4>
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
                                                    <input type="name" required class="form-control" id="name"
                                                        name="name" placeholder="Nama lengkap Mahasiswa"
                                                        value="{{ old('name', $student->name) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="nim">NIM</label>
                                                    <input type="text" name="nim" required class="form-control"
                                                        id="nim" placeholder="2204XXXX"
                                                        value="{{ old('nim', $student->nim) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="lecture_1_id">Pembimbing 1</label>
                                                    <select required id="lecture_1_id" name="lecture_1_id"
                                                        class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($lectures as $lecture)
                                                            <option value="{{ $lecture->id }}"
                                                                {{ old('lecture_1_id', $student->lecture1->id) == $lecture->id ? 'selected' : '' }}>
                                                                {{ $lecture->name }} - {{ $lecture->nidn }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="lecture_2_id">Pembimbing 2</label>
                                                    <select required id="lecture_2_id" name="lecture_2_id"
                                                        class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($lectures as $lecture)
                                                            <option value="{{ $lecture->id }}"
                                                                {{ old('lecture_2_id', $student->lecture2->id) == $lecture->id ? 'selected' : '' }}>
                                                                {{ $lecture->name }} - {{ $lecture->nidn }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
