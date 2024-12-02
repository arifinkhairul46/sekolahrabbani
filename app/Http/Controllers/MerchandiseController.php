<?php

namespace App\Http\Controllers;

use App\Models\DesainPalestineday;
use App\Models\JenisMerchandise;
use App\Models\LokasiSub;
use App\Models\Merchandise;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchandise = Merchandise::get_jenis();
        // dd($merchandise);
        $jenis_merchandise = JenisMerchandise::all();
        return view('admin.master.merchandise', compact('merchandise', 'jenis_merchandise'));
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
        try {
            $nama_merchandise = $request->nama_merchandise;
            $deskripsi = $request->deskripsi;
            $jenis = $request->jenis;
            $harga = $request->harga;
            $diskon = $request->diskon;
            $image_2 = $request->image_2;

            $image_1 = null;
            $image_url_1 = null;
            $path = 'palestineday/merchandise';
            if ($request->has('image_1')) {
                $image_1 = $request->file('image_1')->store($path);
                $image_name_1 = $request->file('image_1')->getClientOriginalName();
                $image_url_1 = $path . '/' . $image_name_1;
                Storage::disk('public')->put($image_url_1, file_get_contents($request->file('image_1')->getRealPath()));
            } else {
                return redirect()->back()->with('error', 'Image tidak boleh kosong');
            }

            $image_url_2 = null;
            $path = 'palestineday/merchandise';
            if ($request->has('image_2')) {
                $image_name_2 = $request->file('image_2')->getClientOriginalName();
                $image_url_2 = $path . '/' . $image_name_2;
                Storage::disk('public')->put($image_url_2, file_get_contents($request->file('image_2')->getRealPath()));
            }

            $add_menu = Merchandise::create([
                'nama_produk' => $nama_merchandise,
                'jenis_id' => $jenis,
                'deskripsi' => $deskripsi,
                'harga_awal' => $harga,
                'diskon' => $diskon,
                'image_1' => $image_url_1,
                'image_2' => $image_url_2,
            ]);

            return redirect()->back()->with('success', 'Berhasil tambah menu');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function show(Merchandise $merchandise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchandise $merchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchandise $merchandise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchandise $merchandise)
    {
        //
    }

    public function kumpul_desain()
    {
        $sekolah = LokasiSub::select('id as id_lokasi', 'sublokasi')->where('id_lokasi', '!=', 'YYS')->get();

        $list_desain = DesainPalestineday::select('t_desain_palestineday.*', 'mls.sublokasi as lokasi')
                        ->leftJoin('mst_lokasi_sub as mls', 't_desain_palestineday.sekolah_id', 'mls.id')
                        ->get();
                        

        return view('admin.master.kumpul-desain', compact('sekolah', 'list_desain'));
    }

    public function get_kelas(Request $request) {
        $sekolah_id = $request->id_sekolah;

        $data['kelas'] = Profile::select('nama_kelas')->where('sekolah_id', $sekolah_id)->groupby('nama_kelas')->get();

        return response()->json($data);
    }

    public function get_siswa(Request $request) {
        $sekolah_id = $request->id_sekolah;
        $id_kelas = $request->id_kelas;

        $data['siswa'] = Profile::select('nama_lengkap', 'nis')
                                ->where('sekolah_id', $sekolah_id)
                                ->where('nama_kelas', $id_kelas)
                                ->get();

        return response()->json($data);
    }

    public function store_desain(Request $request)
    {
        try {

            $user = Auth::user();
            $update_by = $user->name;
            $sekolah = $request->sekolah;
            $kelas = $request->kelas;
            $nis = $request->nama_siswa;

            $get_siswa = Profile::where('nis', $nis)->first();
            $nama_siswa = $get_siswa->nama_lengkap;

            $image = null;
            $image_url = null;
            $path = 'palestineday/desain';
            if ($request->has('image_file')) {
                $image = $request->file('image_file')->store($path);
                $image_name = $request->file('image_file')->getClientOriginalName();
                $image_url = $path . '/' . $image_name;
                Storage::disk('public')->put($image_url, file_get_contents($request->file('image_file')->getRealPath()));
            } else {
                return redirect()->back()->with('error', 'Image tidak boleh kosong');
            }

            $add_desain = DesainPalestineday::create([
                'nis' => $nis,
                'nama_siswa' => $nama_siswa,
                'sekolah_id' => $sekolah,
                'nama_kelas' => $kelas,
                'updated_by' => $update_by,
                'image_file' => $image_url
            ]);

            return redirect()->back()->with('success', 'Desaid created successfully.');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function desain_by_id(Request $request, $id)
    {
        $desain_by_id = DesainPalestineday::where('id', $id)->first();

        return response($desain_by_id);
    }

    public function create_jenis(Request $request)
    {
        $add_jenis = JenisMerchandise::create([
            'jenis' => $request->nama_jenis
        ]);

        return redirect()->back();
    }
}
