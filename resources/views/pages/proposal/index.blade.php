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
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">NIM</th>
                                                    <th scope="col">Mahasiswa</th>
                                                    <th scope="col">Pembimbing 1</th>
                                                    <th scope="col">Pembimbing 2</th>
                                                    <th scope="col">Waktu</th>
                                                    <th scope="col">Ruangan</th>
                                                    <th scope="col">Periode</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proposals as $proposal)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $proposal->student->nim }}</td>
                                                        <td>{{ $proposal->student->name }}</td>
                                                        <td>{{ $proposal->lecture1->name }}</td>
                                                        <td>{{ $proposal->lecture2->name }}</td>
                                                        <td>{{ $proposal->session_time }}</td>
                                                        <td>{{ $proposal->room->name }}</td>
                                                        <td>{{ $proposal->academicCalendar->periode_year }}</td>

                                                        <td>
                                                            <a href="{{ route('proposals.edit', ['proposal' => $proposal->id]) }}"
                                                                class="btn btn-warning">Edit</a>
                                                            <button id="btn-delete" class="btn btn-danger">Hapus</button>
                                                            <form id="form-delete"
                                                                action="{{ route('proposals.destroy', ['proposal' => $proposal->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

@push('scripts')
    <script>
        const btnDelete = document.getElementById('btn-delete');
        const formDelete = document.getElementById('form-delete');

        btnDelete.addEventListener('click', function(e) {
            e.preventDefault();
            formDelete.submit();
        })
    </script>
@endpush
