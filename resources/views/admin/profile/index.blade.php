@extends('admin.layouts.app')

@section('content')
    <div class="container iq-container">
        <div class="title mt-3">
            <h1>Profile </h1>
        </div>
        <div class="row mt-3">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="nis" class="form-label col-4">NIS</label>
                                <div class="col-6" id="nis" name="nis" >: {{$profile->nis}} </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_lengkap" class="form-label col-4">Nama Lengkap</label>
                                <div class="col-6" id="nama_lengkap" name="nama_lengkap" >: {{$profile->nama_lengkap}} </div>
                            </div>
                            <div class="form-group row">
                                <label for="tahun_masuk" class="form-label col-4">Tahun Masuk</label>
                                <div class="col-6" id="tahun_masuk" name="tahun_masuk" >: {{$profile->tahun_masuk}} </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="form-label col-4">Kelas</label>
                                <div class="col-6" id="kelas" name="kelas" >: {{$profile->kelas_id}} </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenjang" class="form-label col-4">Jenjang</label>
                                <div class="col-6" id="jenjang" name="jenjang" >: {{$profile->jenjang_id}} </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp_ibu" class="form-label col-4">No Hp Ibu</label>
                                <div class="col-6" id="no_hp_ibu" name="no_hp_ibu" >: {{$profile->no_hp_ibu}} </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp_ayah" class="form-label col-4">No Hp Ayah</label>
                                <div class="col-6" id="no_hp_ayah" name="no_hp_ayah" >: {{$profile->no_hp_ayah}} </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card ">
                    <div class="card-body">
                        <form action="#">
                            <div class="text-center">
                                <i class="fa-regular fa-square-plus fa-2xl"></i>
                                <h5 class="mt-2"> Tambah Data Anak </h5>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection