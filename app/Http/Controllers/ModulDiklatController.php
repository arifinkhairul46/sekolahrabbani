<?php

namespace App\Http\Controllers;

use App\Models\ModulDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'file_modul' => 'required'
        ]);

        $file = null;
        $file_url = null;
        $path = 'modul';
        if ($request->has('file_modul')) {
            $file = $request->file('file_modul')->store($path);
            $file_name = $request->file('file_modul')->getClientOriginalName();
            $file_url = $path . '/' . $file_name;
            Storage::disk('public')->put($file_url, file_get_contents($request->file('file_modul')->getRealPath()));
        } else {
            return redirect()->back()->with('failed', 'File tidak boleh kosong');
        }

        ModulDiklat::create([
            'judul_modul' => $request->judul_modul,
            'deskripsi_modul' => $request->deskripsi_modul,
            'file_modul' => $file_url
        ]);

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
            'file_modul' => 'required'
        ]);

        $file = null;
        $file_url = null;
        $path = 'modul';
        if ($request->has('file_modul')) {
            $file = $request->file('file_modul')->store($path);
            $file_name = $request->file('file_modul')->getClientOriginalName();
            $file_url = $path . '/' . $file_name;
            Storage::disk('public')->put($file_url, file_get_contents($request->file('file_modul')->getRealPath()));
        } else {
            return redirect()->back()->with('failed', 'File tidak boleh kosong');
        }

        ModulDiklat::find($id)->update([
            'judul_modul' => $request->judul_modul,
            'deskripsi_modul' => $request->deskripsi_modul,
            'file_modul' => $file_url
        ]);

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
