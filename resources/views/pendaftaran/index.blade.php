@extends('layouts.app')

@section('content')
    <div class="karir">
        <div class="container">
            <div class="center my-3">
               <h1 style="color: #704996">Informasi Pendaftaran Sekolah Rabbani</h1>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/Siswa.png') }}" alt="siswa" class="img-fluid center" width="480">
                </div>
                <div class="col-md-6">
                    <div class="title center my-5">
                        <h2 >Bergabunglah Bersama Kami</h2>
                        <p >"Membentuk Sumber Daya Manusia yang <i>RABBANI</i> untuk Menjadi Peserta Didik Berjiwa
                            <b>Qur'anic Leaderpreneur (QLP)</b>"
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-primary">Pendaftaran Kober - TK - SD</a>
                        <a href="http://smp.sekolahrabbani.sch.id" target="_blank" class="btn btn-blue mx-3">Pendaftaran SMP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection