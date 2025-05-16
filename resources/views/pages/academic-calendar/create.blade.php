@extends('layouts.app')

@section('title', 'Data Tahun Akademik')

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
                    Semua informasi mengenai data Tahun Akademik yang ada di Fakultas Ilmu Komputer Universitas Al-Khairiyah
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <form action="{{ route('academic-calendars.store') }}" method="post">
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
                                                    <label for="started_date">Tahun Mulai</label>
                                                    <input type="date" required name="started_date" class="form-control"
                                                        id="started_date" value{{ old('started_date') }}
                                                        placeholder="Tahun mulai Akademik">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="ended_date">Tahun Berakhir</label>
                                                    <input type="date" required class="form-control" name="ended_date"
                                                        id="ended_date" placeholder="Tahun berakhir Akademik"
                                                        value="{{ old('ended_date') }}">
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
