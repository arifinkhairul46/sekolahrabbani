@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 my-auto" style="text-align: end">
                <h3 > Berbicara tentang <span style="color: #118ECC">ilmu</span> adalah tanda kebaikan hati. Berbagi ilmu adalah <span style="color: #118ECC">amal</span> yang terus memberi manfaat.
                </h3>
                <p class="mt-3">Ustadz Nur Ihsan Jundulloh, Lc. - Pengawas Rabbani </p>
                <div class="d-flex justify-content-end">
                    <img src="{{ asset('assets/images/logo_fb.png') }}" alt="logo program" style="width: 5%">
                    <img src="{{ asset('assets/images/logo_twitter.png') }}" class="mx-1" alt="logo program" style="width: 5%">
                    <img src="{{ asset('assets/images/logo_linkedin.png') }}" alt="logo program" style="width: 5%">
                    <img src="{{ asset('assets/images/logo_ig.png') }}" class="mx-1" alt="logo program" style="width: 5%">
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/images/ust_ihsan.png') }}" alt="logo program" width="90%">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/ust_choi.png') }}" alt="logo program" width="65%">
            </div>
            <div class="col-md-6 my-auto">
                <h3> Berbicara tentang <span style="color: #118ECC">ilmu</span> adalah tanda kebaikan hati. Berbagi ilmu adalah <span style="color: #118ECC">amal</span> yang terus memberi manfaat.
                </h3>
                <p class="mt-3">Ustadz Khoiruddin Aditha Yudha - Ketua Yayasan </p>
                <div class="d-flex justify-content-start">
                    <img src="{{ asset('assets/images/logo_fb.png') }}" alt="logo program" style="width: 5%">
                    <img src="{{ asset('assets/images/logo_twitter.png') }}" class="mx-1" alt="logo program" style="width: 5%">
                    <img src="{{ asset('assets/images/logo_linkedin.png') }}" alt="logo program" style="width: 5%">
                    <img src="{{ asset('assets/images/logo_ig.png') }}" class="mx-1" alt="logo program" style="width: 5%">
                </div>
            </div>
        </div>
    </div>

    {{-- visi-misi --}}
    <div class="jenjang-program mt-5">
        <div class="container ">
            <div class="center">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo jenjang" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Sekolah Rabbani</h6>
                <h4 class="mb-3">Visi Misi</h4>
            </div>
            {{-- <div class="row mb-4">
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
            </div> --}}
            <br>
            <br>
            
            {{-- program --}}
            <div class="vector mt-4">
                <img src="{{ asset('assets/images/star.png') }}" class="star-1-profile" alt="vector" width="3%">
                <img src="{{ asset('assets/images/star.png') }}" class="star-2-profile" alt="vector" width="1%">
                <img src="{{ asset('assets/images/star-sm.png') }}" class="star-3-profile" alt="vector" width="3%">
                <img src="{{ asset('assets/images/star-sm.png') }}" class="star-4-profile" alt="vector" width="1%">
                <img src="{{ asset('assets/images/rocket.png') }}" class="rocket" alt="vector" width="5%">
                <img src="{{ asset('assets/images/ufo.png') }}" class="ufo" alt="vector" width="7%">
            </div>
            <div class="center mt-3">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo program" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Menembus Batas</h6>
                <h4 class="mb-3">Ekstrakurikuler Sekolah</h4>
                <p> Eksplorasi kegiatan Ekstrakurikuler yang Inspiratif dan beragam di Sekolah Rabbani untuk menggali potensi Siswa. </p>
            </div>
            <div class="d-flex mt-4">
                <div class="center">
                    <img src="{{ asset('assets/images/memanah.png') }}" alt="ekskul_memanah" width="60%">
                    <h6 class="mt-3"> Memanah </h6>
                    <span> Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </span>
                </div>
                <div class=" center mx-2">
                    <img src="{{ asset('assets/images/berkuda.png') }}" alt="ekskul_berkuda" width="60%">
                    <h6 class="mt-3"> Berkuda </h6>
                    <span> Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    </span>
                </div>
                <div class="center">
                    <img src="{{ asset('assets/images/beladiri.png') }}" alt="ekskul_bela_diri" width="60%">
                    <h6 class="mt-3"> Bela Diri </h6>
                    <span> Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    </span>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>

    {{-- struktur --}}
    <div class="fasilitas">
        <div class="container">
            <div class="vector">
                <img src="{{ asset('assets/images/star-happy.png') }}" class="star-5" alt="vector" width="7%">
                <img src="{{ asset('assets/images/planet.png') }}" class="planet" alt="vector" width="7%">
            </div>
            <div class="center">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo program" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Management</h6>
                <h4 class="mb-3">Struktur Management Yayasan</h4>
                <p >Sekolah Rabbani memberikan fasilitas yang maksimal untuk pengalaman pendidikan <br> yang menyeluruh, memotivasi, dan mempersiapkan siswa untuk menjadi pengusaha muslim.</p>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-fasilitas">
                            <img src="{{ asset('assets/images/kelas.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">Kelas Eksekutif</h5>
                            <p style="font-size: 12px"> Eksplorasi Ruang Kelas Interaktif, Modern dilengkapi AC dan TV untuk menunjang kenyamanan Belajar </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-fasilitas">
                            <img src="{{ asset('assets/images/lift.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">Lift</h5>
                            <p style="font-size: 12px"> Eksplorasi Ruang Kelas Interaktif, Modern dilengkapi AC dan TV untuk menunjang kenyamanan Belajar </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-fasilitas">
                            <img src="{{ asset('assets/images/jemputan.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">Mobil Antar Jemput</h5>
                            <p style="font-size: 12px"> Eksplorasi Ruang Kelas Interaktif, Modern dilengkapi AC dan TV untuk menunjang kenyamanan Belajar </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="bg-fasilitas">
                            <img src="{{ asset('assets/images/playground.png') }}" class="card-img-top" alt="kober">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">Playground</h5>
                            <p style="font-size: 12px"> Eksplorasi Ruang Kelas Interaktif, Modern dilengkapi AC dan TV untuk menunjang kenyamanan Belajar </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                
@endsection