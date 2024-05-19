<?php

namespace App\Http\Controllers;

use App\Models\KelasDiklat;
use Illuminate\Http\Request;

class KelasDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelasDiklat = KelasDiklat::all();

        return view('karir.kelas-diklat.index', compact('kelasDiklat'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KelasDiklat  $kelasDiklat
     * @return \Illuminate\Http\Response
     */
    public function show(KelasDiklat $kelasDiklat)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelasDiklat  $kelasDiklat
     * @return \Illuminate\Http\Response
     */
    public function edit(KelasDiklat $kelasDiklat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KelasDiklat  $kelasDiklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelasDiklat $kelasDiklat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelasDiklat  $kelasDiklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelasDiklat $kelasDiklat)
    {
        //
    }

    public function get_kelas_by_pertemuan_id($pertemuan)
    {
        $kelasDiklat = KelasDiklat::all();
        $kelas_pertemuan = KelasDiklat::get_kelas_per_pertemuan($pertemuan);

        return view('karir.kelas-diklat.by-pertemuan', compact('kelas_pertemuan', 'kelasDiklat'));
    }

    public function admin_kelas()
    {
        $kelasDiklat = KelasDiklat::all();

        return view('karir.admin.kelas.index', compact('kelasDiklat'));
    }

    public function admin_create_kelas()
    {
        return view('karir.admin.kelas.create');
    }

    public function admin_store_kelas(Request $request)
    {
        $request->validate([
            
            'pertemuan' => 'required',
            'forum_link' => 'required',
        ]);

        KelasDiklat::create($request->all());

        return redirect()->route('karir.admin.kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function admin_edit_kelas($id)
    {
        $kelasDiklat = KelasDiklat::find($id);

        return view('karir.admin.kelas.edit', compact('kelasDiklat'));
    }

    public function admin_update_kelas(Request $request, $id)
    {
        $request->validate([
            
            'pertemuan' => 'required',
            'forum_link' => 'required',
        ]);

        KelasDiklat::find($id)->update($request->all());

        return redirect()->route('karir.admin.kelas')->with('success', 'Kelas berhasil diupdate');
    }

    public function admin_delete_kelas($id)
    {
        KelasDiklat::where('id', $id)->delete();

        return redirect()->route('karir.admin.kelas')->with('success', 'Kelas berhasil dihapus');
    }
}
