@extends('layouts.app')

@section('content')
    <div class="">
        <img class="banner-2" src="{{ asset('assets/images/home_rabbani_school-2.png') }}" alt="banner">
        <div class="centered text-white">
            <h1> Formulir Pendaftaran </h1>
        </div>
    </div>
    <div>
        <img src="{{ asset('assets/images/awan1.png') }}" class="cloud-3"  alt="cloud">
        <img src="{{ asset('assets/images/awan2.png') }}" class="cloud-4"  alt="cloud">
    </div>
    <div class="container" style="position: relative; z-index:1000">
        <div class="row mx-auto">
            <div class="col-md">
                <h6 class="mt-1" style="color: #ED145B">Pendaftaran</h6>
                <h4 class="mb-3">Data Calon Siswa</h4>
                <form action="{{route('store.pendaftaran')}}"  method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" required>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="L" >Laki Laki</option>
                            <option value="P" >Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <select name="lokasi" id="lokasi" class="form-control" onchange="getJenjang()" required>
                            <option value="" disabled selected>-- Pilih Lokasi --</option>
                            @foreach ($lokasi as $item)
                                <option value="{{ $item->kode_sekolah }}"> {{ $item->nama_sekolah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select name="jenjang" id="jenjang" class="form-control" onchange="getKelas()" required>
                            <option value="" disabled selected>-- Pilih Jenjang --</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                        <input class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Sekolah Sebelumnya" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <input class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <input class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="no_hp_ayah" class="form-label">No HP Ayah</label>
                        <input class="form-control" id="no_hp_ayah" name="no_hp_ayah" placeholder="No HP Ayah" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="no_hp_ibu" class="form-label">No HP Ibu</label>
                        <input class="form-control" id="no_hp_ibu" name="no_hp_ibu" placeholder="No HP Ibu" required>
                    </div>

                    <div class="mt-3 center">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
          
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function getJenjang() {
            var id_lokasi = document.getElementById("lokasi").value
            $.ajax({
                url: "{{route('get_jenjang')}}",
                type: 'POST',
                data: {
                    id_lokasi: id_lokasi,
                     _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    $('#jenjang').html('<option value="">-- Pilih Jenjang --</option>');
                    $.each(result.jenjang, function (key, item) {
                        $("#jenjang").append('<option value="' + item
                            .jenjang_id + '">' + item.jenjang.nama_jenjang + '</option>');
                    });
                }
            });
        }
        
        function getKelas() {
            var id_jenjang = document.getElementById("jenjang").value
            var id_lokasi = document.getElementById("lokasi").value

            // alert(id_jenjang)
            $.ajax({
                url: "{{route('get_kelas')}}",
                type: 'POST',
                data: {
                    id_lokasi: id_lokasi,
                    id_jenjang: id_jenjang,
                     _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    $('#kelas').html('<option value="">-- Pilih Kelas --</option>');
                    $.each(result.kelas, function (key, item) {
                        $("#kelas").append('<option value="' + item
                            .id + '">' + item.kelas.nama_kelas + '</option>');
                    });
                }
            });
        }
    </script>
@endsection