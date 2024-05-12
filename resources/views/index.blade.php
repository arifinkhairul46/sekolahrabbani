@extends('layouts.app')

@section('content')

    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="banner" src="{{ asset('assets/images/home_rabbani_school.png') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="text-white text-uppercase animated zoomIn">School of Qur'anic <br> Leaderpreneur</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="banner" src="{{ asset('assets/images/home_rabbani_school.png') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="text-white text-uppercase animated zoomIn">Sekolah Rabbani Menuju <br> Generasi Rabbani</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="banner" src="{{ asset('assets/images/home_rabbani_school.png') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="">
                            <h1 class="text-white text-uppercase animated zoomIn">Sekolah Berbasis <br>Qur'an Leadership Entrepreneur</h1>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="cloud">
        {{-- <img src="{{ asset('assets/images/awan1.png') }}" class="cloud"  alt="cloud"> --}}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <h6>Kober - TK - SD - SMP</h6>
                </div>
                <div class="row">
                    <h1> School of Qur'anic Leaderpreneur.</h1>
                </div>
                <div class="row">
                    <p> Sekolah Rabbani dengan kurikulum khas Quranic Leaderpreneur (QLP) dirancang sebagai sekolah pencetak peserta didik yang mampu menjadi teladan dan memiliki jiwa pengusaha yang berbasis Al-Qur’an dan As-Sunnah. </p>
                </div>
                <div class="row">
                    <a href="#" class="btn btn-grad text-white">Daftar Sekarang</a>
                </div>
            </div>
            <div class="col-md">
                {{-- <img src="{{ asset('assets/images/siswa.png') }}" class="center dynamic" alt="logo" width="70%"> --}}
            </div>
        </div>
    </div>

    {{-- Jenjang --}}
    <div class="jenjang-program">
        <div class="container ">
            <div class="center">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo jenjang" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Sekolah Rabbani</h6>
                <h4 class="mb-3">Berbagai Jenjang Pilihan</h4>
            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-kb">
                            <img src="{{ asset('assets/images/KB_1.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kober</h5>
                            <p class="card-text">Pendidikan Pra Sekolah yang berbasis Al-Qur'an dan As-Sunnah.</p>
                            <a href="#" class="btn btn-grad text-white">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-tk">
                            <img src="{{ asset('assets/images/TK_1.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kober</h5>
                            <p class="card-text">Pendidikan Pra Sekolah yang berbasis Al-Qur'an dan As-Sunnah.</p>
                            <a href="#" class="btn btn-grad text-white">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-sd">
                            <img src="{{ asset('assets/images/SD_1.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kober</h5>
                            <p class="card-text">Pendidikan Pra Sekolah yang berbasis Al-Qur'an dan As-Sunnah.</p>
                            <a href="#" class="btn btn-grad text-white">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-smp">
                            <img src="{{ asset('assets/images/SMP_1.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kober</h5>
                            <p class="card-text">Pendidikan Pra Sekolah yang berbasis Al-Qur'an dan As-Sunnah.</p>
                            <a href="#" class="btn btn-grad text-white">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            
            {{-- program --}}
            <div class="center mt-3">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo program" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Program Unggulan</h6>
                <h4 class="mb-3">Beragam Kegiatan Sekolah</h4>
            </div>
        </div>
    </div>
@endsection

   
