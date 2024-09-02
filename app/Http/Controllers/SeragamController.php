<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\HargaSeragam;
use App\Models\JenisSeragam;
use App\Models\LokasiSub;
use App\Models\MenuMobile;
use App\Models\OrderDetailSeragam;
use App\Models\OrderSeragam;
use App\Models\ProdukSeragam;
use App\Models\Profile;
use App\Models\UkuranSeragam;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeragamController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $lokasi = LokasiSub::select('id as kode_lokasi', 'sublokasi')->where('status', 1)->get();
        $produk_seragam = ProdukSeragam::all();
        $produk_seragam_tk = ProdukSeragam::where('jenjang_id', 2)->get();
        $produk_seragam_sd = ProdukSeragam::where('jenjang_id', 3)->get();
        $produk_seragam_smp = ProdukSeragam::where('jenjang_id', 4)->get();
        $produk_seragam_bani = ProdukSeragam::where('jenjang_id', 5)->get();

        $search = $request->input('search');

        $search_produk = ProdukSeragam::where('nama_produk', 'like', "$search")->get();

        $cart_detail = CartDetail::leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                            ->where('user_id', $user_id)
                            ->where('t_cart_detail.status_cart', 0)
                            ->get();

        $menubar = MenuMobile::where('is_footer', 1)->get();

        return view('ortu.seragam.index', compact('lokasi', 'produk_seragam', 'produk_seragam_tk', 'produk_seragam_sd', 'produk_seragam_smp', 'produk_seragam_bani', 'search_produk', 'cart_detail', 'menubar'));
    }

    public function detail_produk(Request $request, $id)
    {
        $produk = ProdukSeragam::select('m_produk_seragam.id','m_produk_seragam.nama_produk', 'm_produk_seragam.deskripsi', 'm_produk_seragam.image', 'm_produk_seragam.image_2',
        'm_produk_seragam.image_3', 'm_produk_seragam.image_4', 'm_produk_seragam.image_5', 'm_produk_seragam.material', 'mhs.harga', 'mhs.diskon', 'mjps.jenis_produk')
                                ->leftJoin('m_harga_seragam as mhs', 'mhs.produk_id', 'm_produk_seragam.id')
                                ->leftJoin('m_ukuran_seragam as mus', 'mus.grup_ukuran', 'mhs.ukuran_id')
                                ->leftJoin('m_jenis_produk_seragam as mjps', 'mjps.id', 'mhs.jenis_produk_id')
                                ->where('m_produk_seragam.id', $id)
                                ->first();

        $user_id = auth()->user()->id;

        $jenis_produk = JenisSeragam::select('m_jenis_produk_seragam.id','m_jenis_produk_seragam.jenis_produk')
                                    ->leftJoin('m_harga_seragam as mhs', 'mhs.jenis_produk_id', 'm_jenis_produk_seragam.id')
                                    ->leftJoin('m_produk_seragam as mps', 'mps.id', 'mhs.produk_id')
                                    ->leftJoin('m_ukuran_seragam as mus', 'mus.id', 'mhs.ukuran_id')
                                    ->where('mps.id', $id)
                                    ->groupby('m_jenis_produk_seragam.id')                          
                                    ->get();
        
        $ukuran_seragam = HargaSeragam::select('mus.id', 'mus.ukuran_seragam')
                                    ->leftJoin('m_ukuran_seragam as mus', 'mus.id', 'm_harga_seragam.ukuran_id')
                                    ->leftJoin('m_produk_seragam as mps', 'mps.id', 'm_harga_seragam.produk_id')
                                    ->where('mps.id', $id)
                                    ->groupby('mus.id')
                                    ->get();

        $profile = Profile::where('user_id', $user_id)->get();

        $cart_detail = CartDetail::leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                                ->where('user_id', $user_id)
                                ->where('t_cart_detail.status_cart', 0)
                                ->get();
        // dd($jenis_produk);

        return view('ortu.seragam.detail', compact('produk', 'cart_detail', 'profile', 'jenis_produk', 'ukuran_seragam'));
    }

    public function cart(Request $request)
    {

        $user_id = auth()->user()->id;

        $profile = Profile::where('user_id', $user_id)->get();

        $cart_detail = CartDetail::select('t_cart_detail.id', 'm_produk_seragam.id as id_produk','m_produk_seragam.nama_produk', 'm_produk_seragam.deskripsi', 'm_produk_seragam.image', 
                    'm_produk_seragam.material', 'mhs.harga', 'mhs.diskon', 'mjps.id as jenis_id', 'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas as nama_kelas', 
                    'mls.sublokasi as sekolah', 'mjps.jenis_produk', 't_cart_detail.quantity', 't_cart_detail.ukuran')
                    ->leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                    ->leftJoin('m_profile as mp' , 'mp.nis', 't_cart_detail.nis')
                    ->leftJoin('mst_lokasi_sub as mls', 'mls.id', 'mp.sekolah_id')
                    ->leftJoin('m_jenis_produk_seragam as mjps', 'mjps.id', 't_cart_detail.jenis')
                    ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_detail.ukuran')
                    ->leftJoin('m_harga_seragam as mhs', function($join)
                    { $join->on('mhs.produk_id', '=', 'm_produk_seragam.id') 
                        ->on('mhs.jenis_produk_id', '=', 'mjps.id')
                        ->on('mus.id', '=', 'mhs.ukuran_id'); 
                    })
                    ->where('t_cart_detail.user_id', $user_id)
                    ->where('t_cart_detail.status_cart', 0)
                    ->get();
        // dd($cart_detail);

        return view('ortu.seragam.cart', compact('profile', 'cart_detail'));
    }

    public function harga(Request $request) {
        $user_id = auth()->user()->id;
        $jenis = $request->jenis_id;
        $produk_id = $request->produk_id;
        $ukuran = $request->ukuran_id;

        $ukuran_id = UkuranSeragam::where('ukuran_seragam', $ukuran)->first();

        $harga = HargaSeragam::where('jenis_produk_id', $jenis)->where('produk_id', $produk_id)->where('ukuran_id', $ukuran_id->id)->get();
     
        return response()->json($harga);
    }


    public function add_to_cart(Request $request)
    {
        $produk_id = $request->produk_id;
        $quantity = $request->quantity;
        $ukuran = $request->ukuran;
        $nis = $request->nama_siswa;
        $jenis = $request->jenis;

        $user_id = auth()->user()->id;
        $profile = Profile::where('nis', $nis)->first();

        $add_cart_detail =  CartDetail::create([
            'produk_id' => $produk_id,
            'user_id' => $user_id,
            'nis' => $nis,
            'quantity' => $quantity,
            'ukuran' => $ukuran,
            'jenis' => $jenis,
            
        ]);
    
        return response()->json($add_cart_detail);

    }

    public function update_cart(Request $request, $id) 
    {
        $quantity = $request->quantity;
        $cart_detail = CartDetail::where('id', $id)->update([
            'quantity' => $quantity
        ]);


        return response()->json($cart_detail);
    }

    public function remove_cart($id) 
    {
        CartDetail::find($id)->delete();

        return redirect()->route('seragam.cart')
            ->with('error', 'Remove from cart successfully');
    }

    public function buy_now(Request $request)
    {
        
        $order = $request->all();
        $order_dec = json_decode($order['data'], true);
    
        $produk_id = $order_dec[0]['produk_id'];
        $quantity = $order_dec[0]['quantity'];
        $ukuran = $order_dec[0]['ukuran'];
        $jenis = $order_dec[0]['jenis'];
        $nis = $order_dec[0]['nama_siswa'];

        $produk_seragam = ProdukSeragam::select('m_produk_seragam.id', 'm_produk_seragam.nama_produk', 'm_produk_seragam.image', 'mhs.harga', 'mhs.diskon', 'mjps.jenis_produk')
                        ->leftJoin('m_harga_seragam as mhs', 'mhs.produk_id', 'm_produk_seragam.id')
                        ->leftJoin('m_jenis_produk_seragam as mjps', 'mjps.id', 'mhs.jenis_produk_id')
                        ->leftJoin('m_ukuran_seragam as mus', 'mus.id', 'mhs.ukuran_id')
                        ->where('m_produk_seragam.id', $produk_id)
                        ->where('mhs.jenis_produk_id', $jenis)
                        ->where('mus.ukuran_seragam', $ukuran)
                        ->first();

        $profile = Profile::leftJoin('mst_lokasi_sub as mls', 'mls.id', 'm_profile.sekolah_id' )
                            ->where('nis', $nis)->first();
        // dd($produk_seragam);

        return view('ortu.seragam.pembayaran', compact('profile', 'produk_seragam', 'quantity', 'ukuran', 'profile', 'order'));

    }

    public function pembayaran(Request $request, OrderSeragam $order_seragam)
    {

        $user_id = auth()->user()->id;

        $order = $request->all();
        
        $profile = Profile::where('user_id', $user_id)->get();
        $cart_detail =  CartDetail::select('t_cart_detail.id', 'm_produk_seragam.id as id_produk','m_produk_seragam.nama_produk', 'm_produk_seragam.deskripsi', 'm_produk_seragam.image', 
                            'm_produk_seragam.material', 'mhs.harga', 'mhs.diskon', 'mjps.id as jenis_id', 'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas as nama_kelas', 
                            'mls.sublokasi as sekolah', 'mjps.jenis_produk', 't_cart_detail.quantity', 't_cart_detail.ukuran')
                            ->leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                            ->leftJoin('m_profile as mp' , 'mp.nis', 't_cart_detail.nis')
                            ->leftJoin('mst_lokasi_sub as mls', 'mls.id', 'mp.sekolah_id')
                            ->leftJoin('m_jenis_produk_seragam as mjps', 'mjps.id', 't_cart_detail.jenis')
                            ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_detail.ukuran')
                            ->leftJoin('m_harga_seragam as mhs', function($join)
                            { $join->on('mhs.produk_id', '=', 'm_produk_seragam.id') 
                                ->on('mhs.jenis_produk_id', '=', 'mjps.id')
                                ->on('mus.id', '=', 'mhs.ukuran_id'); 
                            })
                            ->where('t_cart_detail.user_id', $user_id)
                            ->where('t_cart_detail.status_cart', 0)
                            ->get();

        return view('ortu.seragam.pembayaran', compact('profile', 'cart_detail', 'order_seragam', 'order'));
        
        // dd($order);


    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $no_hp = auth()->user()->no_hp;
        $nama_pemesan = auth()->user()->name;
        $no_pesanan = 'INV-RSU-'. date('YmdHis');

        $order = CartDetail::select('t_cart_detail.id', 'm_produk_seragam.id as id_produk','m_produk_seragam.nama_produk', 'm_produk_seragam.deskripsi', 'm_produk_seragam.image', 
                            'm_produk_seragam.material', 'mhs.harga', 'mhs.diskon', 'mjps.id as jenis_id', 'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas as nama_kelas', 
                            'mls.id as sekolah', 'mjps.jenis_produk', 'mjps.id as jenis_id',  't_cart_detail.quantity', 't_cart_detail.ukuran')
                            ->leftJoin('m_produk_seragam', 'm_produk_seragam.id', 't_cart_detail.produk_id')
                            ->leftJoin('m_profile as mp' , 'mp.nis', 't_cart_detail.nis')
                            ->leftJoin('mst_lokasi_sub as mls', 'mls.id', 'mp.sekolah_id')
                            ->leftJoin('m_jenis_produk_seragam as mjps', 'mjps.id', 't_cart_detail.jenis')
                            ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_detail.ukuran')
                            ->leftJoin('m_harga_seragam as mhs', function($join)
                            { $join->on('mhs.produk_id', '=', 'm_produk_seragam.id') 
                                ->on('mhs.jenis_produk_id', '=', 'mjps.id')
                                ->on('mus.id', '=', 'mhs.ukuran_id'); 

                            })
                            ->where('t_cart_detail.user_id', $user_id)
                            ->where('t_cart_detail.status_cart', 0)
                            ->get();

        $total_harga = 0;
        $total_diskon =0;
       foreach ($order as $item) {
           $nama_siswa = $item['nama_siswa'];
           $lokasi = $item['sekolah'];
           $nama_kelas = $item['nama_kelas'];
           $produk_id = $item['id_produk'];
           $ukuran = $item['ukuran'];
           $quantity = $item['quantity'];
           $harga_awal = $item['harga'];
           $diskon = $item['diskon'];
           $jenis_produk = $item['jenis_id'];

            $order_detail = OrderDetailSeragam::create([
                'no_pemesanan' => $no_pesanan,
                'nama_siswa' => $nama_siswa,
                'lokasi_sekolah' => $lokasi,
                'nama_kelas' => $nama_kelas,
                'produk_id' => $produk_id,
                'ukuran' => $ukuran,
                'quantity' => $quantity,
                'harga' => $harga_awal,
                'diskon' => $diskon/100 * $harga_awal,
                'jenis_produk_id' => $jenis_produk,
                
            ]);

            $total_harga += $harga_awal * $quantity;
            $total_diskon = $diskon/100 * $total_harga;
            $harga_akhir = $total_harga - $total_diskon;
            $harga_akhir_format = number_format($harga_akhir);

            // $this->send_pesan_seragam_detail($no_pesanan, $nama_siswa, $lokasi, $nama_kelas, $produk_id, $jenis_produk, $ukuran, $quantity, $harga_awal, $diskon/100 * $harga_awal);

        }

       $order_seragam = OrderSeragam::create([

        'no_pemesanan' => $no_pesanan,
        'no_hp' => $no_hp,
        'nama_pemesan' => $nama_pemesan,
        'status' => 'pending',
        'total_harga' => $harga_akhir,
        'user_id' => $user_id
        ]);


        // $this->send_pesan_seragam($no_pesanan, $nama_pemesan, $no_hp);

          // Set your Merchant Server Key
          \Midtrans\Config::$serverKey = config('midtrans.serverKey');
          // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
          \Midtrans\Config::$isProduction = config('midtrans.isProduction');;
          // Set sanitization on (default)
          \Midtrans\Config::$isSanitized = true;
          // Set 3DS transaction for credit card to true
          \Midtrans\Config::$is3ds = true;

          $params = array(
              'transaction_details' => array(
                  'order_id' => $no_pesanan,
                  'gross_amount' => $harga_akhir,
              ),
              'customer_details' => array(
                  'first_name' => $nama_pemesan,
                  'phone' => $no_hp,
              )
          );

          $snapToken = \Midtrans\Snap::getSnapToken($params);
          $order_seragam->snap_token = $snapToken;
          $order_seragam->save();

          //kirim notif ke pemesan
          $message = "Informasi Pemesanan Seragam Sekolah Rabbani

Terima kasih Ayah/Bunda $nama_siswa telah melakukan pemesanan Seragam.🙏☺

Berikut adalah detail pemesanan Anda:

No invoice: *$no_pesanan*
Nama Pemesan: *$nama_pemesan*
Cabang Sekolah : *$lokasi*
Total Pembayaran: *Rp. $harga_akhir_format*

Berikut Rekening Pembayaran Pemesanan Seragam :

*Bank Syariah Indonesia (BSI)*
Nomor Rekening: 7700700218
Atas Nama: *Seragam Sekolah Rabbani*

Setelah melakukan pembayaran, silahkan bisa konfirmasi dengan mengirimkan foto bukti transfernya.🙏

Catatan :
_Pesanan akan diproses setelah pembayaran dikonfirmasi._
Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, silahkan bisa menghubungi kami.

Terima kasih atas kepercayaan *Ayah/Bunda $nama_siswa*.🙏☺";

        // $send_notif = $this->send_notif($no_hp, $message);

        //   $update_cart = CartDetail::where('user_id', $user_id)->where('status_cart', 0)->get();
        //   $update_cart->update([
        //       'status_cart' => 1
        //   ]);

        return response()->json($order_seragam);

    }


    public function success(Request $request) {

        return view('ortu.seragam.success');

    }

    public function callback(Request $request) {
        
        $serverKey = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $transactionStatus = $request->transaction_status;
        $mtd_pembayaran = null;
        $no_va = null;
        $paymentType = $request->payment_type;

        if ($paymentType == 'shopeepay' || $paymentType == 'gopay') {
            $mtd_pembayaran == $paymentType;
            $no_va = 0;
        } else if ($paymentType == 'bank_transfer' && !$request->permata_va_number) {
            $va_number = $request->va_numbers[0]['va_number'];
            
            $bank = $request->va_numbers[0]['bank'];

            $mtd_pembayaran = $bank;
            $no_va = $va_number;
            // return response()->json($no_va);
        } else if ($paymentType == 'bank_transfer' && $request->permata_va_number) {
            $va_number = $request->permata_va_number;
            
            $bank = 'Permata';

            $mtd_pembayaran = $bank;
            $no_va = $va_number;
        } else if($paymentType == 'echannel') {
            $no_va = $request->bill_key;
            $mtd_pembayaran = 'Mandiri';
        }
        $orderId = $request->order_id;
        $order = OrderSeragam::where('no_pemesanan', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        switch ($transactionStatus) {
            case 'capture':
                if ($request->payment_type == 'credit_card') {
                    if ($request->fraud_status == 'challenge') {
                        $order->update([
                            'status' => 'pending',
                            'metode_pembayaran' => $mtd_pembayaran,
                            'va_number' => $no_va
                        ]);
                    } else {
                        $order->update([
                            'status' => 'success',
                            'metode_pembayaran' => $mtd_pembayaran,
                            'va_number' => $no_va
                        ]);
                    }
                }
                break;
            case 'settlement':
                $order->update([
                    'status' => 'success',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va,
                    'updated_at' => $request->settlement_time
                ]);
                //    $this->update_status_seragam('success', $mtd_pembayaran, $orderId);
                break;
            case 'pending':
                $order->update([
                    'status' => 'pending',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va
                ]);
                // $this->update_status_seragam('pending', $mtd_pembayaran, $orderId);
                break;
            case 'deny':
                $order->update([
                    'status' => 'failed',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va
                ]);
                break;
            case 'expire':
                $order->update([
                    'status' => 'expired',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va
                ]);
                // $this->update_status_seragam('expired', $mtd_pembayaran, $orderId);
                break;
            case 'cancel':
                $order->update([
                    'status' => 'canceled',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va
                ]);
                break;
            default:
                $order->update([
                    'status' => 'unknown',
                ]);
                break;
        }

        return response()->json(['message' => 'Callback received successfully']);
    }


    public function history(Request $request) {
        $user_id = auth()->user()->id;
        $menubar = MenuMobile::where('is_footer', 1)->get();


        $order = OrderSeragam::select('psd.*', 'mps.image', 'mps.nama_produk', 't_pesan_seragam.status', 't_pesan_seragam.total_harga', 't_pesan_seragam.user_id')
                                ->leftJoin('t_pesan_seragam_detail as psd', 'psd.no_pemesanan', 't_pesan_seragam.no_pemesanan')
                                ->leftJoin('m_produk_seragam as mps', 'psd.produk_id', 'mps.id')
                                ->where('t_pesan_seragam.user_id', $user_id)
                                ->groupby('psd.no_pemesanan', 't_pesan_seragam.total_harga')
                                ->get();
        
        return view('ortu.seragam.history', compact('order', 'menubar'));
    }

    public function rincian_pesanan (Request $request, $id) {
        $user_id = auth()->user()->id;

        $order = OrderSeragam::where('no_pemesanan', $id)->first();

        $order_detail = OrderDetailSeragam::select('tps.no_pemesanan', 'tps.metode_pembayaran', 'tps.va_number', 't_pesan_seragam_detail.*', 'mps.nama_produk', 'mps.image')
                                            ->leftJoin('m_produk_seragam as mps', 't_pesan_seragam_detail.produk_id', 'mps.id')
                                            ->leftJoin('t_pesan_seragam as tps', 'tps.no_pemesanan', 't_pesan_seragam_detail.no_pemesanan')
                                            ->where('tps.no_pemesanan', $id)->get();
        
                                            // dd($order);
        return view('ortu.seragam.rincian-pesan', compact( 'order', 'order_detail'));
    }

    public function download(Request $request, $id) {
        $user_id = auth()->user()->id;

        $order = OrderSeragam::where('no_pemesanan', $id)->first();

        $order_detail = OrderDetailSeragam::select('tps.no_pemesanan', 'tps.metode_pembayaran', 'tps.va_number', 't_pesan_seragam_detail.*', 'mps.nama_produk', 'mps.image', 'mjps.jenis_produk')
                                            ->leftJoin('m_produk_seragam as mps', 't_pesan_seragam_detail.produk_id', 'mps.id')
                                            ->leftJoin('t_pesan_seragam as tps', 'tps.no_pemesanan', 't_pesan_seragam_detail.no_pemesanan')
                                            ->leftJoin('m_jenis_produk_seragam as mjps', 'mjps.id', 't_pesan_seragam_detail.jenis_produk_id')
                                            ->where('tps.no_pemesanan', $id)->get();
        // dd($order);

        // Load view dengan data yang disiapkan
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('ortu.seragam.invoice', [
                        'order' => $order,
                        'order_detail' => $order_detail
                    ]);
        $pdf->setPaper('Letter');
        $pdf->setWarnings(false);

        // Download file PDF
        return $pdf->download('Invoice-'.$id.'.pdf');
    }

    public function invoice(Request $request, $id) {

        $pemesan = OrderSeragam::where('no_pemesanan', $id)->first();
        // dd($pemesan);
        $detail_pesan = OrderDetailSeragam::get_detail_produk($id);
        // dd($detail_pesan);

        // $pdf = Pdf::loadView('invoice.index', ['data' => $pemesan, $detail_pesan]);
     
        return view('ortu.seragam.invoice', compact('pemesan', 'detail_pesan'));
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

    function send_pesan_seragam_detail($no_pesanan, $nama_siswa, $lokasi_sekolah, $nama_kelas, $produk_id, $jenis_produk_id, $ukuran, $quantity, $harga, $diskon){
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
		  	'jenis_produk_id' => $jenis_produk_id,
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

    function update_status_seragam($status, $mtd_pembayaran, $no_pesanan)
    {
        {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://103.135.214.11:81/qlp_system/api_regist/update_pesan_seragam.php',
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
                'status' => $status,
                'mtd_pembayaran' => $mtd_pembayaran,
                'no_pesanan' => $no_pesanan,
                )
    
            ));
    
            $response = curl_exec($curl);
    
            // echo $response;
            curl_close($curl);
            // return ($response);
        }
    }
}
