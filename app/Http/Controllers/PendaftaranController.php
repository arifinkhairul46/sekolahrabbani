<?php

namespace App\Http\Controllers;

use App\Models\ContactPerson;
use App\Models\JenjangSekolah;
use App\Models\Kecamatan;
use App\Models\KelasJenjangSekolah;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\Lokasi;
use App\Models\LokasiSub;
use App\Models\Pendaftaran;
use App\Models\PendaftaranAyah;
use App\Models\PendaftaranIbu;
use App\Models\PendaftaranWali;
use App\Models\Provinsi;
use App\Models\TahunAjaranAktif;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_person = ContactPerson::where('is_aktif', 1)->get();

        return view('pendaftaran.index', compact('contact_person'));
    }

    public function form_pendaftaran()
    {
        $lokasi = Lokasi::where('status', 1)->get();
        $jenjang_per_sekolah = JenjangSekolah::all();
        $tahun_ajaran = TahunAjaranAktif::where('status', 1)->where('status_tampil', 1)->orderBy('id', 'asc')->get();

        // dd($tahun_ajaran);
        return view('pendaftaran.tk-sd.formulir', compact('lokasi', 'jenjang_per_sekolah', 'tahun_ajaran'));
    }

    public function get_jenjang(Request $request) {

        $data['jenjang'] = JenjangSekolah::get_jenjang($request->id_lokasi);

        return response()->json($data);
    }

    public function get_kelas(Request $request) {

        $data['kelas'] = KelasJenjangSekolah::get_kelas_jenjang($request->id_lokasi, $request->id_jenjang);

        return response()->json($data);
    }

    public function get_kelas_smp(Request $request) {

        $data['kelas_smp'] = KelasJenjangSekolah::get_kelas_smp($request->id_lokasi);

        return response()->json($data);
    }

    public function get_kota(Request $request) {

        $data['kota'] = Kota::where('provinsi_id', $request->id_provinsi)->get();

        return response()->json($data);
    }

    public function get_kecamatan(Request $request) {

        $data['kecamatan'] = Kecamatan::where('kabkot_id', $request->id_kota)->get();

        return response()->json($data);
    }

    public function get_kelurahan(Request $request) {

        $data['kelurahan'] = Kelurahan::where('kecamatan_id', $request->id_kecamatan)->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'no_hp_ayah' => 'required|alpha_num',
            'no_hp_ibu' => 'required'
        ], [
            'nama.required' => 'Name is required',
            'no_hp_ayah.required' => 'No Whatsapp Ayah is required',
            'no_hp_ibu.required' => 'No Whatsapp Ibu is required',
            'no_hp_ayah.alpha_num' => 'No Whatsapp Hanya Nomor saja, tanpa special character seperti + , -',
            'no_hp_ibu.alpha_num' => 'No Whatsapp Hanya Nomor saja, tanpa special character seperti + , -'
        ]);

        $jenjang = $request->jenjang;
        if ($request->lokasi == 'UBR') {
            $tingkat = 'SMP';
            $jenjang = 5;
        }

        if ($request->jenjang == '1' || $request->jenjang == '3') {
            $tingkat = $request->kelas;
        }else if ($request->jenjang == '4') {
            $tingkat = 'SD';
        }

        
        if ($request->radios == 'lainnya') {
            $sumber_ppdb = $request->radios2;
        } else {
            $sumber_ppdb = $request->radios;
        }

        $lokasi = $request->lokasi;
        $nama_lengkap = $request->nama;
        $kelas = $request->kelas;
        $jenis_kelamin = $request->jenis_kelamin;
        $tempat_lahir = $request->tempat_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $nama_ayah = $request->nama_ayah;
        $nama_ibu = $request->nama_ibu;
        $no_hp_ayah = $request->no_hp_ayah;
        $no_hp_ibu = $request->no_hp_ibu;
        $jenis_pendidikan = $request->jenis_pendidikan;
        $tahun_ajaran = $request->tahun_ajaran;
        $now = date('YmdHis');
        $id_anak = "PPDB-$tingkat-$lokasi-$now";

        Pendaftaran::create([
            'id_anak' => $id_anak,
            'nama_lengkap' => $nama_lengkap,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir' => $tgl_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'lokasi' => $lokasi,
            'jenjang' => $jenjang,
            'tingkat' => $tingkat,
            'kelas' => $kelas,
            'no_hp_ayah' => $no_hp_ayah,
            'no_hp_ibu' => $no_hp_ibu,
            'info_ppdb' => $sumber_ppdb,
            'jenis_pendidikan' => $jenis_pendidikan,
            'tahun_ajaran' => $tahun_ajaran
        ]);

        PendaftaranAyah::create([
            'id_ayah' => $id_anak,
            'nama' => $nama_ayah,
        ]);

        PendaftaranIbu::create([
            'id_ibu' => $id_anak,
            'nama' => $nama_ibu,
        ]);

        PendaftaranWali::create([
            'id_wali' => $id_anak,
        ]);

        // send ke qlp
        $this->send_pendaftaran($id_anak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tgl_lahir, $lokasi, $kelas, $jenjang, $tingkat, $no_hp_ayah, $no_hp_ibu, $nama_ayah, $nama_ibu, $sumber_ppdb, $tahun_ajaran);

        $contact_person =  ContactPerson::where('is_aktif', '1')->where('kode_sekolah', $lokasi)->where('id_jenjang', $jenjang)->first();
        $no_admin = $contact_person->telp;
        $biaya = $contact_person->biaya;
        $no_rek = $contact_person->norek;
        $nama_rek = $contact_person->nama_rek;

        //send notif ke admin
		$message_for_admin='Pendaftaran telah berhasil dengan nomor registrasi "'.$id_anak.'". a/n "'.$nama_lengkap.'" ';

        $this->send_notif($message_for_admin, $no_admin);

        //send notif ke ortu
        $message_ortu = "Terimakasih *Ayah/Bunda $nama_lengkap* telah mendaftar ke Sekolah Rabbani. 
