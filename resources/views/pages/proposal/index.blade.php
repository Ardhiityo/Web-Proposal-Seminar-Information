@extends('layouts.app')

@section('title', 'Data Seminar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Seminar</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Seminar</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Seminar yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (session()->has('nim_not_found'))
                                <div class="card-header">
                                    <h4>
                                        <p>{{ session('nim_not_found') }}</p>
                                    </h4>
                                </div>
                            @else
                                <div class="card-header">
                                    <h4>
                                        <a href="{{ route('proposals.create') }}" class="btn btn-primary">Tambah
                                            Data</a>
                                    </h4>
                                </div>
                                <div class="overflow-auto card-body">
                                    @if ($proposals->isEmpty())
                                        <p>Data belum tersedia...</p>
                                    @else
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <div class="form-group">
                                                    <div class="mb-3 input-group">
                                                        <form action="{{ route('proposals.index') }}" method="get"
                                                            class="d-flex align-items-center">
                                                            <div class="mx-2 d-flex">
                                                                <select required id="started_date" name="started_date"
                                                                    class="form-control">
                                                                    <option selected value="">Tahun Awal</option>
                                                                    @foreach ($startedAcademicCalendars as $startedAcademicCalendar)
                                                                        <option
                                                                            value="{{ $startedAcademicCalendar->started_date }}"
                                                                            {{ old('started_date') == $startedAcademicCalendar->started_date_year ? 'selected' : '' }}>
                                                                            {{ $startedAcademicCalendar->started_date_year }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <select required id="ended_date" name="ended_date"
                                                                    class="form-control">
                                                                    <option selected value="">Tahun Akhir
                                                                    </option>
                                                                    @foreach ($endedAcademicCalendars as $endedAcademicCalendar)
                                                                        <option
                                                                            value="{{ $endedAcademicCalendar->ended_date }}"
                                                                            {{ old('ended_date') == $endedAcademicCalendar->ended_date_year ? 'selected' : '' }}>
                                                                            {{ $endedAcademicCalendar->ended_date_year }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-nowrap">
                                                    <th scope="col">No</th>
                                                    <th scope="col">NIM</th>
                                                    <th scope="col">Mahasiswa</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Waktu</th>
                                                    <th scope="col">Ruangan</th>
                                                    <th scope="col">Pembimbing 1</th>
                                                    <th scope="col">Pembimbing 2</th>
                                                    <th scope="col">Periode</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proposals as $proposal)
                                                    <tr class="text-nowrap">
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $proposal->student->nim }}</td>
                                                        <td>{{ $proposal->student->name }}</td>
                                                        <td>{{ $proposal->session_date }}</td>
                                                        <td>{{ $proposal->session_time }}</td>
                                                        <td>{{ $proposal->room->name }}</td>
                                                        <td>{{ $proposal->student->lecture1->name }}</td>
                                                        <td>{{ $proposal->student->lecture2->name }}</td>
                                                        <td>{{ $proposal->academicCalendar->periode_year }}</td>

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
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="my-auto d-flex justify-content-end">
                                            {{ $proposals->links('pagination::bootstrap-4') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
