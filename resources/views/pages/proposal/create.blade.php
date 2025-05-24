@extends('layouts.app')

@section('title', 'Data Sidang')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
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
                            <div class="card-body">
                                <div class="overflow-auto card">
                                    <form action="{{ route('proposals.store') }}" method="POST">
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
                                                    <label for="session_date">Tanggal Sidang</label>
                                                    <input required type="date" class="form-control" id="session_date"
                                                        name="session_date" value="{{ old('session_date') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="session_time">Waktu Sidang</label>
                                                    <input required type="time" name="session_time" class="form-control"
                                                        id="session_time" name="session_time"
                                                        value="{{ old('session_time') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="student_id">Mahasiswa</label>
                                                    <select id="student_id" required name="student_id" class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($students as $student)
                                                            <option value="{{ $student->id }}"
                                                                {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                                                {{ $student->name }} - {{ $student->nim }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="academic_calendar_id">Tahun Akademik</label>
                                                    <select required id="academic_calendar_id" name="academic_calendar_id"
                                                        class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($academicCalendars as $academicCalendar)
                                                            <option value="{{ $academicCalendar->id }}"
                                                                {{ old('academic_calendar_id') == $academicCalendar->id ? 'selected' : '' }}>
                                                                {{ $academicCalendar->periode_year }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="examiner_1_id">Penguji 1</label>
                                                    <select required id="examiner_1_id" name="examiner_1_id"
                                                        class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($lectures as $lecture)
                                                            <option value="{{ $lecture->id }}"
                                                                {{ old('examiner_1_id') == $lecture->id ? 'selected' : '' }}>
                                                                {{ $lecture->name }} - {{ $lecture->nidn }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="examiner_2_id">Penguji 2</label>
                                                    <select required id="examiner_2_id" name="examiner_2_id"
                                                        class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($lectures as $lecture)
                                                            <option value="{{ $lecture->id }}"
                                                                {{ old('examiner_2_id') == $lecture->id ? 'selected' : '' }}>
                                                                {{ $lecture->name }} - {{ $lecture->nidn }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="moderator_id">Ketua sidang</label>
                                                    <select required id="moderator_id" name="moderator_id"
                                                        class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($lectures as $lecture)
                                                            <option value="{{ $lecture->id }}"
                                                                {{ old('moderator_id') == $lecture->id ? 'selected' : '' }}>
                                                                {{ $lecture->name }} - {{ $lecture->nidn }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="room">Ruangan</label>
                                                    <select required id="room_id" name="room_id" class="form-control">
                                                        <option selected>Choose...</option>
                                                        @foreach ($rooms as $room)
                                                            <option value="{{ $room->id }}"
                                                                {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                                                {{ $room->name }}</option>
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
