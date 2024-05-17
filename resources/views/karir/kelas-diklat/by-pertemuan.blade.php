@extends('karir.layouts.app')

@section('content')
    <div class="karir">
        <div class="container mt-3">
            <div class="row mt-4">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <nav class="nav flex-column nav-menu">
                               @foreach ($kelasDiklat as $item)
                                    <a class="nav-link" href="{{route('karir.kelas_pertemuan', $item->pertemuan)}}">Pertemuan {{$item->pertemuan}}</a>
                               @endforeach
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-body mb-3">
                            @foreach ($kelas_pertemuan as $item)
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-forum-tab" data-bs-toggle="tab" data-bs-target="#nav-forum" type="button" role="tab" aria-controls="nav-forum" aria-selected="true">Forum</button>
                                    <button class="nav-link" id="nav-modul-tab" data-bs-toggle="tab" data-bs-target="#nav-modul" type="button" role="tab" aria-controls="nav-modul" aria-selected="false">Modul</button>
                                    <button class="nav-link" id="nav-tugas-tab" data-bs-toggle="tab" data-bs-target="#nav-tugas" type="button" role="tab" aria-controls="nav-tugas" aria-selected="false">Tugas</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-forum" role="tabpanel" aria-labelledby="nav-forum-tab" tabindex="0">
                                    <p class="mt-3">Tanggal mulai sesi ini : {{$item->tgl_buka_kelas}} </p>
                                    <p class="mt-3">Link sesi ini : <a href="{{$item->forum_link}}" target="_blank"> {{$item->forum_link}} </a></p>
                                </div>
                                <div class="tab-pane fade" id="nav-modul" role="tabpanel" aria-labelledby="nav-modul-tab" tabindex="0">
                                    <h5 class="mt-3">Judul Modul</h5>
                                    <p class="mt-3">Deskripsi Modul {{$item->id_modul}} </p>
                                    <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem vitae soluta quod. Odit eius ipsum dicta iste, autem blanditiis fugit quaerat dolore accusamus error quos dolorum sed. Hic, vel ipsam?</p>
                                    <a href="#" class="btn btn-primary">Download Modul</a>
                                    
                                </div>
                                <div class="tab-pane fade" id="nav-tugas" role="tabpanel" aria-labelledby="nav-tugas-tab" tabindex="0">
                                    <h5 class="mt-3">Judul Tugas</h5>
                                    <p class="mt-3">Deskripsi Tugas</p>
                                    <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem vitae soluta quod. Odit eius ipsum dicta iste, autem blanditiis fugit quaerat dolore accusamus error quos dolorum sed. Hic, vel ipsam?</p>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-primary">Upload Tugas</a>
                                        <a href="#" class="btn btn-primary mx-2">Download Tugas</a>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection