<?php

namespace App\Http\Controllers;

use App\Models\ModulDiklat;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModulDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulDiklat = ModulDiklat::all();

        return view('karir.admin.modul.index', compact('modulDiklat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karir.admin.modul.create');
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
            'judul_modul' => 'required',
        ]);

        ModulDiklat::create($request->all());

        return redirect()->route('karir.admin.modul')
            ->with('success', 'Modul Diklat created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModulDiklat  $modulDiklat
     * @return \Illuminate\Http\Response
     */
    public function show(ModulDiklat $modulDiklat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModulDiklat  $modulDiklat
     * @return \Illuminate\Http\Response
     */
    public function edit(ModulDiklat $modulDiklat, $id)
    {
        $modulDiklat = ModulDiklat::find($id);
        return view('karir.admin.modul.edit', compact('modulDiklat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModulDiklat  $modulDiklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModulDiklat $modulDiklat, $id)
    {
        $request->validate([
            'judul_modul' => 'required',
        ]);

        ModulDiklat::find($id)->update($request->all());

        return redirect()->route('karir.admin.modul')
            ->with('success', 'Modul Diklat updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModulDiklat  $modulDiklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModulDiklat $modulDiklat, $id)
    {
        ModulDiklat::find($id)->delete();

        return redirect()->route('karir.admin.modul')
            ->with('success', 'Modul Diklat deleted successfully');
    }
}
