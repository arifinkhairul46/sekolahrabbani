@extends('layouts.app')

@section('content')
    <div class="">
        <img class="banner-2" src="{{ asset('assets/images/home_rabbani_school-2.png') }}" alt="banner">
        {{-- <div class="centered text-white">
            <h1> Formulir Pemenuhan Data </h1>
        </div> --}}
    </div>
    {{-- <div>
        <img src="{{ asset('assets/images/awan1.png') }}" class="cloud-pmnh"  alt="cloud">
        <img src="{{ asset('assets/images/awan2.png') }}" class="cloud-pmnhn"  alt="cloud">
    </div> --}}
    <div class="container" style="position: relative; z-index:1000">
        <div class="row mx-auto">
            <div class="col-md">
                <h6 class="mt-1" style="color: #ED145B">Pemenuhan Data</h6>
                <h4 class="mb-3">Data Calon Siswa</h4>
                <form action="{{route('store.pendaftaran')}}"  method="POST">
                    @csrf
                    <div class="form-group">
                       <div class="d-flex">
                        <input type="text" class="form-control form-control-sm" aria-label=".form-control-sm example" placeholder="Masukkan No Registrasi/Pendaftaran">
                        <button type="submit" class="btn btn-primary mx-3"> Cari </button>
                       </div>
                    </div>
                    <small> Lupa No Registrasi/Pendaftaran ? <a href="#" data-bs-toggle="modal" data-bs-target="#lupa_no_regis"> Klik Disini </a> </small>
                </form>
                <form >
                    <nav>
                        <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-data-anak-tab" data-bs-toggle="tab" data-bs-target="#nav-data-anak" type="button" role="tab" aria-controls="nav-data-anak" aria-selected="true">Data Anak</button>
                            <button class="nav-link" id="nav-data-ibu-tab" data-bs-toggle="tab" data-bs-target="#nav-data-ibu" type="button" role="tab" aria-controls="nav-data-ibu" aria-selected="false">Data Ibu</button>
                            <button class="nav-link" id="nav-data-ayah-tab" data-bs-toggle="tab" data-bs-target="#nav-data-ayah" type="button" role="tab" aria-controls="nav-data-ayah" aria-selected="false">Data Ayah</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-data-anak" role="tabpanel" aria-labelledby="nav-data-anak-tab" tabindex="0">
                            <div class="my-3">
                                <span for="nama_lengkap" class="form-label">Nama Lengkap</span>
                                <input type="text" name="nama_lengkap" class="form-control form-control-sm" id="nama_lengkap" readonly>
                            </div>
        
                            <div class="mb-3">
                                <span for="tempat_tanggal_lahir" class="form-label">Tempat, Tanggal Lahir</span>
                                <input type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" class="form-control form-control-sm" value="Jakarta, 11 Mar" readonly>
                            </div>
        
                            <div class="mb-3">
                                <span for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</span>
                                <input type="number" name="nik" class="form-control form-control-sm" id="nik" placeholder="Masukkan No NIK" min="16" required>
                            </div>
        
                            <div class="mb-3">
                                <span for="alamat" class="form-label">Alamat Sekarang</span>
                                <input type="text" name="alamat" class="form-control form-control-sm" id="alamat" placeholder="Jalan, No. RT/RW">
                            </div>
                            
                            <div class="mb-3">
                                <span for="provinsi" class="form-label">Provinsi</span>
                                <select id="provinsi" name="provinsi" class="select form-control form-control-sm"  onchange="getKota()">
                                    <option value="" disabled selected>-- Pilih Provinsi--</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="kota" class="form-label">Kabupaten/Kota</span>
                                <select id="kota" name="kota" class="select form-control form-control-sm" onchange="getKecamatan()">
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="kecamatan" class="form-label">Kecamatan</span>
                                <select id="kecamatan" name="kecamatan" class="select form-control form-control-sm" onchange="getKelurahan()">
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="kelurahan" class="form-label">Desa/Kelurahan</span>
                                <select id="kelurahan" name="kelurahan" class="select form-control form-control-sm">
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span for="anak_ke" class="form-label">Anak Ke</span>
                                    <input type="number" class="form-control form-control-sm" id="anak_ke" name="anak_ke" placeholder="Anak Ke" required>
                                </div>
                                <div class="col-md-6">
                                    <span for="jumlah_saudara" class="form-label">Dari Jumlah Saudara </span>
                                    <input type="number" type="text" class="form-control form-control-sm" id="jumlah_saudara" name="jumlah_saudara" placeholder="dari berapa saudara" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span for="tinggi_badan" class="form-label">Tinggi Badan (cm)</span>
                                <input type="number" name="tinggi_badan" class="form-control form-control-sm" id="tinggi_badan" placeholder="xxx">
                            </div>
        
                            <div class="mb-3">
                                <span for="berat_badan" class="form-label">Berat Badan (kg)</span>
                                <input type="number" name="berat_badan" class="form-control form-control-sm" id="berat_badan" placeholder="xx">
                            </div>
        
                            <div class="mb-3">
                                <span for="agama" class="form-label">Agama</span>
                                <input type="text" name="agama" class="form-control form-control-sm" id="agama" placeholder="Agama">
                            </div>
        
                            <div class="mb-3">
                                <span for="gol_dar" class="form-label">Golongan Darah</span>
                                <select id="gol_dar" name="gol_dar" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                                    <option value="A" >A</option>
                                    <option value="B" >B</option>
                                    <option value="AB" >AB</option>
                                    <option value="O" >O</option>
                                </select>
                            </div>
        
                            <div class="mb-3">
                                <span for="hafalan" class="form-label">Hafalan Juz</span>
                                <input type="number" name="hafalan" class="form-control form-control-sm" id="hafalan" placeholder="Sudah hafal berapa juz">
                            </div>

                            <div class="mb-3">
                                <span for="riwayat_penyakit" class="form-label">Riwayat_penyakit</span>
                                <input type="text" name="riwayat_penyakit" class="form-control form-control-sm" id="riwayat_penyakit">
                            </div>
                            
                            <div class="mb-3">
                                <span for="info_ppdb" class="form-label">Informasi PPDB</span>
                                <div class="form-check">
                                    <input type="radio" name="radios" class="form-check-input" id="spanduk_baliho">
                                    <label class="form-check-label" for="spanduk_baliho">Spanduk / Baliho</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radios" class="form-check-input" id="flyer">
                                    <label class="form-check-label" for="flyer">Flyer</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radios" class="form-check-input" id="instagram">
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="radios" class="form-check-input"  onclick="lainnya()" id="lainnya">
                                    <label class="form-check-label" for="lainnya">Lainnya</label>
                                </div>
                                
                                <div class="mb-3 form-check show_rekom" id="show_rekom">
                                    <input type="hidden" name="info_ppdb2" id="info_ppdb2" placeholder="Sebutkan" class="form-control form-control-sm"><br>
                                </div>
                            </div>

                            
                            <button class="btn btn-primary btn-sm" onclick="next_ibu()"> Next </button>
                        </div>


                        <div class="tab-pane fade" id="nav-data-ibu" role="tabpanel" aria-labelledby="nav-data-ibu-tab" tabindex="0">
                            <div class="my-3">
                                <span for="nama_ibu" class="form-label">Nama Lengkap Ibu</span>
                                <input type="text" name="nama_ibu" class="form-control form-control-sm" id="nama_ibu" placeholder="Nama Ibu" readonly>
                            </div>
        
                            <div class="row mb-3">
                                <div class=" col-md-6">
                                    <span for="tempat_lahir_ibu" class="form-label">Tempat Lahir</span>
                                    <input class="form-control form-control-sm" id="tempat_lahir_ibu" name="tempat_lahir_ibu" placeholder="Tempat Lahir" required>
                                </div>
                                <div class=" col-md-6">
                                    <span for="tgl_lahir_ibu" class="form-label">Tanggal Lahir</span>
                                    <input type="date" class="form-control form-control-sm" id="tgl_lahir_ibu" name="tgl_lahir_ibu" placeholder="Tanggal Lahir" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</span>
                                <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                    <option value="PNS" >PNS</option>
                                    <option value="Karyawan BUMN/BUMD" >Karyawan BUMN/BUMD</option>
                                    <option value="Karyawan Swasta" >Karyawan Swasta</option>
                                    <option value="Karyawan Rabbani" >Karyawan Rabbani</option>
                                    <option value="Guru/Dosen" >Guru/Dosen</option>
                                    <option value="TNI/POLRI" >TNI/POLRI</option>
                                    <option value="Wiraswasta" >Wiraswasta</option>
                                    <option value="Ibu Rumah Tangga" >Ibu Rumah Tangga</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="penghasilan_ibu" class="form-label">Penghasilan Ibu</span>
                                <select id="penghasilan_ibu" name="penghasilan_ibu" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Penghasilan --</option>
                                    <option value="1" >< Rp. 3.000.000</option>
                                    <option value="2" >Rp. 3.000.000 - Rp. 5.000.000</option>
                                    <option value="3" >Rp. 5.000.000 - Rp. 8.000.000</option>
                                    <option value="4" >Rp. 8.000.000 - Rp. 10.000.000</option>
                                    <option value="5" >Rp. 10.000.000 - Rp. 15.000.000</option>
                                    <option value="6" >> Rp. 15.000.000</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="pendidikan_ibu" class="form-label">Pendidikan Terakhir Ibu</span>
                                <select id="pendidikan_ibu" name="pendidikan_ibu" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                    <option value="SMP" >SMP</option>
                                    <option value="SMA" >SMA</option>
                                    <option value="Diploma" >Diploma</option>
                                    <option value="S1" >S1 / D4</option>
                                    <option value="S2" >S2</option>
                                    <option value="S3" >S3</option>
                                </select>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="nav-data-ayah" role="tabpanel" aria-labelledby="nav-data-ayah-tab" tabindex="0">
                            <div class="my-3">
                                <span for="nama_ayah" class="form-label">Nama Lengkap ayah</span>
                                <input type="text" name="nama_ayah" class="form-control form-control-sm" id="nama_ayah" placeholder="Nama ayah" readonly>
                            </div>
        
                            <div class="row mb-3">
                                <div class=" col-md-6">
                                    <span for="tempat_lahir_ayah" class="form-label">Tempat Lahir</span>
                                    <input class="form-control form-control-sm" id="tempat_lahir_ayah" name="tempat_lahir_ayah" placeholder="Tempat Lahir" required>
                                </div>
                                <div class=" col-md-6">
                                    <span for="tgl_lahir_ayah" class="form-label">Tanggal Lahir</span>
                                    <input type="date" class="form-control form-control-sm" id="tgl_lahir_ayah" name="tgl_lahir_ayah" placeholder="Tanggal Lahir" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span for="pekerjaan_ayah" class="form-label">Pekerjaan ayah</span>
                                <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                    <option value="PNS" >PNS</option>
                                    <option value="Karyawan BUMN/BUMD" >Karyawan BUMN/BUMD</option>
                                    <option value="Karyawan Swasta" >Karyawan Swasta</option>
                                    <option value="Karyawan Rabbani" >Karyawan Rabbani</option>
                                    <option value="Guru/Dosen" >Guru/Dosen</option>
                                    <option value="TNI/POLRI" >TNI/POLRI</option>
                                    <option value="Wiraswasta" >Wiraswasta</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="penghasilan_ayah" class="form-label">Penghasilan ayah</span>
                                <select id="penghasilan_ayah" name="penghasilan_ayah" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Penghasilan --</option>
                                    <option value="1" >< Rp. 3.000.000</option>
                                    <option value="2" >Rp. 3.000.000 - Rp. 5.000.000</option>
                                    <option value="3" >Rp. 5.000.000 - Rp. 8.000.000</option>
                                    <option value="4" >Rp. 8.000.000 - Rp. 10.000.000</option>
                                    <option value="5" >Rp. 10.000.000 - Rp. 15.000.000</option>
                                    <option value="6" >> Rp. 15.000.000</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <span for="pendidikan_ayah" class="form-label">Pendidikan Terakhir ayah</span>
                                <select id="pendidikan_ayah" name="pendidikan_ayah" class="select form-control form-control-sm">
                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                    <option value="SMP" >SMP</option>
                                    <option value="SMA" >SMA</option>
                                    <option value="Diploma" >Diploma</option>
                                    <option value="S1" >S1 / D4</option>
                                    <option value="S2" >S2</option>
                                    <option value="S3" >S3</option>
                                </select>
                            </div>

                            <div class="d-flex" style="justify-content: flex-end">
                                <button type="submit" class="btn btn-primary btn-sm ml-auto" > Submit </button>
                            </div>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name=radios]:radio').change(function(e) {
                    let value = e.target.value.trim()

                    $('[class^="form"]').css('display', 'none');

                    switch (value) {
                    case 'red':
                        $('.form-a').show()
                        break;
                    case 'green':
                        $('.form-b').show()
                        break;
                    case 'blue':
                        $('.form-c').show()
                        break;
                    default:
                        break;
                    }
                })
            });

        function getKota() {
            var id_provinsi = document.getElementById("provinsi").value
            $.ajax({
                url: "{{route('get_kota')}}",
                type: 'POST',
                data: {
                    id_provinsi: id_provinsi,
                     _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    $('#kota').html('<option value="">-- Pilih kota --</option>');
                    $.each(result.kota, function (key, item) {
                        $("#kota").append('<option value="' + item
                            .id + '">' + item.kabupaten_kota + '</option>');
                    });
                }
            });
        }
        
        function getKecamatan() {
            var id_kota = document.getElementById("kota").value
            $.ajax({
                url: "{{route('get_kecamatan')}}",
                type: 'POST',
                data: {
                    id_kota: id_kota,
                     _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    $('#kecamatan').html('<option value="">-- Pilih kecamatan --</option>');
                    $.each(result.kecamatan, function (key, item) {
                        $("#kecamatan").append('<option value="' + item
                            .id + '">' + item.kecamatan + '</option>');
                    });
                }
            });
        }

        function getKelurahan() {
            var id_kecamatan = document.getElementById("kecamatan").value
            $.ajax({
                url: "{{route('get_kelurahan')}}",
                type: 'POST',
                data: {
                    id_kecamatan: id_kecamatan,
                     _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    $('#kelurahan').html('<option value="">-- Pilih kelurahan --</option>');
                    $.each(result.kelurahan, function (key, item) {
                        $("#kelurahan").append('<option value="' + item
                            .id + '">' + item.kelurahan + '</option>');
                    });
                }
            });
        }

        $('#spanduk_baliho', '#instagram').change(function() {
            if(this.checked) {
                $('#info_ppdb2').hide();
            } else {
                $('#info_ppdb2').show();
            }
        });
       
    </script>
@endsection

<div class="modal fade" id="lupa_no_regis" tabindex="-1" role="dialog" aria-labelledby="lupa_regis" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" method="POST" action="{{route('forget_no_regis')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lupa_regis">Lupa No Pendaftaran / Registrasi</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Masukkan No HP Anda</label>
                        <input type="text" name="no_hp" class="form-control form-control-sm" placeholder="08xx" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control form-control-sm" placeholder="Masukkan Nama Anak Anda" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm my-4 text-white">Kirim</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form> 
    </div>
</div>

