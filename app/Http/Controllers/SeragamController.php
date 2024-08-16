<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\LokasiSub;
use App\Models\OrderDetailSeragam;
use App\Models\OrderSeragam;
use App\Models\ProdukSeragam;
use App\Models\Profile;
use Illuminate\Http\Request;

class SeragamController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $lokasi = LokasiSub::select('id as kode_lokasi', 'sublokasi')->where('status', 1)->get();
        $produk_seragam = ProdukSeragam::all();
        $search = $request->input('search');

        $search_produk = ProdukSeragam::where('nama_produk', 'like', "$search")->get();

        $cart_detail = CartDetail::leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                            ->where('user_id', $user_id)->get();

        return view('ortu.seragam.index', compact('lokasi', 'produk_seragam', 'search_produk', 'cart_detail'));
    }

    public function detail_produk(Request $request, $id)
    {
        $produk = ProdukSeragam::find($id);

        $user_id = auth()->user()->id;

        $profile = Profile::where('user_id', $user_id)->get();

        $cart_detail = CartDetail::leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
        ->where('user_id', $user_id)->get();
        // dd($profile);

        return view('ortu.seragam.detail', compact('produk', 'cart_detail', 'profile'));
    }

    public function cart(Request $request)
    {

        $user_id = auth()->user()->id;

        $profile = Profile::where('user_id', $user_id)->get();
        // $cart = Cart::where('user_id', $user_id)->get();
        $cart_detail = CartDetail::select('m_produk_seragam.*', 't_cart_detail.*', 'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas as nama_kelas', 'mls.sublokasi as sekolah')
                    ->leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                    ->leftJoin('m_profile as mp' , 'mp.nis', 't_cart_detail.nis')
                    ->leftJoin('mst_lokasi_sub as mls', 'mls.id', 'mp.sekolah_id')
                    ->where('t_cart_detail.user_id', $user_id)->get();
        // dd($cart_detail);

        return view('ortu.seragam.cart', compact('profile', 'cart_detail'));
    }

    public function add_to_cart(Request $request)
    {
        $produk_id = $request->produk_id;
        $quantity = $request->quantity;
        $ukuran = $request->ukuran;
        $nis = $request->nama_siswa;

        $user_id = auth()->user()->id;
        $profile = Profile::where('nis', $nis)->first();

        $add_cart = Cart::create([
            'user_id' => $user_id,
        ]);

        $add_cart_detail =  CartDetail::create([
            'produk_id' => $produk_id,
            'user_id' => $user_id,
            'cart_id' => $user_id,
            'nis' => $nis,
            'quantity' => $quantity,
            'ukuran' => $ukuran,
        ]);
        
        // $data = $request->data;
        // // return $data;
        // $data = json_decode($data, true);
        // foreach ($data as $k=> $item) {
        //     $produk = ProdukSeragam::where('id', $item['produk_id'])->get();
        //     // return $produk;
        // }
        return response()->json($add_cart_detail);
        // return view('ortu.seragam.cart', compact('profile'));


    }

    public function remove_cart($id) 
    {
        Cart::find($id)->delete();
        CartDetail::find($id)->delete();

        return redirect()->route('seragam.cart')
            ->with('error', 'Remove from cart successfully');
    }

    public function pembayaran(Request $request)
    {

        $user_id = auth()->user()->id;

        $profile = Profile::where('user_id', $user_id)->get();
        $cart_detail = CartDetail::select('m_produk_seragam.*', 't_cart_detail.*', 'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas as nama_kelas', 'mls.sublokasi as sekolah')
                    ->leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                    ->leftJoin('m_profile as mp' , 'mp.nis', 't_cart_detail.nis')
                    ->leftJoin('mst_lokasi_sub as mls', 'mls.id', 'mp.sekolah_id')
                    ->where('t_cart_detail.user_id', $user_id)->get();
        // dd($cart_detail);

        return view('ortu.seragam.pembayaran', compact('profile', 'cart_detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
        ]);

        $order = $request->all();

        $no_pesanan = 'INV-RSU-'. date('YmdHis');
        $nama_pemesan = $request->nama_pemesan;
        $no_hp = $request->no_hp;

        $order = json_decode($order['data'], true);


        $order_create = OrderSeragam::create([
            'no_pemesanan' => $no_pesanan,
            'no_hp' => $no_hp,
            'nama_pemesan' => $nama_pemesan
        ]);

        $total_harga = 0;
        $total_diskon =0;
       foreach ($order as $item) {
           $nama_siswa = $item['nama_siswa'];
           $lokasi = $item['lokasi'];
           $nama_kelas = $item['kelas'];
           $produk_id = $item['produk_id'];
           $ukuran = $item['ukuran'];
           $quantity = $request->quant[$produk_id];

           $get_harga = ProdukSeragam::select('harga_awal')->where('id', $produk_id)->first();
           $get_sekolah = OrderSeragam::where('id', $lokasi)->first();

            $order_detail = OrderDetailSeragam::create([
                'no_pemesanan' => $no_pesanan,
                'nama_siswa' => $nama_siswa,
                'lokasi_sekolah' => $lokasi,
                'nama_kelas' => $nama_kelas,
                'produk_id' => $produk_id,
                'ukuran' => $ukuran,
                'quantity' => $quantity,
                'harga' => $get_harga->harga_awal,
                'diskon' => 20/100 * $get_harga->harga_awal
            ]);

            $total_harga += $get_harga->harga_awal * $quantity;
            $total_diskon = 20/100 * $total_harga;
            $harga_akhir = number_format($total_harga - $total_diskon);

            $this->send_pesan_seragam_detail($no_pesanan, $nama_siswa, $lokasi, $nama_kelas, $produk_id, $ukuran, $quantity, $get_harga->harga_awal, 20/100 * $get_harga->harga_awal);

       }

        $message = "Informasi Pemesanan Seragam Sekolah Rabbani

Terima kasih Ayah/Bunda $nama_siswa telah melakukan pemesanan Seragam.🙏☺

Berikut adalah detail pemesanan Anda:

No invoice: *$no_pesanan*
Nama Pemesan: *$nama_pemesan*
Cabang Sekolah : *$get_sekolah->sublokasi*
Total Pembayaran: *Rp. $harga_akhir*

Berikut Rekening Pembayaran Pemesanan Seragam :

*Bank Syariah Indonesia (BSI)*
Nomor Rekening: 7700700218
Atas Nama: *Seragam Sekolah Rabbani*

Setelah melakukan pembayaran, silahkan bisa konfirmasi dengan mengirimkan foto bukti transfernya.🙏

Catatan :
_Pesanan akan diproses setelah pembayaran dikonfirmasi._
Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, silahkan bisa menghubungi kami.

Terima kasih atas kepercayaan *Ayah/Bunda $nama_siswa*.🙏☺";

        $send_notif = $this->send_notif($no_hp, $message);

        $this->send_pesan_seragam($no_pesanan, $nama_pemesan, $no_hp);

        return redirect()->route('invoice', $no_pesanan)->with('success', 'Terimakasih telah melakukan pemesanan seragam');

    }

    public function invoice(Request $request, $id) {

        $pemesan = OrderSeragam::where('no_pemesanan', $id)->first();
        // dd($pemesan);
        $detail_pesan = OrderDetailSeragam::get_detail_produk($id);
        // dd($detail_pesan);

        // $pdf = Pdf::loadView('invoice.index', ['data' => $pemesan, $detail_pesan]);
     
        return view('invoice.index', compact('pemesan', 'detail_pesan'));
    }


    function send_notif ($no_wha, $message) {
        $dataSending = array();
        $dataSending["api_key"] = "VDSVRW87NW812KD7";
        $dataSending["number_key"] = "3UgISCw7MC8dDj75";
        $dataSending["phone_no"] = $no_wha;
        $dataSending["message"] = $message;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataSending),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

    }

    function send_pesan_seragam($no_pesanan, $nama_pemesan, $no_hp){
	    $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.135.214.11:81/qlp_system/api_regist/simpan_pesan_seragam.php',
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
		  	'no_pesanan' => $no_pesanan,
		  	'nama_pemesan' => $nama_pemesan,
		  	'no_hp' => $no_hp)

		));

		$response = curl_exec($curl);

		// echo $response;
		curl_close($curl);
	    // return ($response);
	}

    function send_pesan_seragam_detail($no_pesanan, $nama_siswa, $lokasi_sekolah, $nama_kelas, $produk_id, $ukuran, $quantity, $harga, $diskon){
	    $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.135.214.11:81/qlp_system/api_regist/simpan_pesan_seragam_detail.php',
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
		  	'no_pesanan' => $no_pesanan,
		  	'nama_siswa' => $nama_siswa,
		  	'lokasi_sekolah' => $lokasi_sekolah,
		  	'nama_kelas' => $nama_kelas,
		  	'produk_id' => $produk_id,
		  	'ukuran' => $ukuran,
		  	'quantity' => $quantity,
		  	'harga' => $harga,
		  	'diskon' => $diskon)

		));

		$response = curl_exec($curl);

		// echo $response;
		curl_close($curl);
	    // return ($response);
	}
}
