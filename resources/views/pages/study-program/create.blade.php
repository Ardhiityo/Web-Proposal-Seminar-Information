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
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <form action="">
                                        <div class="card-header">
                                            <h4>Buat Data</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Nama Program Studi</label>
                                                    <input type="name" class="form-control" id="name"
                                                        placeholder="Nama lengkap Prodi">
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
