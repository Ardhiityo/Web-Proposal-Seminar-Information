@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>

                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Mahasiswa</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalStudents }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Dosen</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalLecturers }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Ruangan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalRooms }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-calendar-days"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Jadwal</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalProposals }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <span class="btn btn-primary">Periode</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="180"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @forelse ($latestProposals as $latestProposal)
                                    <a href="{{ route('proposals.index', ['keyword' => $latestProposal->student->nim]) }}"
                                        class="mb-4 text-decoration-none media">
                                        <img class="mr-3 rounded-circle" width="50"
                                            src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary">
                                                {{ $latestProposal->created_at }}</div>
                                            <div class="media-title">{{ $latestProposal->student->name }}</div>
                                            <span class="text-small text-muted">Mahasiswa
                                                Mulai seminar
                                                pukul {{ $latestProposal->session_time }} wib, pada ruangan
                                                {{ $latestProposal->room->name }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <p>Data belum tersedia...</p>
                                @endforelse
                            </ul>
                            <div class="pt-1 pb-1 text-center">
                                <a href="{{ route('proposals.index') }}" class="btn btn-primary btn-lg btn-round">
                                    Semua jadwal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script>
        var statistics_chart = document.getElementById("myChart").getContext('2d');

        var academicCalendarData = @json($academicPeriodes);

        var totalProposalByPeriodes = @json($totalProposalByPeriodes)


        var myChart = new Chart(statistics_chart, {
            type: 'line',
            data: {
                labels: academicCalendarData,
                datasets: [{
                    label: 'Statistics',
                    data: totalProposalByPeriodes,
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 5
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 2
                        }
                    }]
                },
            }
        });
    </script>
@endpush
