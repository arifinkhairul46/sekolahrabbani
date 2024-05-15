<?php

namespace App\Http\Controllers;

use App\Models\Karir;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('karir.index');
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
     * @param  \App\Models\Karir  $karir
     * @return \Illuminate\Http\Response
     */
    public function show(Karir $karir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karir  $karir
     * @return \Illuminate\Http\Response
     */
    public function edit(Karir $karir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karir  $karir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karir $karir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karir  $karir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karir $karir)
    {
        //
    }

    public function login()
    {
        return view('karir.login');
    }

    public function verifikasi()
    {
        return view('karir.verifikasi');
    }

    public function store_verifikasi(Request $request) {
        try {
            $request->validate([
                'no_hp' => 'required',
                'email' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);

            $user_csdm = Karir::where('no_hp', $request->no_hp)
                        ->where('email', $request->email)
                        ->first();

            if ($user_csdm) {
                $message = "Halo $user_csdm->nama Silahkan masuk ke https://sekolahrabbani.sch.id/karir/login dengan 
        ID : " . $user_csdm->id_csdm . "  
        password : " . $user_csdm->password . "
                
*Mohon untuk tidak menyebarkan ID dan password ini kepada siapapun. Terima kasih.*";
                $no_wha = $request->no_hp;
                $this->send_notif($message, $no_wha);
                return redirect()->route('karir.login')->with('success', 'Kode verifikasi telah dikirim ke nomor whatsapp anda');
            } else {
                return redirect()->route('karir.verifikasi')->with('error', 'Nomor whatsapp tidak terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->route('karir.verifikasi')->with('error', 'Terjadi kesalahan');
        }
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
        // curl_setopt($curl, CURLOPT_URL, "https://tx.wablas.com/api/v2/send-bulk/text");
        curl_setopt($curl, CURLOPT_URL, "https://pati.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
    
        // echo "<pre>";
        return ($result);
    }

}
