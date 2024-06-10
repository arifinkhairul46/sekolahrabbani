<?php

namespace App\Http\Controllers;

use App\Models\JenjangSekolah;
use App\Models\KelasJenjangSekolah;
use App\Models\Lokasi;
use App\Models\Pendaftaran;
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
        $lokasi = Lokasi::where('kode_sekolah', '!=', 'UBR')->get();
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
            $jenjang = 'KB';
        } else if ($request->jenjang == '2') {
            $jenjang = 'TK';
        } else if ($request->jenjang == '1') {
            $jenjang = 'SD';
        }
        $lokasi = $request->lokasi;
        $now = date('YmdHis');
        $id_anak = "PPDB-$jenjang-$lokasi-$now";

        Pendaftaran::create([
            'id_anak' => $id_anak,
            'nama_lengkap' => $request->nama,
            'lokasi' => $lokasi,
            'tingkat' => $jenjang,
            'kelas' => $request->kelas,
            'no_hp_ayah' => $request->no_hp_ayah,
            'no_hp_ibu' => $request->no_hp_ibu,
        ]);

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
}
