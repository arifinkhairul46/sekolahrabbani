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
        // dd($jenjang_per_sekolah);
        return view('pendaftaran.tk-sd.formulir', compact('lokasi', 'jenjang_per_sekolah'));
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
            'lokasi' => 'required'
        ]);

        $jenjang = $request->jenjang;
        if ($request->jenjang == '1') {
            $tingkat = 'KB';
        } else if ($request->jenjang == '2') {
            $tingkat = 'TK';
        } else if ($request->jenjang == '3') {
            $tingkat = 'SD';
        } else {
            $tingkat = 'SMP';
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
            'jenis_pendidikan' => $jenis_pendidikan
        ]);

        PendaftaranAyah::create([
            'id_ayah' => $id_anak,
            'nama' => $nama_ayah,

        ]);

        PendaftaranIbu::create([
            'id_ibu' => $id_anak,
            'nama' => $nama_ibu,
        ]);

        // $this->send_pendaftaran($id_anak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tgl_lahir, $lokasi, $kelas, $jenjang, $tingkat, $asal_sekolah, $no_hp_ayah, $no_hp_ibu, $nama_ayah, $nama_ibu);

        return redirect()->route('form.pendaftaran')
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


        return view('pendaftaran.tk-sd.pemenuhan-data', compact('provinsi', 'kecamatan', 'kecamatan_asal_sekolah', 'kelurahan', 'kota', 'get_profile',  'get_profile_ibu',  'get_profile_ayah', 'get_profile_wali'));
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
    
            $update_data_anak = Pendaftaran::where('id_anak', $id)->update([
                'no_nik' => $request->nik,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'agama' => $request->agama,
                'anak_ke' => $request->anak_ke,
                'jml_sdr' => $request->jumlah_saudara,
                'asal_sekolah' => $request->asal_sekolah,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'gol_darah' => $request->gol_darah,
                'riwayat_penyakit' => $request->riwayat_penyakit,
                'hafalan' => $request->hafalan,
                'kec_asal_sekolah' => $request->kec_asal_sekolah,
                    
            ]);

          

            $update_data_ibu = PendaftaranIbu::where('id_ibu', $id)->update([
                'tptlahir_ibu' => $request->tempat_lahir_ibu,
                'tgllahir_ibu' => $request->tgl_lahir_ibu,
                'pekerjaan_jabatan' => $request->pekerjaan_ibu,
                'penghasilan' => $request->penghasilan_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
            ]);

            $update_data_ayah = PendaftaranAyah::where('id_ayah', $id)->update([
                'tptlahir_ayah' => $request->tempat_lahir_ayah,
                'tgllahir_ayah' => $request->tgl_lahir_ayah,
                'pekerjaan_jabatan' => $request->pekerjaan_ayah,
                'penghasilan' => $request->penghasilan_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
            ]);

            $update_data_wali = PendaftaranWali::where('id_wali', $id)->update([
                'nama' => $request->nama_wali,
                'tptlahir_wali' => $request->tempat_lahir_wali,
                'tgllahir_wali' => $request->tgl_lahir_wali,
                'pekerjaan_jabatan' => $request->pekerjaan_wali,
                'penghasilan' => $request->penghasilan_wali,
                'pendidikan_wali' => $request->pendidikan_wali,
            ]);
    
            return redirect()->back()->with('success', 'Data berhasil diupdate');
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
                            ->where('nama_lengkap', $request->nama_lengkap)
                            ->first();

            if ($get_no_regis) {
                $message = "No Registrasi / Pendaftaran an. $get_no_regis->nama_lengkap adalah " . $get_no_regis->id_anak . "";
                $no_wha = $request->no_hp;

                $this->send_notif($message, $no_wha);
                return redirect()->route('form.update')->with('success', 'No Registrasi telah dikirim ke nomor whatsapp anda');

            } else {
                return redirect()->route('form.update')->with('error', 'Nomor whatsapp tidak terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->route('form.update')->with('error', 'Terjadi kesalahan');
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


    function send_pendaftaran($id_anak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tgl_lahir, $lokasi, $kelas, $jenjang, $tingkat, $asal_sekolah, $no_hp_ayah, $no_hp_ibu, $nama_ayah, $nama_ibu){
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
		  	'nama_lengkap' => $nama_lengkap,
		  	'jenis_kelamin' => $jenis_kelamin,
		  	'tempat_lahir' => $tempat_lahir,
		  	'tgl_lahir' => $tgl_lahir,
		  	'lokasi' => $lokasi,
		  	'kelas' => $kelas,
            'jenjang' => $jenjang,
			'tingkat' => $tingkat,
			'asal_sekolah' => $asal_sekolah,
			'no_hp_ayah' => $no_hp_ayah,
			'nama_ayah' => $nama_ayah,
			'nama_ibu' => $nama_ibu,
			'no_hp_ibu' => $no_hp_ibu)

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
