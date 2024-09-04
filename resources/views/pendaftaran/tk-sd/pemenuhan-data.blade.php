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
                <form action="{{route('form.update')}}"  method="GET">
                    <div class="form-group">
                    <div class="d-flex">
                        <input type="text" name="no_registrasi" id="no_registrasi" class="form-control form-control-sm px-3" aria-label=".form-control-sm px-3 example" value="{{$no_registrasi}}" placeholder="Masukkan No Registrasi/Pendaftaran">
                        <button type="submit" class="btn btn-primary mx-3"> Cari </button>
                    </div>
                    </div>
                    <small> Lupa No Registrasi/Pendaftaran ? <a href="#" data-bs-toggle="modal" data-bs-target="#lupa_no_regis"> Klik Disini </a> </small>
                </form>
                @if ($get_profile != null)
                    <form action="{{route('form.update.id', $get_profile->id_anak)}}" id="update_data_pendaftaran"  method="post">
                        @csrf @method('PUT')
                        <nav>
                            <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
                                <button class="nav-link tab-1 active" id="nav-data-anak-tab" data-bs-toggle="tab" data-bs-target="#nav-data-anak" type="button" role="tab" aria-controls="nav-data-anak" aria-selected="true">Data Anak</button>
                                <button class="nav-link tab-2" id="nav-data-ibu-tab" data-bs-toggle="tab" data-bs-target="#nav-data-ibu" type="button" role="tab" aria-controls="nav-data-ibu" aria-selected="false">Data Ibu</button>
                                <button class="nav-link tab-3" id="nav-data-ayah-tab" data-bs-toggle="tab" data-bs-target="#nav-data-ayah" type="button" role="tab" aria-controls="nav-data-ayah" aria-selected="false">Data Ayah</button>
                                <button class="nav-link tab-4" id="nav-data-wali-tab" data-bs-toggle="tab" data-bs-target="#nav-data-wali" type="button" role="tab" aria-controls="nav-data-wali" aria-selected="false">Data Wali</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-data-anak" role="tabpanel" aria-labelledby="nav-data-anak-tab" tabindex="0">
                                <div class="my-3">
                                    <span for="nama_lengkap" class="form-label">Nama Lengkap</span>
                                    <input type="text" name="nama_lengkap" class="form-control form-control-sm px-3" id="nama_lengkap" value="{{$get_profile->nama_lengkap }}" readonly>
                                </div>
            
                                <div class="mb-3">
                                    <span for="tempat_tanggal_lahir" class="form-label">Tempat, Tanggal Lahir</span>
                                    <input type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" class="form-control form-control-sm px-3" value="{{$get_profile->tempat_lahir}} {{date('d-F-Y', strtotime($get_profile->tgl_lahir))}}"  readonly>
                                </div>

                                <div class="mb-3">
                                    <span for="nama_panggilan" class="form-label">Nama Panggilan</span>
                                    <input type="text" name="nama_panggilan" class="form-control form-control-sm px-3" id="nama_panggilan" value="{{$get_profile->nama_panggilan }}" required>
                                </div>
            
                                <div class="mb-3">
                                    <span for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</span>
                                    <input type="tel" name="nik" class="form-control form-control-sm px-3" id="nik" onkeypress="return /[0-9]/i.test(event.key)" minlength="16" value="{{$get_profile->no_nik }}" placeholder="Masukkan No NIK" required>
                                </div>
            
                                <div class="mb-3">
                                    <span for="alamat" class="form-label">Alamat Sekarang</span>
                                    <input type="text" name="alamat" class="form-control form-control-sm px-3" id="alamat" value="{{$get_profile->alamat}}" placeholder="Jalan, No. RT/RW" required>
                                </div>
                                
                                <div class="mb-3">
                                    <span for="provinsi" class="form-label">Provinsi</span>
                                    <select id="provinsi" name="provinsi" class="select form-control form-control-sm px-3"  onchange="getKota()" required>
                                        <option value="" disabled selected>-- Pilih Provinsi--</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}" {{($get_profile->provinsi == $item->id) ? 'selected' : ''}} >{{ $item->provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="kota" class="form-label">Kabupaten/Kota</span>
                                    <select id="kota" name="kota" class="select form-control form-control-sm px-3" onchange="getKecamatan()" required>
                                        {{-- <option value="" disabled selected>-- Pilih Kota--</option>
                                        @foreach ($kota as $item)
                                            <option value="{{ $item->id }}" {{($get_profile->kota == $item->id) ? 'selected' : ''}} >{{ $item->kabupaten_kota }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="kecamatan" class="form-label">Kecamatan</span>
                                    <select id="kecamatan" name="kecamatan" class="select form-control form-control-sm px-3" onchange="getKelurahan()" required>
                                        {{-- <option value="" disabled selected>-- Pilih Kecamatan--</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}" {{($get_profile->kecamatan == $item->id) ? 'selected' : ''}} >{{ $item->kecamatan }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="kelurahan" class="form-label">Desa/Kelurahan</span>
                                    <select id="kelurahan" name="kelurahan" class="select form-control form-control-sm px-3">
                                        {{-- <option value="" disabled selected>-- Pilih Desa/Kelurahan --</option>
                                        @foreach ($kelurahan as $item)
                                            <option value="{{ $item->id }}" {{($get_profile->kelurahan == $item->id) ? 'selected' : ''}} >{{ $item->kelurahan }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="status_tinggal" class="form-label">Status Tinggal</span>
                                    <select id="status_tinggal" name="status_tinggal" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Status Tinggal Bersama --</option>
                                        <option value="Orang Tua" {{($get_profile->status_tinggal == 'Orang Tua') ? 'selected' : ''}} >Orang Tua</option>
                                        <option value="Wali" {{($get_profile->status_tinggal == 'Wali') ? 'selected' : ''}} >Wali</option>
                                        <option value="Kost" {{($get_profile->status_tinggal == 'Kost') ? 'selected' : ''}} >Kost</option>
                                        <option value="Asrama" {{($get_profile->status_tinggal == 'Asrama') ? 'selected' : ''}} >Asrama</option>
                                        <option value="Panti Asuhan" {{($get_profile->status_tinggal == 'Panti Asuhan') ? 'selected' : ''}} >Panti Asuhan</option>
                                        <option value="Pesantren" {{($get_profile->status_tinggal == 'Pesantren') ? 'selected' : ''}} >Pesantren</option>            
                                        <option value="Lainnya" {{($get_profile->status_tinggal == 'Lainnya') ? 'selected' : ''}} >Lainnya</option>
                                    </select>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span for="anak_ke" class="form-label">Anak Ke</span>
                                        <input type="number" class="form-control form-control-sm px-3" id="anak_ke" name="anak_ke" value="{{$get_profile->anak_ke}}"  placeholder="Anak Ke"  >
                                    </div>
                                    <div class="col-md-6">
                                        <span for="jumlah_saudara" class="form-label">Dari Jumlah Saudara </span>
                                        <input type="number" type="text" class="form-control form-control-sm px-3" id="jumlah_saudara" name="jumlah_saudara" value="{{$get_profile->jml_sdr}}"  placeholder="dari berapa saudara"  >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span for="tinggi_badan" class="form-label">Tinggi Badan (cm)</span>
                                    <input type="number" name="tinggi_badan" class="form-control form-control-sm px-3" id="tinggi_badan" value="{{$get_profile->tinggi_badan}}"  placeholder="xxx">
                                </div>
            
                                <div class="mb-3">
                                    <span for="berat_badan" class="form-label">Berat Badan (kg)</span>
                                    <input type="number" name="berat_badan" class="form-control form-control-sm px-3" id="berat_badan" value="{{$get_profile->berat_badan}}"  placeholder="xx">
                                </div>

                                <div class="mb-3">
                                    <span for="bhs_digunakan" class="form-label">Bahasa yang Digunakan</span>
                                    <select id="bhs_digunakan" name="bhs_digunakan" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Bahasa --</option>
                                        <option value="bhs_indo" {{($get_profile->bahasa == 'bhs_indo') ? 'selected' : ''}}>Bahasa Indonesia</option>
                                        <option value="bhs_inggris" {{($get_profile->bahasa == 'bhs_inggris') ? 'selected' : ''}}>Bahasa Inggris</option>
                                        <option value="bhs_arab" {{($get_profile->bahasa == 'bhs_arab') ? 'selected' : ''}}>Bahasa Arab</option>
                                        <option value="bhs_sunda" {{($get_profile->bahasa == 'bhs_sunda') ? 'selected' : ''}}>Bahasa Sunda</option>
                                        <option value="bhs_jawa" {{($get_profile->bahasa == 'bhs_jawa') ? 'selected' : ''}}>Bahasa Jawa</option>
                                        <option value="lainnya" {{($get_profile->bahasa == 'lainnya') ? 'selected' : ''}}>Lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="asal_sekolah" class="form-label">Asal Sekolah</span>
                                    <input class="form-control form-control-sm px-3" id="asal_sekolah" name="asal_sekolah" value="{{$get_profile->asal_sekolah}}"  placeholder="Sekolah Sebelumnya"  >
                                </div>
                             
                                <div class="mb-3">
                                    <span for="npsn" class="form-label">NPSN</span>
                                    <input class="form-control form-control-sm px-3" id="npsn" name="npsn" value="{{$get_profile->npsn}}"  placeholder="Nomor Pokok Siswa Nasional"  >
                                </div>

                                <div class="mb-3">
                                    <span for="kec_asal_sekolah" class="form-label">Kecamatan Asal Sekolah</span>
                                    <select id="kec_asal_sekolah" name="kec_asal_sekolah" class="select2 form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Kecamatan Asal Sekolah--</option>
                                        @foreach ($kecamatan_asal_sekolah as $item)
                                            <option value="{{ $item->id_kecamatan }}" {{($get_profile->kec_asal_sekolah == $item->id_kecamatan) ? 'selected' : '' }} >{{ $item->kecamatan }} - {{ $item->kabupaten_kota }} </option>
                                        @endforeach
                                    </select>
                                </div>
            
                                <div class="mb-3">
                                    <span for="agama" class="form-label">Agama</span>
                                    <input type="text" name="agama" class="form-control form-control-sm px-3" id="agama" value="{{$get_profile->agama}}" placeholder="Agama">
                                </div>
            
                                <div class="mb-3">
                                    <span for="gol_darah" class="form-label">Golongan Darah</span>
                                    <select id="gol_darah" name="gol_darah" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                                        <option value="A" {{($get_profile->gol_darah == 'A') ? 'selected' : ''}}>A</option>
                                        <option value="B" {{($get_profile->gol_darah == 'B') ? 'selected' : ''}}>B</option>
                                        <option value="AB" {{($get_profile->gol_darah == 'AB') ? 'selected' : ''}}>AB</option>
                                        <option value="O" {{($get_profile->gol_darah == '0') ? 'selected' : ''}}>O</option>
                                    </select>
                                </div>
            
                                <div class="mb-3">
                                    <span for="hafalan" class="form-label">Hafalan Juz</span>
                                    <input type="number" name="hafalan" class="form-control form-control-sm px-3" id="hafalan" value="{{$get_profile->hafalan}}" placeholder="Sudah hafal berapa juz">
                                </div>

                                <div class="mb-3">
                                    <span for="riwayat_penyakit" class="form-label">Riwayat_penyakit</span>
                                    <input type="text" name="riwayat_penyakit" class="form-control form-control-sm px-3" value="{{$get_profile->riwayat_penyakit}}" id="riwayat_penyakit" placeholder="Riwayat Penyakit">
                                </div>

                                
                                {{-- <button type="button" class="btn btn-primary btn-sm px-3" onclick="next_ibu()"> Next </button> --}}
                                <a style="float: right" id="next-ibu" class="btn btn-primary btn-sm px-3">Next</a>

                            </div>

                            <div class="tab-pane fade" id="nav-data-ibu" role="tabpanel" aria-labelledby="nav-data-ibu-tab" tabindex="0">
                                <div class="my-3">
                                    <span for="nama_ibu" class="form-label">Nama Lengkap Ibu</span>
                                    <input type="text" name="nama_ibu" class="form-control form-control-sm px-3" id="nama_ibu" placeholder="Nama Ibu"  value="{{$get_profile_ibu != null ? $get_profile_ibu->nama : ''}}" readonly>
                                </div>

                                <div class="mb-3">
                                    <span for="email_ibu" class="form-label">Email Ibu</span>
                                    <input type="email" name="email_ibu" class="form-control form-control-sm px-3" id="email_ibu" value="{{$get_profile->email_ibu}}" placeholder="Email Ibu" >
                                </div>
            
                                <div class="row mb-3">
                                    <div class=" col-md-6">
                                        <span for="tempat_lahir_ibu" class="form-label">Tempat Lahir</span>
                                        <input class="form-control form-control-sm px-3" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{$get_profile_ibu->tptlahir_ibu}}" placeholder="Tempat Lahir"  >
                                    </div>
                                    <div class=" col-md-6">
                                        <span for="tgl_lahir_ibu" class="form-label">Tanggal Lahir</span>
                                        <input type="date" class="form-control form-control-sm px-3" id="tgl_lahir_ibu" name="tgl_lahir_ibu" value="{{$get_profile->tgllahir_ibu}}" placeholder="Tanggal Lahir"  >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</span>
                                    <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                        <option value="PNS" {{($get_profile_ibu->pekerjaan_jabatan == 'PNS') ? 'selected' : ''}} >PNS</option>
                                        <option value="Karyawan BUMN/BUMD" {{($get_profile_ibu->pekerjaan_jabatan == 'Karyawan BUMN/BUMD') ? 'selected' : ''}}>Karyawan BUMN/BUMD</option>
                                        <option value="Karyawan Swasta" {{($get_profile_ibu->pekerjaan_jabatan == 'Karyawan Swasta') ? 'selected' : ''}} >Karyawan Swasta</option>
                                        <option value="Karyawan Rabbani" {{($get_profile_ibu->pekerjaan_jabatan == 'Karyawan Rabbani') ? 'selected' : ''}} >Karyawan Rabbani</option>
                                        <option value="Guru/Dosen" {{($get_profile_ibu->pekerjaan_jabatan == 'Guru/Dosen') ? 'selected' : ''}} >Guru/Dosen</option>
                                        <option value="TNI/POLRI" {{($get_profile_ibu->pekerjaan_jabatan == 'TNI/POLRI') ? 'selected' : ''}} >TNI/POLRI</option>
                                        <option value="Wiraswasta" {{($get_profile_ibu->pekerjaan_jabatan == 'Wiraswasta') ? 'selected' : ''}} >Wiraswasta</option>
                                        <option value="Ibu Rumah Tangga" {{($get_profile_ibu->pekerjaan_jabatan == 'Ibu Rumah Tangga') ? 'selected' : ''}} >Ibu Rumah Tangga</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="penghasilan_ibu" class="form-label">Penghasilan Ibu</span>
                                    <select id="penghasilan_ibu" name="penghasilan_ibu" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Penghasilan --</option>
                                        <option value="1" {{($get_profile_ibu->penghasilan == '1') ? 'selected' : ''}} >< Rp. 3.000.000</option>
                                        <option value="2" {{($get_profile_ibu->penghasilan == '2') ? 'selected' : ''}} >Rp. 3.000.000 - Rp. 5.000.000</option>
                                        <option value="3" {{($get_profile_ibu->penghasilan == '3') ? 'selected' : ''}} >Rp. 5.000.000 - Rp. 8.000.000</option>
                                        <option value="4" {{($get_profile_ibu->penghasilan == '4') ? 'selected' : ''}} >Rp. 8.000.000 - Rp. 10.000.000</option>
                                        <option value="5" {{($get_profile_ibu->penghasilan == '5') ? 'selected' : ''}} >Rp. 10.000.000 - Rp. 15.000.000</option>
                                        <option value="6" {{($get_profile_ibu->penghasilan == '6') ? 'selected' : ''}} >> Rp. 15.000.000</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="pendidikan_ibu" class="form-label">Pendidikan Terakhir Ibu</span>
                                    <select id="pendidikan_ibu" name="pendidikan_ibu" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                        <option value="SMP" {{($get_profile_ibu->pendidikan_ibu == 'SMP') ? 'selected' : ''}} >SMP</option>
                                        <option value="SMA" {{($get_profile_ibu->pendidikan_ibu == 'SMA') ? 'selected' : ''}} >SMA</option>
                                        <option value="Diploma" {{($get_profile_ibu->pendidikan_ibu == 'Diploma') ? 'selected' : ''}} >Diploma</option>
                                        <option value="S1" {{($get_profile_ibu->pendidikan_ibu == 'S1') ? 'selected' : ''}} >S1 / D4</option>
                                        <option value="S2" {{($get_profile_ibu->pendidikan_ibu == 'S2') ? 'selected' : ''}} >S2</option>
                                        <option value="S3" {{($get_profile_ibu->pendidikan_ibu == 'S3') ? 'selected' : ''}} >S3</option>
                                    </select>
                                </div>

                                <a style="float: right" id="next-ayah" class="btn btn-primary btn-sm px-3">Next</a>

                            </div>

                            <div class="tab-pane fade" id="nav-data-ayah" role="tabpanel" aria-labelledby="nav-data-ayah-tab" tabindex="0">
                                <div class="my-3">
                                    <span for="nama_ayah" class="form-label">Nama Lengkap ayah</span>
                                    <input type="text" name="nama_ayah" class="form-control form-control-sm px-3" id="nama_ayah" value="{{$get_profile_ayah != null ? $get_profile_ayah->nama : ''}}" readonly>
                                </div>

                                <div class="mb-3">
                                    <span for="email_ayah" class="form-label">Email Ayah</span>
                                    <input type="email" name="email_ayah" class="form-control form-control-sm px-3" id="email_ayah" value="{{$get_profile->email_ayah}}" placeholder="Email Ayah" >
                                </div>
            
                                <div class="row mb-3">
                                    <div class=" col-md-6">
                                        <span for="tempat_lahir_ayah" class="form-label">Tempat Lahir</span>
                                        <input class="form-control form-control-sm px-3" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="{{$get_profile_ayah->tptlahir_ayah}}" placeholder="Tempat Lahir"  >
                                    </div>
                                    <div class=" col-md-6">
                                        <span for="tgl_lahir_ayah" class="form-label">Tanggal Lahir</span>
                                        <input type="date" class="form-control form-control-sm px-3" id="tgl_lahir_ayah" name="tgl_lahir_ayah" value="{{$get_profile_ayah->tgllahir_ayah}}" placeholder="Tanggal Lahir"  >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span for="pekerjaan_ayah" class="form-label">Pekerjaan ayah</span>
                                    <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                        <option value="PNS" {{($get_profile_ayah->pekerjaan_jabatan == 'PNS') ? 'selected' : ''}} >PNS</option>
                                        <option value="Karyawan BUMN/BUMD" {{($get_profile_ayah->pekerjaan_jabatan == 'Karyawan BUMN/BUMD') ? 'selected' : ''}}>Karyawan BUMN/BUMD</option>
                                        <option value="Karyawan Swasta" {{($get_profile_ayah->pekerjaan_jabatan == 'Karyawan Swasta') ? 'selected' : ''}} >Karyawan Swasta</option>
                                        <option value="Karyawan Rabbani" {{($get_profile_ayah->pekerjaan_jabatan == 'Karyawan Rabbani') ? 'selected' : ''}} >Karyawan Rabbani</option>
                                        <option value="Guru/Dosen" {{($get_profile_ayah->pekerjaan_jabatan == 'Guru/Dosen') ? 'selected' : ''}} >Guru/Dosen</option>
                                        <option value="TNI/POLRI" {{($get_profile_ayah->pekerjaan_jabatan == 'TNI/POLRI') ? 'selected' : ''}} >TNI/POLRI</option>
                                        <option value="Wiraswasta" {{($get_profile_ayah->pekerjaan_jabatan == 'Wiraswasta') ? 'selected' : ''}} >Wiraswasta</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="penghasilan_ayah" class="form-label">Penghasilan ayah</span>
                                    <select id="penghasilan_ayah" name="penghasilan_ayah" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Penghasilan --</option>
                                        <option value="1" {{($get_profile_ayah->penghasilan == '1') ? 'selected' : ''}} >< Rp. 3.000.000</option>
                                        <option value="2" {{($get_profile_ayah->penghasilan == '2') ? 'selected' : ''}} >Rp. 3.000.000 - Rp. 5.000.000</option>
                                        <option value="3" {{($get_profile_ayah->penghasilan == '3') ? 'selected' : ''}} >Rp. 5.000.000 - Rp. 8.000.000</option>
                                        <option value="4" {{($get_profile_ayah->penghasilan == '4') ? 'selected' : ''}} >Rp. 8.000.000 - Rp. 10.000.000</option>
                                        <option value="5" {{($get_profile_ayah->penghasilan == '5') ? 'selected' : ''}} >Rp. 10.000.000 - Rp. 15.000.000</option>
                                        <option value="6" {{($get_profile_ayah->penghasilan == '6') ? 'selected' : ''}} >> Rp. 15.000.000</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="pendidikan_ayah" class="form-label">Pendidikan Terakhir ayah</span>
                                    <select id="pendidikan_ayah" name="pendidikan_ayah" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                        <option value="SMP" {{($get_profile_ayah->pendidikan_ayah == 'SMP') ? 'selected' : ''}} >SMP</option>
                                        <option value="SMA" {{($get_profile_ayah->pendidikan_ayah == 'SMA') ? 'selected' : ''}} >SMA</option>
                                        <option value="Diploma" {{($get_profile_ayah->pendidikan_ayah == 'Diploma') ? 'selected' : ''}} >Diploma</option>
                                        <option value="S1" {{($get_profile_ayah->pendidikan_ayah == 'S1') ? 'selected' : ''}} >S1 / D4</option>
                                        <option value="S2" {{($get_profile_ayah->pendidikan_ayah == 'S2') ? 'selected' : ''}} >S2</option>
                                        <option value="S3" {{($get_profile_ayah->pendidikan_ayah == 'S3') ? 'selected' : ''}} >S3</option>
                                    </select>
                                </div>

                                <a style="float: right" id="next-wali" class="btn btn-primary btn-sm px-3">Next</a>

                            </div>

                            <div class="tab-pane fade" id="nav-data-wali" role="tabpanel" aria-labelledby="nav-data-wali-tab" tabindex="0">
                                <div class="my-3">
                                    <span for="nama_wali" class="form-label">Nama Lengkap Wali</span>
                                    <input type="text" name="nama_wali" class="form-control form-control-sm px-3" id="nama_wali" value="{{$get_profile_wali != null ? $get_profile_wali->nama : ''}}" placeholder="Nama wali">
                                </div>
            
                                <div class="row mb-3">
                                    <div class=" col-md-6">
                                        <span for="tempat_lahir_wali" class="form-label">Tempat Lahir</span>
                                        <input class="form-control form-control-sm px-3" id="tempat_lahir_wali" name="tempat_lahir_wali" value="{{$get_profile_wali !=null ? $get_profile_wali->tptlahir_wali : ''}}" placeholder="Tempat Lahir"  >
                                    </div>
                                    <div class=" col-md-6">
                                        <span for="tgl_lahir_wali" class="form-label">Tanggal Lahir</span>
                                        <input type="date" class="form-control form-control-sm px-3" id="tgl_lahir_wali" name="tgl_lahir_wali" value="{{$get_profile_wali !=null ? $get_profile_wali->tgllahir_wali : ''}}" placeholder="Tanggal Lahir"  >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span for="pekerjaan_wali" class="form-label">Pekerjaan wali</span>
                                    <select id="pekerjaan_wali" name="pekerjaan_wali" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                        <option value="PNS" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'PNS') ? 'selected' : ''}} >PNS</option>
                                        <option value="Karyawan BUMN/BUMD" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'Karyawan BUMN/BUMD') ? 'selected' : ''}}>Karyawan BUMN/BUMD</option>
                                        <option value="Karyawan Swasta" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'Karyawan Swasta') ? 'selected' : ''}} >Karyawan Swasta</option>
                                        <option value="Karyawan Rabbani" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'Karyawan Rabbani') ? 'selected' : ''}} >Karyawan Rabbani</option>
                                        <option value="Guru/Dosen" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'Guru/Dosen') ? 'selected' : ''}} >Guru/Dosen</option>
                                        <option value="TNI/POLRI" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'TNI/POLRI') ? 'selected' : ''}} >TNI/POLRI</option>
                                        <option value="Wiraswasta" {{($get_profile_wali !=null ? $get_profile_wali->pekerjaan_jabatan : '' == 'Wiraswasta') ? 'selected' : ''}} >Wiraswasta</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="pendidikan_wali" class="form-label">Pendidikan Terakhir wali</span>
                                    <select id="pendidikan_wali" name="pendidikan_wali" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                        <option value="SMP" {{($get_profile_wali !=null ? $get_profile_wali->pendidikan_wali : '' == 'SMP') ? 'selected' : ''}} >SMP</option>
                                        <option value="SMA" {{($get_profile_wali !=null ? $get_profile_wali->pendidikan_wali : '' == 'SMA') ? 'selected' : ''}} >SMA</option>
                                        <option value="Diploma" {{($get_profile_wali !=null ? $get_profile_wali->pendidikan_wali : '' == 'Diploma') ? 'selected' : ''}} >Diploma</option>
                                        <option value="S1" {{($get_profile_wali !=null ? $get_profile_wali->pendidikan_wali : '' == 'S1') ? 'selected' : ''}} >S1 / D4</option>
                                        <option value="S2" {{($get_profile_wali !=null ? $get_profile_wali->pendidikan_wali : '' == 'S2') ? 'selected' : ''}} >S2</option>
                                        <option value="S3" {{($get_profile_wali !=null ? $get_profile_wali->pendidikan_wali : '' == 'S3') ? 'selected' : ''}} >S3</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span for="hubungan_wali" class="form-label">Hubungan Wali dan Peserta Didik</span>
                                    <select id="hubungan_wali" name="hubungan_wali" class="select form-control form-control-sm px-3">
                                        <option value="" disabled selected>-- Pilih Hubungan Wali --</option>
                                        <option value="kakek/nenek" >Kakek / Nenek</option>
                                        <option value="paman/bibi" >Paman / Bibi</option>
                                        <option value="kakak" >Kakak</option>
                                        <option value="lainnya" >Lainnya</option>
                                    </select>
                                </div>

                                <div class="d-flex" style="justify-content: flex-end">
                                    <button type="submit" class="btn btn-primary btn-sm ml-auto px-3" id="btn-submit"> Submit </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @else 
                    <div> 
                        <h3 class="center"> Data Tidak Ditemukan </h3>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script>
         $(document).ready(function() {
            $("#btn-submit").click(function() {
                // disable button
                $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                );
                $("#update_data_pendaftaran").submit();
            });
        });

        $(document).ready(function() {
            $('#kec_asal_sekolah').select2();
        });
      
         $("#next-ibu").click(function() {
            $('#nav-tab button:eq(1) ').tab('show');
        });

        $("#next-ayah").click(function() {
            $('#nav-tab button:eq(2) ').tab('show');
        });

        $('#next-wali').click(function(){
            $('#nav-tab button:eq(3) ').tab('show');
           
        })
    

        // var id_prov = document.getElementById("provinsi").value
        // console.log(id_prov);
        // $.ajax({
        //     url: "{{route('get_kota')}}",
        //     type: 'POST',
        //     data: {
        //         id_provinsi: id_prov,
        //             _token: '{{csrf_token()}}'
        //     },
        //     success: function (result) {
        //         $.each(result.kota, function (key, item) {
        //             console.log('ini', item.id, get_profile.kota);

        //             if (item.id == get_profile.kota) {
        //                 $("#kota").append('<option value="' + item
        //                     .id + '" selected >' + item.kabupaten_kota + '</option>');
        //             } else {
        //                 $("#kota").append('<option value="' + item
        //                     .id + '" >' + item.kabupaten_kota + '</option>');
        //             }
        //         });
        //     }
        // });

        // var id_city = document.getElementById("kota").value
        // console.log('ci', id_city, get_profile.kecamatan);
        // var id_kota = document.getElementById("kota").value


        // $.ajax({
        //         url: "{{route('get_kecamatan')}}",
        //         type: 'POST',
        //         data: {
        //             id_kota: id_city,
        //              _token: '{{csrf_token()}}'
        //         },
        //         success: function (result) {
        //             console.log('itu', result);
        //             $.each(result.kecamatan, function (key, item) {
        //                 console.log('ini', item.id, get_profile.kecamatan);
        //                 if (item.id == get_profile.kecamatan) {
        //                 $("#kecamatan").append('<option value="' + item
        //                     .id + '" selected >' + item.kecamatan + '</option>');
        //             } else {
        //                 $("#kecamatan").append('<option value="' + item
        //                     .id + '" >' + item.kecamatan + '</option>');
        //             }
        //             });
        //         }
        // });
        

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
                    //    console.log('ini', item.id , get_profile.kota);
                        $("#kota").append('<option value="' + item
                            .id + '" >' + item.kabupaten_kota + '</option>');
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
                        <input type="text" name="no_hp" class="form-control form-control-sm px-3" placeholder="08xx"  >
                    </div>
                    <div class="form-group mt-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control form-control-sm px-3" placeholder="Masukkan Nama Anak Anda"  >
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

