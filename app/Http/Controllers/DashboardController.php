<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $get_nis = Profile::select('nis')->where('user_id', $user_id)->get();
        // dd($get_nis);

        $nis = $get_nis->toArray();
        // dd($nis);
            $tagihan_bdu = Tagihan::get_tagihan_bdu_by_nis($nis);
            // $tagihan_bdu = Tagihan::get_tagihan_bdu_by_nis($nis);
            // dd($tagihan_bdu);
            $tagihan_spp = Tagihan::get_tagihan_spp_by_nis($nis);
            $spp_last_month = Tagihan::get_tunggakan_spp_by_nis($nis);
            $spp_lunas = Tagihan::get_spp_lunas_by_nis($nis);
            $tunggakan_spp = Tagihan::total_tunggakan_spp_by_nis($nis);
       
        return view('admin.dashboard', compact('tagihan_spp', 'tagihan_bdu', 'tunggakan_spp', 'spp_last_month', 'spp_lunas'));
        
        // $detail_tunggakan =
        // dd($spp_lunas);
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
