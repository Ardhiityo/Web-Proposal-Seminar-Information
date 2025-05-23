@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Umum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Informasi Umum</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Ruangan</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Ruangan</h2>
                <p class="section-lead">
                    Semua informasi mengenai data Ruangan yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @role('admin')
                                <div class="card-header">
                                    <h4>
                                        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Data</a>
                                    </h4>
                                </div>
                            @endrole
                            <div class="overflow-auto card-body">
                                @if ($rooms->isEmpty())
                                    <p>Data belum tersedia...</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                @role('admin')
                                                    <th scope="col">Aksi</th>
                                                @endrole
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rooms as $room)
                                                <tr class="text-nowrap">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $room->name }}</td>
                                                    @role('admin')
                                                        <td>
                                                            <a href="{{ route('rooms.edit', ['room' => $room->id]) }}"
                                                                class="btn btn-warning">Edit</a>
                                                            <form id="form-delete"
                                                                action="{{ route('rooms.destroy', ['room' => $room->id]) }}"
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
                                            <tr>
                                                <td colspan="6" class="border-0"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="border-0">
                                                    <div class="d-flex justify-content-end">
                                                        {{ $rooms->links('pagination::bootstrap-4') }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
