@extends('layouts.app')

@section('title', 'Data Periode')

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
                <h2 class="section-title">Periode {{ $academicCalendar->periode_year }}</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Seminar yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12">
                        @foreach ($proposals as $date => $proposalByDate)
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                                    </h4>
                                </div>
                                <div class="overflow-auto card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">No</th>
                                                <th scope="col">NIM</th>
                                                <th scope="col">Mahasiswa</th>
                                                <th scope="col">Pembimbing 1</th>
                                                <th scope="col">Pembimbing 2</th>
                                                <th scope="col">Waktu</th>
                                                <th scope="col">Ruangan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proposalByDate as $proposal)
                                                <tr class="text-nowrap">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $proposal->student->nim }}</td>
                                                    <td>{{ $proposal->student->name }}</td>
                                                    <td>{{ $proposal->lecture1->name }}</td>
                                                    <td>{{ $proposal->lecture2->name }}</td>
                                                    <td>{{ $proposal->session_time }}</td>
                                                    <td>{{ $proposal->room->name }}</td>
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
