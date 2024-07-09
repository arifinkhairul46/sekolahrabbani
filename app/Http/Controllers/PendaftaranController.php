<?php

namespace App\Http\Controllers;

use App\Models\JenjangSekolah;
use App\Models\KelasJenjangSekolah;
use App\Models\Lokasi;
use App\Models\Pendaftaran;
use App\Models\PendaftaranAyah;
use App\Models\PendaftaranIbu;
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
        return view('pendaftaran.index');
    }

    public function form_pendaftaran()
    {
        $lokasi = Lokasi::where('kode_sekolah', '!=', 'UBR')->where('status', 1)->get();
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
        }
        $lokasi = $request->lokasi;
        $nama_lengkap = $request->nama;
        $kelas = $request->kelas;
        $jenis_kelamin = $request->jenis_kelamin;
        $tempat_lahir = $request->tempat_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $asal_sekolah = $request->asal_sekolah;
        $nama_ayah = $request->nama_ayah;
        $nama_ibu = $request->nama_ibu;
        $no_hp_ayah = $request->no_hp_ayah;
        $no_hp_ibu = $request->no_hp_ibu;
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
            'sd_sebelumnya' => $asal_sekolah
        ]);

        PendaftaranAyah::create([
            'id_ayah' => $id_anak,
            'nama' => $nama_ayah,

        ]);

        PendaftaranIbu::create([
            'id_ibu' => $id_anak,
            'nama' => $nama_ibu,

        ]);

        $this->send_pendaftaran($id_anak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tgl_lahir, $lokasi, $kelas, $jenjang, $tingkat, $asal_sekolah, $no_hp_ayah, $no_hp_ibu, $nama_ayah, $nama_ibu);

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
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
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

}
