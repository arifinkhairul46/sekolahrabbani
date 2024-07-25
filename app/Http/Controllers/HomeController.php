<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jenjang = Jenjang::all();

        return view('index', compact('jenjang'));
    }

    public function jenjang(Request $request, $jenjang)
    {
        $jenjang_detail = Jenjang::jenjang_sekolah_sub_lokasi($jenjang);
        // dd($jenjang_detail);

        return view('jenjang.index', compact('jenjang_detail'));
    }
}
