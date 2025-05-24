@extends('layouts.app')

@section('title', 'Data Periode')

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
                <h2 class="section-title">Periode {{ $academicCalendar->periode_year }}</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Sidang yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>

                @role('admin')
                    @if (!$proposals->isEmpty())
                        <div class="card">
                            <div class="card-header">
                                <h4>Export File</h4>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ route('proposals.export.academic-calendar', ['academic_calendar' => $academicCalendar->id]) }}"
                                    method="GET">
                                    <div class="row">
                                        @if ($errors->any())
                                            <div class="col-12">
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group col-md-6">
                                            <label for="start_month">Bulan awal</label>
                                            <select required id="start_month" name="start_month" class="form-control">
                                                <option selected value="">Pilih bulan</option>
                                                @foreach ($months as $month)
                                                    <option value="{{ $month }}"
                                                        {{ old('start_month') == $month ? 'selected' : '' }}>
                                                        {{ ucfirst($month) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="end_month">Bulan akhir</label>
                                            <select required id="end_month" name="end_month" class="form-control">
                                                <option selected value="">Pilih bulan</option>
                                                @foreach ($months as $month)
                                                    <option value="{{ $month }}"
                                                        {{ old('end_month') == $month ? 'selected' : '' }}>{{ ucfirst($month) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="format">Format</label>
                                            <select required id="format" name="format" class="form-control">
                                                <option selected value="">Pilih format</option>
                                                <option value="excel">Excel</option>
                                                <option value="pdf">Pdf</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="mt-4 mb-5 btn btn-primary" type="submit">Download</button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Cari tanggal sidang</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('periodes.show', ['periode' => $academicCalendar->id]) }}"
                                    method="GET">
                                    <div class="form-group col-md-6">
                                        <label for="session_date">Tanggal</label>
                                        <select required id="session_date" name="session_date" class="form-control">
                                            <option selected>Pilih tanggal</option>
                                            @foreach ($sessionDates as $sessionDate)
                                                <option value="{{ $sessionDate->raw_session_date }}"
                                                    {{ old('session_date') == $sessionDate->session_date ? 'selected' : '' }}>
                                                    {{ $sessionDate->session_date }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="mt-4 mb-5 btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endrole

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if ($proposals->isEmpty())
                                <div class="card-header">
                                    <p>Data belum tersedia...</p>
                                </div>
                            @else
                                @foreach ($proposals as $date => $proposalByDate)
                                    <div class="card-header">
                                        <h4>
                                            {{ $date }}
                                        </h4>
                                    </div>
                                    <div class="overflow-auto card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-nowrap">
                                                    <th scope="col">No</th>
                                                    <th scope="col">NIM</th>
                                                    <th scope="col">Mahasiswa</th>
                                                    <th scope="col">Waktu</th>
                                                    <th scope="col">Ruangan</th>
                                                    <th scope="col">Pembimbing 1</th>
                                                    <th scope="col">Pembimbing 2</th>
                                                    @role('admin')
                                                        <th scope="col">Penguji 1</th>
                                                        <th scope="col">Penguji 2</th>
                                                        <th scope="col">Ketua Sidang</th>
                                                        <th scope="col">Aksi</th>
                                                    @endrole
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proposalByDate as $proposal)
                                                    <tr class="text-nowrap">
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $proposal->student->nim }}</td>
                                                        <td>{{ $proposal->student->name }}</td>
                                                        <td>{{ $proposal->session_time }}</td>
                                                        <td>{{ $proposal->room->name }}</td>
                                                        <td>{{ $proposal->student->lecture1->name }}</td>
                                                        <td>{{ $proposal->student->lecture2->name }}</td>
                                                        @role('admin')
                                                            <td>{{ $proposal->examiner1->name }}</td>
                                                            <td>{{ $proposal->examiner2->name }}</td>
                                                            <td>{{ $proposal->moderator->name }}</td>
                                                            <td>
                                                                <a href="{{ route('proposals.edit', ['proposal' => $proposal->id]) }}"
                                                                    class="btn btn-warning">Edit</a>
                                                                <form id="form-delete"
                                                                    action="{{ route('proposals.destroy', ['proposal' => $proposal->id]) }}"
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
                                    </div>
                                @endforeach
                                <div class="mt-5 d-flex justify-content-end">
                                    {{ $proposals->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
