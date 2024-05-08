@extends('layouts.app')

@section('content')

{{-- <div class="col-md d-flex" style="flex-direction: column">
    <a class="bg-icon" href="#"><i class="fa-brands fa-facebook fa-xl" ></i></a>
    <a class="bg-icon" href="#"><i class="fa-brands fa-square-instagram fa-xl" ></i></a>
    <a class="bg-icon" href="#"><i class="fa-brands fa-tiktok fa-xl" ></i></a>
</div> --}}
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
                <img src="{{ asset('assets/images/siswa.png') }}" class="center dynamic" alt="logo" width="70%">
            </div>
           
        </div>
    </div>
@endsection

   
