@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Tahun Akademik</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Tahun Akademik</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Tahun Akademik yang ada di Fakultas Ilmu Komputer Universitas
                    Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @can('create-academic-calendar')
                                <div class="card-header">
                                    <h4>
                                        <a href="{{ route('academic-calendars.create') }}" class="btn btn-primary">Tambah
                                            Data</a>
                                    </h4>
                                </div>
                            @endcan
                            <div class="overflow-auto card-body">
                                @if ($academicCalendars->isEmpty())
                                    <p>Data belum tersedia...</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">No</th>
                                                <th scope="col">Tahun Mulai</th>
                                                <th scope="col">Tahun Berakhir</th>
                                                @role('admin')
                                                    <th scope="col">Aksi</th>
                                                @endrole
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($academicCalendars as $academicCalendar)
                                                <tr class="text-nowrap">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $academicCalendar->started_date_year }}</td>
                                                    <td>{{ $academicCalendar->ended_date_year }}</td>
                                                    @role('admin')
                                                        <td>
                                                            <a href="{{ route('academic-calendars.edit', ['academic_calendar' => $academicCalendar->id]) }}"
                                                                class="btn btn-warning">Edit</a>
                                                            <form id="form-delete"
                                                                action="{{ route('academic-calendars.destroy', ['academic_calendar' => $academicCalendar->id]) }}"
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
                                        {{ $academicCalendars->links('pagination::bootstrap-4') }}
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