No Registrasi / Pendaftaran adalah *$id_anak* mohon disimpan untuk selanjutnya pemenuhan data saat psikotest. 

Silahkan lakukan pembayaran pendaftaran sebesar *Rp ".number_format($biaya)."* ke rekening *".$nama_rek." ".$no_rek."* dan kirim bukti bayar ke nomor https://wa.me/".$no_admin." 

Apabila ada pertanyaan silahkan hubungi Customer Service kami di nomor ".$no_admin.", Terima Kasih.
        ";

        $this->send_notif($message_ortu, $no_hp_ayah);
        $this->send_notif($message_ortu, $no_hp_ibu);


        return redirect()->route('pendaftaran')
            ->with('success', 'Pendaftaran Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pendaftaran $pendaftaran)
    {
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kecamatan_asal_sekolah = Kecamatan::kecamatan_with_kota();
        // dd($kecamatan);
        $kelurahan = Kelurahan::all();

        // $id = $request->no_registrasi;
        $no_registrasi = $request->no_registrasi ?? null;

        if ($request->has('no_registrasi')) {
            $get_profile = Pendaftaran::get_profile($no_registrasi);
            $get_profile_ibu = PendaftaranIbu::get_profile($no_registrasi);
            $get_profile_ayah = PendaftaranAyah::get_profile($no_registrasi);
            $get_profile_wali = PendaftaranWali::get_profile($no_registrasi);
        }
        
        $get_profile = Pendaftaran::get_profile($no_registrasi);
        $get_profile_ibu = PendaftaranIbu::get_profile($no_registrasi);
        $get_profile_ayah = PendaftaranAyah::get_profile($no_registrasi);
        $get_profile_wali = PendaftaranWali::get_profile($no_registrasi);
        // dd($get_profile);


        return view('pendaftaran.tk-sd.pemenuhan-data', compact('provinsi', 'kecamatan', 'kecamatan_asal_sekolah', 'kelurahan', 'kota', 'get_profile',  'get_profile_ibu',  'get_profile_ayah', 'get_profile_wali', 'no_registrasi'));
    }

    public function find(Request $request, Pendaftaran $pendaftaran)
    {
        // $id = $request->no_registrasi;
        $no_registrasi = $request->no_registrasi ?? null;

        if ($request->has('no_registrasi')) {
            $get_profile = Pendaftaran::get_profile($no_registrasi);
            $get_profile_ibu = PendaftaranIbu::get_profile($no_registrasi);
            $get_profile_ayah = PendaftaranAyah::get_profile($no_registrasi);
            $get_profile_wali = PendaftaranWali::get_profile($no_registrasi);
        }
        
        $get_profile = Pendaftaran::get_profile($no_registrasi);
        $get_profile_ibu = PendaftaranIbu::get_profile($no_registrasi);
        $get_profile_ayah = PendaftaranAyah::get_profile($no_registrasi);
        $get_profile_wali = PendaftaranWali::get_profile($no_registrasi);
        // dd($get_profile);


        return view('pendaftaran.tk-sd.find-noregis', compact('get_profile',  'get_profile_ibu',  'get_profile_ayah', 'get_profile_wali'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $nik = $request->nik;
            $alamat = $request->alamat;
            $provinsi = $request->provinsi;
            $kota = $request->kota;
            $kecamatan = $request->kecamatan;
            $kelurahan = $request->kelurahan;
            $agama = $request->agama;
            $anak_ke = $request->anak_ke;
            $jumlah_saudara = $request->jumlah_saudara;
            $asal_sekolah = $request->asal_sekolah;
            $tinggi_badan = $request->tinggi_badan;
            $berat_badan = $request->berat_badan;
            $gol_darah = $request->gol_darah;
            $riwayat_penyakit = $request->riwayat_penyakit;
            $kec_asal_sekolah = $request->kec_asal_sekolah;
            $email_ibu = $request->email_ibu;
            $email_ayah = $request->email_ayah;
            $npsn = $request->npsn;
            $status_tinggal = $request->status_tinggal;
            $hafalan = $request->hafalan;
            $tempat_lahir_ibu = $request->tempat_lahir_ibu;
            $tgl_lahir_ibu = $request->tgl_lahir_ibu;
            $pekerjaan_ibu = $request->pekerjaan_ibu;
            $penghasilan_ibu = $request->penghasilan_ibu;
            $pendidikan_ibu = $request->pendidikan_ibu;
            $tempat_lahir_ayah = $request->tempat_lahir_ayah;
            $tgl_lahir_ayah = $request->tgl_lahir_ayah;
            $pekerjaan_ayah = $request->pekerjaan_ayah;
            $penghasilan_ayah = $request->penghasilan_ayah;
            $pendidikan_ayah = $request->pendidikan_ayah;
            $tempat_lahir_wali = $request->tempat_lahir_wali;
            $tgl_lahir_wali = $request->tgl_lahir_wali;
            $pekerjaan_wali = $request->pekerjaan_wali;
            $pendidikan_wali = $request->pendidikan_wali;
            $nama_wali = $request->nama_wali;
            $hubungan_wali = $request->hubungan_wali;
            $nama_panggilan = $request->nama_panggilan;
            $bhs_digunakan = $request->bhs_digunakan;
            
    
            $update_data_anak = Pendaftaran::where('id_anak', $id)->update([
                'no_nik' => $nik,
                'alamat' => $alamat,
                'provinsi' => $provinsi,
                'kota' => $kota,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'agama' => $agama,
                'anak_ke' => $anak_ke,
                'jml_sdr' => $jumlah_saudara,
                'sd_sebelumnya' => $asal_sekolah,
                'tinggi_badan' => $tinggi_badan,
                'berat_badan' => $berat_badan,
                'gol_darah' => $gol_darah,
                'riwayat_penyakit' => $riwayat_penyakit,
                'hafalan' => $hafalan,
                'kec_asal_sekolah' => $kec_asal_sekolah,
                'email_ibu' => $email_ibu,
                'email_ayah' => $email_ayah,
                'npsn' => $npsn,
                'bahasa' => $bhs_digunakan,
                'nama_panggilan' => $nama_panggilan,
                'status_tinggal' => $status_tinggal
            ]);

          
            $update_data_ibu = PendaftaranIbu::where('id_ibu', $id)->update([
                'tptlahir_ibu' => $tempat_lahir_ibu,
                'tgllahir_ibu' => $tgl_lahir_ibu,
                'pekerjaan_jabatan' => $pekerjaan_ibu,
                'penghasilan' => $penghasilan_ibu,
                'pendidikan_ibu' => $pendidikan_ibu,
            ]);

            $update_data_ayah = PendaftaranAyah::where('id_ayah', $id)->update([
                'tptlahir_ayah' => $tempat_lahir_ayah,
                'tgllahir_ayah' => $tgl_lahir_ayah,
                'pekerjaan_jabatan' => $pekerjaan_ayah,
                'penghasilan' => $penghasilan_ayah,
                'pendidikan_ayah' => $pendidikan_ayah,
            ]);

            $update_data_wali = PendaftaranWali::where('id_wali', $id)->update([
                'nama' => $nama_wali,
                'tptlahir_wali' => $tempat_lahir_wali,
                'tgllahir_wali' => $tgl_lahir_wali,
                'pekerjaan_jabatan' => $pekerjaan_wali,
                'pendidikan_wali' => $pendidikan_wali,
                'hubungan_wali' => $hubungan_wali,
            ]);

            // update ke qlp
            $this->update_pendaftaran($id, $nik, $alamat, $provinsi, $kota, $kecamatan, $kelurahan, $agama, $anak_ke, $jumlah_saudara, $npsn,
            $asal_sekolah, $tinggi_badan, $berat_badan, $gol_darah, $riwayat_penyakit, $kec_asal_sekolah, $hafalan, $email_ayah, $email_ibu, $status_tinggal, 
            $tempat_lahir_ibu, $tgl_lahir_ibu, $pekerjaan_ibu, $penghasilan_ibu, $pendidikan_ibu, 
            $tempat_lahir_ayah, $tgl_lahir_ayah, $pekerjaan_ayah, $penghasilan_ayah, $pendidikan_ayah, 
            $tempat_lahir_wali, $tgl_lahir_wali, $pekerjaan_wali, $pendidikan_wali, $nama_wali, $hubungan_wali, $bhs_digunakan, $nama_panggilan);
    
            return redirect()->route('pendaftaran')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }

    public function forget_no_regis (Request $request) {
        try {
            $request->validate([
                'no_hp' => 'required'
            ]);

            $get_no_regis = Pendaftaran::where('no_hp_ibu', $request->no_hp)
                            ->orWhere('no_hp_ayah', $request->no_hp)
                            ->where('nama_lengkap', 'like', '%' .$request->nama_lengkap. '%')
                            ->first();

            if ($get_no_regis) {
                $message = "No Registrasi / Pendaftaran an. $get_no_regis->nama_lengkap adalah " . $get_no_regis->id_anak . "";
                $no_wha = $request->no_hp;

                $this->send_notif($message, $no_wha);
                return redirect()->route('form.find')->with('success', 'No Registrasi telah dikirim ke nomor whatsapp anda');

            } else {
                return redirect()->route('form.find')->with('error', 'Nomor whatsapp tidak terdaftar / Nama Lengkap Tidak Benar');
            }
        } catch (\Throwable $th) {
            return redirect()->route('form.find')->with('error', 'Terjadi kesalahan');
        }
    }

    public function get_profile_by_no_regist (Request $request) 
    {
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        $id = $request->no_registrasi;
        $get_profile = Pendaftaran::get_profile($id);
        // dd($get_profile);

        return view('pendaftaran.tk-sd.pemenuhan-data', compact('get_profile', 'provinsi', 'kecamatan', 'kelurahan', 'kota'));
    }


    function send_pendaftaran($id_anak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tgl_lahir, $lokasi, $kelas, $jenjang, $tingkat, $no_hp_ayah, $no_hp_ibu, $nama_ayah, $nama_ibu, $info_ppdb, $tahun_ajaran){
	    $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.135.214.11:81/qlp_system/api_regist/simpan_pendaftaran_baru.php',
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  // CURLOPT_SSL_VERIFYPEER => false,
		  // CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_POSTFIELDS => array(
		  	'id_anak' => $id_anak,
		  	'id_ibu' => $id_anak,
		  	'id_ayah' => $id_anak,
		  	'nama_lengkap' => $nama_lengkap,
		  	'jenis_kelamin' => $jenis_kelamin,
		  	'tempat_lahir' => $tempat_lahir,
		  	'tgl_lahir' => $tgl_lahir,
		  	'lokasi' => $lokasi,
		  	'kelas' => $kelas,
            'jenjang' => $jenjang,
			'tingkat' => $tingkat,
			'no_hp_ayah' => $no_hp_ayah,
			'nama_ayah' => $nama_ayah,
			'nama_ibu' => $nama_ibu,
			'no_hp_ibu' => $no_hp_ibu,
			'info_ppdb' => $info_ppdb,
			'tahun_ajaran' => $tahun_ajaran
            )

		));

		$response = curl_exec($curl);

		// echo $response;
		curl_close($curl);
	    // return ($response);
	}

    function update_pendaftaran($id, $nik, $alamat, $provinsi, $kota, $kecamatan, $kelurahan, $agama, $anak_ke, $jumlah_saudara, $npsn,
    $asal_sekolah, $tinggi_badan, $berat_badan, $gol_darah, $riwayat_penyakit, $kec_asal_sekolah, $hafalan, $email_ayah, $email_ibu, $status_tinggal, 
    $tempat_lahir_ibu, $tgl_lahir_ibu, $pekerjaan_ibu, $penghasilan_ibu, $pendidikan_ibu, 
    $tempat_lahir_ayah, $tgl_lahir_ayah, $pekerjaan_ayah, $penghasilan_ayah, $pendidikan_ayah, 
    $tempat_lahir_wali, $tgl_lahir_wali, $pekerjaan_wali, $pendidikan_wali, $nama_wali, $hubungan_wali, $bhs_digunakan, $nama_panggilan)
    {
	    $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.135.214.11:81/qlp_system/api_regist/update_pendaftaran_baru.php',
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  // CURLOPT_SSL_VERIFYPEER => false,
		  // CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_POSTFIELDS => array(
		  	'id_anak' => $id,
		  	'id_ibu' => $id,
		  	'id_ayah' => $id,
		    'no_nik' => $nik,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'agama' => $agama,
            'anak_ke' => $anak_ke,
            'jml_sdr' => $jumlah_saudara,
            'npsn' => $npsn,
            'asal_sekolah' => $asal_sekolah,
            'tinggi_badan' => $tinggi_badan,
            'berat_badan' => $berat_badan,
            'gol_darah' => $gol_darah,
            'riwayat_penyakit' => $riwayat_penyakit,
            'hafalan' => $hafalan,
            'kec_asal_sekolah' => $kec_asal_sekolah,
            'email_ibu' => $email_ibu,
            'email_ayah' => $email_ayah,
            'status_tinggal' => $status_tinggal,
            'tptlahir_ibu' => $tempat_lahir_ibu,
            'tgllahir_ibu' => $tgl_lahir_ibu,
            'pekerjaan_ibu' => $pekerjaan_ibu,
            'penghasilan_ibu' => $penghasilan_ibu,
            'pendidikan_ibu' => $pendidikan_ibu,
            'tptlahir_ayah' => $tempat_lahir_ayah,
            'tgllahir_ayah' => $tgl_lahir_ayah,
            'pekerjaan_ayah' => $pekerjaan_ayah,
            'penghasilan_ayah' => $penghasilan_ayah,
            'pendidikan_ayah' => $pendidikan_ayah,
            'nama_wali' => $nama_wali,
            'tptlahir_wali' => $tempat_lahir_wali,
            'tgllahir_wali' => $tgl_lahir_wali,
            'pekerjaan_wali' => $pekerjaan_wali,
            'pendidikan_wali' => $pendidikan_wali,
            'hubungan_wali' => $hubungan_wali,
            'bhs_digunakan' => $bhs_digunakan,
            'nama_panggilan' => $nama_panggilan
            
            )

		));

		$response = curl_exec($curl);

		// echo $response;
		curl_close($curl);
	    // return ($response);
	}

    function send_notif($message,$no_wha){
        $curl = curl_init();
        $token = "Q2mvYXDH5NP14owSabnbFCp4pCv6x6W7qjszwV1gNp86ZXkvv32ErAbDi9gOrwmH";
    
        $payload = [
            "data" => [
                [
                    'phone' => $no_wha,
                    'message' => $message,
                    // 'secret' => false, // or true
                    // 'priority' => false,
                    // 'retry' => false, // or true
                    // 'isGroup' => false, // or true
                ],
                
            ]
        ];
    
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
        curl_setopt($curl, CURLOPT_URL, "https://pati.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
    
        return ($result);
    }

}
