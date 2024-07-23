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
            <div class="vector mt-4">
                <img src="{{ asset('assets/images/star.png') }}" class="star-1-profile" alt="vector" width="3%">
                <img src="{{ asset('assets/images/star.png') }}" class="star-2-profile" alt="vector" width="1%">
                <img src="{{ asset('assets/images/star-sm.png') }}" class="star-3-profile" alt="vector" width="3%">
                <img src="{{ asset('assets/images/star-sm.png') }}" class="star-4-profile" alt="vector" width="1%">
                <img src="{{ asset('assets/images/rocket.png') }}" class="rocket-profile" alt="vector" width="5%">
                <img src="{{ asset('assets/images/ufo.png') }}" class="ufo-profile" alt="vector" width="7%">
                <img src="{{ asset('assets/images/icon_panah.png') }}" class="panah-profile" alt="vector" width="10%">

            </div>
            <div class="center">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo jenjang" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Sekolah Rabbani</h6>
                <h4 class="mb-3">Visi Misi</h4>
            </div>
            <div class="center mt-3">
                <a class="btn btn-primary mb-3"> <h3> Visi </h3> </a>
                <h4>"Menyiapkan peserta didik calon pengusaha muslim yang Qur’ani dalam menyosong kegemilangan Islam."
                </h4>
            </div>
            <div class="center mt-3">
                <a class="btn btn-blue mb-3"> <h3> Misi </h3> </a>
            </div>
            <ol class="mx-auto" style="display: table">
                <li> Sebagai Lembaga Pendidikan yang berdakwah untuk menyiapkan calon pengusaha muslim yang Qur’ani </li>
                <li> Memberikan layanan Pendidikan Qur’ani yang berkualitas </li>
                <li> Mewujudkan lingkungan Pendidikan Rabbani yang terintegrasikan dengan keluarga dan masyarakat </li>
                <li> Menjadikan nilai-nilai Al-Qur’an dan As Sunnah sebagai sumber aktivitas Pendidikan </li>
                <li> Menyelenggarakan kegiatan belajar berbasis Home Based Learning dan Project Based Learning </li>
            </ol>
            <br>
            <br>

            {{-- Lokasi --}}
            <div class="vector mt-4">
            </div>
            <div class="center mt-3">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo program" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Sekolah Rabbani</h6>
                <h4 class="mb-3">Lokasi</h4>
                <p> Sekolah Rabbani mempunyai sekolah yang tersebar di beberapa Kota di Indonesia </p>
            </div>
            <div class="d-flex row center">
                @foreach ($lokasi as $item)
                <div class="col-md-4">
                    <img src="{{ asset($item->image) }}" alt="sr_{{$item->lokasi}}" width="100%">
                </div>
                @endforeach
            </div>
            <br>

            {{-- core value --}}
            <div class="vector">
            </div>
            <div class="center mt-3">
                <img src="{{ asset('assets/images/icon-jenjang.png') }}" class="center" alt="logo program" width="3%">
                <h6 class="mt-1" style="color: #ED145B">Value</h6>
                <h4 class="mb-3">Core Value</h4>
                <p> Sekolah Rabbani mempunyai Quality Assurance (Kualitas Asuransi) untuk menerapkan karakter pada peserta didik </p>
            </div>
            <div class="d-flex mt-4">
                <div class="center">
                    <img src="{{ asset('assets/images/icon_quran.png') }}" alt="icon_quran" width="70%">
                    <h6 class="mt-3"> Quranic </h6>
                    <span>Gemar berinteraksi dengan Al-Qur’an, dan bersemangat untuk belajar serta mengajarkan Al-Qur’an
                    </span>
                </div>
                <div class=" center mx-2">
                    <img src="{{ asset('assets/images/icon_leader.png') }}" alt="icon_leader" width="70%">
                    <h6 class="mt-3"> Leader </h6>
                    <span> Menjadi teladan dalam kebaikan, berakidah kuat, beradab islami, 
                        berakhlakul kharimah, dan mempunyai kemampuan public speaking yang baik. 
                    </span>
                </div>
                <div class="center">
                    <img src="{{ asset('assets/images/icon_preneur.png') }}" alt="icon_preneur" width="70%">
                    <h6 class="mt-3"> Preneur </h6>
                    <span> Mandiri, produktif berkarya, berani menghadapi tantangan dan 
                        mengambil keputusan, kreatif dan berpenghasilan sejak dini. 
                    </span>
                </div>
            </div>
            <br>
            <br>
            
            {{-- ekstrakurikuler --}}
            <div class="vector mt-4">
              
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
                <img src="{{ asset('assets/images/star-happy.png') }}" class="star-5-profile" alt="vector" width="7%">
                <img src="{{ asset('assets/images/planet.png') }}" class="planet-profile" alt="vector" width="7%">
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