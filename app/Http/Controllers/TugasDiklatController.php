<?php

namespace App\Http\Controllers;

use App\Models\TugasDiklat;
use Illuminate\Http\Request;

class TugasDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugasDiklat = TugasDiklat::all();
        return view('karir.admin.tugas.index', compact('tugasDiklat'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karir.admin.tugas.create');
        
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
            'judul_tugas' => 'required',
        ]);

        TugasDiklat::create($request->all());

        return redirect()->route('karir.admin.tugas')
            ->with('success', 'Tugas Diklat created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TugasDiklat  $tugasDiklat
     * @return \Illuminate\Http\Response
     */
    public function show(TugasDiklat $tugasDiklat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TugasDiklat  $tugasDiklat
     * @return \Illuminate\Http\Response
     */
    public function edit(TugasDiklat $tugasDiklat, $id)
    {
        $tugasDiklat = TugasDiklat::find($id);
        return view('karir.admin.tugas.edit', compact('tugasDiklat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TugasDiklat  $tugasDiklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TugasDiklat $tugasDiklat, $id)
    {
        $request->validate([
            'judul_tugas' => 'required',
        ]);

        TugasDiklat::find($id)->update($request->all());

        return redirect()->route('karir.admin.tugas')
            ->with('success', 'Tugas Diklat updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TugasDiklat  $tugasDiklat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tugasDiklat::find($id)->delete();

        return redirect()->route('karir.admin.tugas')
            ->with('success', 'Tugas Diklat deleted successfully');
    }
}
