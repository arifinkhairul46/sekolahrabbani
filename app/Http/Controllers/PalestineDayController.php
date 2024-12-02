<?php

namespace App\Http\Controllers;

use App\Exports\HaveReadList;
use App\Models\CartMerchandise;
use App\Models\DesainPalestineday;
use App\Models\HargaMerchandise;
use App\Models\HaveRead;
use App\Models\Merchandise;
use App\Models\OrderDetailMerchandise;
use App\Models\OrderMerchandise;
use App\Models\PalestineDay;
use App\Models\Profile;
use App\Models\UkuranSeragam;
use App\Models\WarnaKaos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PalestineDayController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_phone = Auth::user()->no_hp;

        $get_jenjang = Profile::where('no_hp_ibu', $user_phone)->groupby('sekolah_id')->get();

        return view('ortu.palestine_day.index', compact('get_jenjang'));
        
    }

    public function materi_tk()
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::where('jenjang', 1)->where('status', 1)->get();

        return view('ortu.palestine_day.materi-tk', compact('materi'));
        
    }

    public function materi_tk_by_id($id)
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::find($id);

        $file = public_path('storage/'.$materi->file);
        
        return response()->file($file);
        
    }

    public function materi_tksd_by_id($id)
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::find($id);

        $file = public_path('storage/'.$materi->file);

        $sudah_baca = HaveRead::where('user_id', $user_id)->where('materi_id', $id)->first();

        return view('ortu.palestine_day.materi-by-id', compact('file', 'materi', 'sudah_baca'));
        
    }

    public function materi_smp()
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::where('jenjang', 2)->where('status', 1)->get();

        $date_today = date('Y-m-d');

        return view('ortu.palestine_day.materi-smp', compact('materi', 'date_today'));
        
    }

    public function materi_smp_by_id($id)
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::find($id);

        $file = public_path('storage/'.$materi->file);

        $sudah_baca = HaveRead::where('user_id', $user_id)->where('materi_id', $id)->first();

        
        return view('ortu.palestine_day.materi-smp-by-id', compact('file', 'materi', 'sudah_baca'));
        
    }

    public function master_materi()
    {
        $materi_tksd = PalestineDay::where('jenjang', 1)->get();
        $materi_smp = PalestineDay::where('jenjang', 2)->get();
        return view('admin.master.palestineday.index', compact('materi_tksd', 'materi_smp'));
    }

    public function master_materi_by_id(Request $request, $id)
    {
        $detail_materi = PalestineDay::where('id', $id)->first();

        return response($detail_materi);
    }

    public function update_materi(Request $request, $id)
    {
        try {
            $user = Auth::user()->name;

            $file = null;
            $file_url = null;
            $path = 'palestineday/file';
            if ($request->has('file')) {
                $file = $request->file('file')->store($path);
                $file_name = $request->file('file')->getClientOriginalName();
                $file_url = $path . '/' . $file_name;
                Storage::disk('public')->put($file_url, file_get_contents($request->file('file')->getRealPath()));
            }
    
            $image = null;
            $image_url = null;
            $path = 'palestineday/gambar';
            if ($request->has('gambar')) {
                $image = $request->file('gambar')->store($path);
                $image_name = $request->file('gambar')->getClientOriginalName();
                $image_url = $path . '/' . $image_name;
                Storage::disk('public')->put($image_url, file_get_contents($request->file('gambar')->getRealPath()));
            }

            $update_materi = PalestineDay::where('id', $id)->update([
            'judul' => $request->judul_edit,
            'style' => $request->warna_edit,
            'status'  => $request->status_edit,
            'terbit'  => $request->terbit_edit,
            'link_evaluasi'  => $request->evaluasi_edit,
            'jenjang' => $request->jenjang_edit,
            'created_by' => $request->penulis_edit,
            'design_by' => $request->design_by_edit,
            'updated_by' => $user,
            ]);
            return redirect()->back()->withSuccess('Success update Materi ');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'required'
        ]);

        $user = Auth::user()->name;

        $file = null;
        $file_url = null;
        $path = 'palestineday/file';
        if ($request->has('file')) {
            $file = $request->file('file')->store($path);
            $file_name = $request->file('file')->getClientOriginalName();
            $file_url = $path . '/' . $file_name;
            Storage::disk('public')->put($file_url, file_get_contents($request->file('file')->getRealPath()));
        } else {
            return redirect()->back()->with('failed', 'File tidak boleh kosong');
        }

        $image = null;
        $image_url = null;
        $path = 'palestineday/gambar';
        if ($request->has('gambar')) {
            $image = $request->file('gambar')->store($path);
            $image_name = $request->file('gambar')->getClientOriginalName();
            $image_url = $path . '/' . $image_name;
            Storage::disk('public')->put($image_url, file_get_contents($request->file('gambar')->getRealPath()));
        } else {
            return redirect()->back()->with('error', 'Image tidak boleh kosong');
        }

        PalestineDay::create([
            'judul' => $request->judul,
            'style' => $request->warna,
            'deskripsi' => $request->deskripsi,
            'file' => $file_url,
            'image' => $image_url,
            'status'  => 1,
            'terbit'  => $request->terbit,
            'jenjang' => $request->jenjang,
            'created_by' => $request->penulis,
            'design_by' => $request->design_by,
            'updated_by' => $user,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Materi created successfully.');
    }

    public function sudah_baca(Request $request) {
        $user = auth()->user();
        $user_id = $user->id;
        $user_name = $user->name;
        $materi_id = $request->materi_id;

        $materi = PalestineDay::find($materi_id);
        
        $get_jenjang = $materi->jenjang;

        if ($get_jenjang == 2) {
            $jenjang = 'UBRSMP';

            $data = Profile::select('m_profile.nis')
                            ->leftJoin('t_sudah_baca_materi as tsbm', 'tsbm.user_id', 'm_profile.user_id')
                            ->leftJoin('m_palestine_day as mpd', 'mpd.id', 'tsbm.materi_id')
                            ->where('m_profile.user_id', $user_id)
                            ->where('m_profile.sekolah_id', 'UBRSMP')
                            ->groupby('m_profile.user_id', 'm_profile.nis', 'tsbm.materi_id')
                            ->get();
            
            
            foreach ($data as $item) {
                $store_have_read = HaveRead::create([
                    'user_id' => $user_id,
                    'user_name' => $user_name,
                    'nis' => $item['nis'],
                    'materi_id' => $materi_id,
                ]);
            }
            return response()->json($store_have_read);

        } else {
            $data = Profile::select('m_profile.nis')
                            ->leftJoin('t_sudah_baca_materi as tsbm', 'tsbm.user_id', 'm_profile.user_id')
                            ->leftJoin('m_palestine_day as mpd', 'mpd.id', 'tsbm.materi_id')
                            ->where('m_profile.user_id', $user_id)
                            ->where('m_profile.sekolah_id', '!=', 'UBRSMP')
                            ->groupby('m_profile.user_id', 'm_profile.nis', 'tsbm.materi_id')
                            ->get();

            foreach ($data as $item) {
                $store_have_read = HaveRead::create([
                    'user_id' => $user_id,
                    'user_name' => $user_name,
                    'nis' => $item['nis'],
                    'materi_id' => $materi_id,
                ]);
            }
            return response()->json($store_have_read);
        }

    }

    public function list_sudah_baca()
    {
        $haveRead = HaveRead::select('t_sudah_baca_materi.materi_id', 't_sudah_baca_materi.created_at', 'mpro.nis', 'mpro.nama_lengkap', 'mls.sublokasi as lokasi', 'mpro.nama_kelas', 'mpd.judul', )
                            ->leftJoin('m_palestine_day as mpd', 'mpd.id', 't_sudah_baca_materi.materi_id')
                            ->leftJoin('m_profile as mpro', 'mpro.nis', 't_sudah_baca_materi.nis')
                            ->leftJoin('mst_lokasi_sub as mls', 'mpro.sekolah_id', 'mls.id')
                            ->groupby('t_sudah_baca_materi.materi_id', 't_sudah_baca_materi.nis')
                            ->orderby('t_sudah_baca_materi.created_at', 'Desc')
                            ->get();

        return view('admin.master.palestineday.sudahbaca', compact('haveRead'));
    }

    public function export_have_read()
    {
        $now = date('d-m-y');
        $file_name = 'haveread-'.$now.'.xlsx';
        return Excel::download(new HaveReadList(), $file_name);
    }

    public function merchandise()
    {
        $user_id = Auth::user()->id;
        $user_nohp = Auth::user()->no_hp;
        $data_nis = Profile::where('no_hp_ibu', $user_nohp)->get();

        foreach ($data_nis as $item) {
            $get_nis = $item->nis;
            
            $list_karya = DesainPalestineday::where('nis', $get_nis)->orderby('created_at', 'desc')->get();
        }

        $merch_kaos = Merchandise::where('jenis_id', '1')->first();
        $get_merch = Merchandise::where('jenis_id', '!=', '1')->get();
        $cart_detail = CartMerchandise::select('t_cart_merchandise.quantity', 't_cart_merchandise.id', 't_cart_merchandise.merchandise_id', 't_cart_merchandise.is_selected', 
                        'mwk.warna', 'mus.ukuran_seragam', 't_cart_merchandise.lengan_id', 'mm.nama_produk', 'mm.harga_awal', 'mm.diskon', 'mm.image_1', 'mm.image_2', 
                        'tdp.nama_siswa', 'tdp.sekolah_id',  'tdp.nama_kelas', 'tdp.image_file' )
                        ->leftJoin('m_merchandise as mm', 'mm.id', 't_cart_merchandise.merchandise_id')
                        ->leftJoin('t_desain_palestineday as tdp', 'tdp.id', 't_cart_merchandise.design_id')
                        ->leftJoin('m_warna_kaos as mwk', 'mwk.id', 't_cart_merchandise.warna_id')
                        ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_merchandise.ukuran_id')
                        ->where('t_cart_merchandise.user_id', $user_id)
                        ->where('t_cart_merchandise.status_cart', 0)
                        ->get();

        
        return view('ortu.palestine_day.merchandise', compact('get_nis', 'list_karya', 'get_merch', 'merch_kaos', 'cart_detail'));
    }

    public function detail_merchandise($id) 
    {
        $no_hp = auth()->user()->no_hp;
        $profile = Profile::get_user_profile_byphone($no_hp);
        $merchandise = Merchandise::where('id', $id)->first();

        $cart_detail = CartMerchandise::all();

        return view('ortu.palestine_day.detail-merchandise', compact('merchandise', 'cart_detail', 'profile'));
    }

    public function detail_merchandise_kaos($id) 
    {
        $no_hp = auth()->user()->no_hp;
        $profile = Profile::get_user_profile_byphone($no_hp);
        $merchandise_kaos = DesainPalestineday::where('id', $id)->first();
        $detail_kaos = Merchandise::where('jenis_id', 1)->first();
        $ukuran = UkuranSeragam::whereNotIn('ukuran_seragam', ['ALL', 'XXS'])->get();
        $warna_kaos = WarnaKaos::all();

        // dd($merchandise_kaos, $detail_kaos);

        $cart_detail = CartMerchandise::all();

        return view('ortu.palestine_day.detail-kaos', compact('merchandise_kaos', 'cart_detail', 'profile', 'detail_kaos', 'ukuran', 'warna_kaos'));
    }

    public function add_to_cart(Request $request)
    {
        $merchandise_id = $request->merchandise_id;
        $design_id = $request->design_id;
        $ukuran_id = $request->ukuran_id;
        $warna_id = $request->warna_id;
        $lengan_id = $request->lengan_id;
        $quantity = $request->quantity;
        $user_id = auth()->user()->id;

        $add_cart_detail =  CartMerchandise::create([
            'merchandise_id' => $merchandise_id,
            'user_id' => $user_id,
            'quantity' => $quantity,
            'design_id' => $design_id,
            'ukuran_id' => $ukuran_id,
            'warna_id' => $warna_id,
            'lengan_id' => $lengan_id
        ]);
    
        return response()->json($add_cart_detail);

    }

    public function cart(Request $request)
    {
        $user_id = auth()->user()->id;

        $profile = Profile::where('user_id', $user_id)->get();

        $cart_detail = CartMerchandise::select('t_cart_merchandise.quantity', 't_cart_merchandise.id', 't_cart_merchandise.merchandise_id', 't_cart_merchandise.is_selected', 
                        'mwk.warna', 'mus.ukuran_seragam', 't_cart_merchandise.lengan_id', 'mm.nama_produk', 'mm.harga_awal', 'mm.diskon', 'mm.image_1', 'mm.image_2', 
                        'tdp.nama_siswa', 'tdp.sekolah_id',  'tdp.nama_kelas', 'tdp.image_file' )
                        ->leftJoin('m_merchandise as mm', 'mm.id', 't_cart_merchandise.merchandise_id')
                        ->leftJoin('t_desain_palestineday as tdp', 'tdp.id', 't_cart_merchandise.design_id')
                        ->leftJoin('m_warna_kaos as mwk', 'mwk.id', 't_cart_merchandise.warna_id')
                        ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_merchandise.ukuran_id')
                        ->where('t_cart_merchandise.user_id', $user_id)
                        ->where('t_cart_merchandise.status_cart', 0)
                        ->get();

        $ukuran = UkuranSeragam::whereNotIn('ukuran_seragam', ['ALL', 'XXS'])->get();

        $total_bayar = CartMerchandise::select('t_cart_merchandise.quantity', 't_cart_merchandise.id', 't_cart_merchandise.is_selected', 
                        'mm.nama_produk', 'mm.harga_awal', 'mm.diskon', 'mm.image_1', 'mm.image_2' )
                        ->leftJoin('m_merchandise as mm', 'mm.id', 't_cart_merchandise.merchandise_id')
                        ->where('t_cart_merchandise.user_id', $user_id)
                        ->where('t_cart_merchandise.status_cart', 0)
                        ->where('t_cart_merchandise.is_selected', 1)
                        ->get();
        // dd($total_bayar);

        $total_bayar_selected = 0;
        foreach ($total_bayar as $item) {
            $quantity = $item->quantity;
            $harga = $item->harga_awal * $quantity;
            $diskon = $item->diskon;
            $nilai_diskon = ($diskon/100 * $harga);

            $total_harga = $harga - $nilai_diskon;

            $total_bayar_selected += $total_harga;
        }


        return view('ortu.palestine_day.cart', compact('profile', 'cart_detail', 'total_bayar_selected', 'ukuran'));
    }

    public function update_cart(Request $request, $id) 
    {
        // return response()->json($id);
        $quantity = $request->quantity;
        $is_selected = $request->is_selected;
        $cart_detail = CartMerchandise::where('id', $id)->update([
            'quantity' => $quantity,
            'is_selected' => $is_selected
        ]);


        return response()->json($cart_detail);
    }

    public function update_select_cart(Request $request, $id) 
    {
        // return response($id);
        $is_selected = $request->is_selected;
        $cart_detail = CartMerchandise::where('id', $id)->update([
            'is_selected' => $is_selected
        ]);


        return response()->json($cart_detail);
    }

    public function select_all_cart(Request $request) 
    {
        $user_id = auth()->user()->id;

        if ( isset( $request->checks ) && isset( $request->ids ) ) { 
            $checks = explode( ",", $request->checks ); 
            $ids    = explode( ",", $request->ids ); 
         
            foreach ($checks as $check) {
                foreach ($ids as $id) {
                    $select_all = CartMerchandise::where('id', $id)->update([
                            'is_selected' => $check
                    ]);                    
                }
                $total_bayar = CartMerchandise::select('mm.*', 't_cart_merchandise.quantity')
                                ->leftJoin('m_merchandise as mm', 'mm.id', 't_cart_merchandise.merchandise_id')
                                ->where('t_cart_merchandise.user_id', $user_id)
                                ->where('t_cart_merchandise.status_cart', 0)
                                ->where('t_cart_merchandise.is_selected', 1)
                                ->get();
                                
                $total_bayar_selected = 0;

                foreach ($total_bayar as $item) {
                    $quantity = $item->quantity;
                    $harga = $item->harga_awal * $quantity;
                    $diskon = $item->diskon;
                    $nilai_diskon = ($diskon/100 * $harga);

                    $total_harga = $harga - $nilai_diskon;

                    $total_bayar_selected += $total_harga;
                }
                return response()->json($total_bayar_selected);
            }
        }
    }

    public function remove_cart($id) 
    {
        CartMerchandise::find($id)->delete();

        return redirect()->route('merchandise.cart')
            ->with('error', 'Remove from cart successfully');
    }

    public function pembayaran(Request $request)
    {

        $user_id = auth()->user()->id;

        $order = $request->all();
        
        $profile = Profile::where('user_id', $user_id)->get();
        $cart_detail =  CartMerchandise::select('t_cart_merchandise.quantity', 't_cart_merchandise.id', 't_cart_merchandise.merchandise_id', 't_cart_merchandise.is_selected', 
                            'mwk.warna', 'mus.ukuran_seragam', 't_cart_merchandise.lengan_id', 'mm.nama_produk', 'mm.harga_awal', 'mm.diskon', 'mm.image_1', 'mm.image_2', 
                            'tdp.image_file', 'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas', 'mp.sekolah_id' )
                            ->leftJoin('m_merchandise as mm', 'mm.id', 't_cart_merchandise.merchandise_id')
                            ->leftJoin('t_desain_palestineday as tdp', 'tdp.id', 't_cart_merchandise.design_id')
                            ->leftJoin('m_warna_kaos as mwk', 'mwk.id', 't_cart_merchandise.warna_id')
                            ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_merchandise.ukuran_id')
                            ->leftJoin('m_profile as mp', 'mp.user_id', 't_cart_merchandise.user_id')
                            ->where('t_cart_merchandise.user_id', $user_id)
                            ->where('t_cart_merchandise.status_cart', 0)
                            ->where('t_cart_merchandise.is_selected', 1)
                            ->groupby('t_cart_merchandise.id')
                            ->get();

        return view('ortu.palestine_day.pembayaran', compact('profile', 'cart_detail', 'order'));

    }

    public function pre_order(Request $request)
    {
        
        $order = $request->all();
        $order_dec = json_decode($order['data'], true);
    
        $merch_id = $order_dec[0]['merch_id'];
        $quantity = $order_dec[0]['quantity'];
      

        if ($merch_id != 1) {
            $merchandise = Merchandise::find($merch_id);

            return view('ortu.palestine_day.pembayaran', compact( 'merchandise', 'quantity', 'merch_id', 'order'));

        } else {
            $design_id = $order_dec[0]['design_id'];
            $ukuran = $order_dec[0]['ukuran'];
            $lengan = $order_dec[0]['lengan'];
            if ($lengan == 1) {
                $jenis_lengan = 'Pendek';
            } else if ($lengan == 2) {
                $jenis_lengan = 'Panjang';
            }
            $warna_id = $order_dec[0]['warna'];

            $get_warna = WarnaKaos::where('id', $warna_id)->first();
            $warna = $get_warna->warna;

            $merchandise =  Merchandise::find($merch_id);
            $design = DesainPalestineday::find($design_id);
            
            return view('ortu.palestine_day.pembayaran', compact('order', 'merchandise', 'design', 'quantity', 'ukuran', 'warna', 'design_id', 'merch_id', 'jenis_lengan'));
        }

    }

    public function store_order(Request $request)
    {
        $user_id = auth()->user()->id;
        $no_hp = auth()->user()->no_hp;
        $nama_pemesan = auth()->user()->name;
        $no_pesanan = 'INV-MPD-'. date('YmdHis');

        $order = CartMerchandise::select('t_cart_merchandise.quantity', 't_cart_merchandise.id', 't_cart_merchandise.merchandise_id', 't_cart_merchandise.is_selected', 
                                'mwk.id as warna_id', 'mus.ukuran_seragam', 'mus.id as ukuran_id', 't_cart_merchandise.lengan_id', 'mm.nama_produk', 'mm.harga_awal', 'mm.diskon', 'mm.image_1', 'mm.image_2', 
                                'mp.nama_lengkap as nama_siswa', 'mp.nama_kelas', 'mp.sekolah_id', 'tdp.image_file' )
                                ->leftJoin('m_merchandise as mm', 'mm.id', 't_cart_merchandise.merchandise_id')
                                ->leftJoin('t_desain_palestineday as tdp', 'tdp.id', 't_cart_merchandise.design_id')
                                ->leftJoin('m_warna_kaos as mwk', 'mwk.id', 't_cart_merchandise.warna_id')
                                ->leftJoin('m_ukuran_seragam as mus', 'mus.ukuran_seragam', 't_cart_merchandise.ukuran_id')
                                ->leftJoin('m_profile as mp', 'mp.user_id', 't_cart_merchandise.user_id')
                                ->where('t_cart_merchandise.user_id', $user_id)
                                ->where('t_cart_merchandise.status_cart', 0)
                                ->where('t_cart_merchandise.is_selected', 1)
                                ->groupby('t_cart_merchandise.id')
                                ->get();

        $total_harga = 0;
        $total_diskon =0;
        foreach ($order as $item) {
            $nama_siswa = $item['nama_siswa'];
            $lokasi = $item['sekolah'];
            $nama_kelas = $item['nama_kelas'];
            $merchandise_id = $item['merchandise_id'];
            $ukuran = $item['ukuran_id'];
            $warna = $item['warna_id'];
            $quantity = $item['quantity'];
            $harga_awal = $item['harga_awal'];
            $diskon = $item['diskon'];
            $nilai_diskon = $diskon/100 * $harga_awal * $quantity;


            $order_detail = OrderDetailMerchandise::create([
            'no_pesanan' => $no_pesanan,
            'nama_siswa' => $nama_siswa,
            'lokasi_sekolah' => $lokasi,
            'nama_kelas' => $nama_kelas,
            'merchandise_id' => $merchandise_id,
            'ukuran_id' => $ukuran,
            'warna_id' => $warna,
            'quantity' => $quantity,
            'harga' => $harga_awal,
            'persen_diskon' => $diskon,
            ]);

            $total_harga += $harga_awal * $quantity;
            $total_diskon += $nilai_diskon;
            $harga_akhir = $total_harga - $total_diskon;
            $harga_akhir_format = number_format($harga_akhir);

            $this->update_cart_status($user_id, $merchandise_id);
        }

            $order_merchandise = OrderMerchandise::create([
                'no_pesanan' => $no_pesanan,
                'no_hp' => $no_hp,
                'nama_pemesan' => $nama_pemesan,
                'status' => 'pending',
                'total_harga' => $harga_akhir,
                'user_id' => $user_id
            ]);

             // Set your Merchant Server Key
             \Midtrans\Config::$serverKey = config('midtrans.serverKey');
             // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
             \Midtrans\Config::$isProduction = config('midtrans.isProduction');
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
             $order_merchandise->snap_token = $snapToken;
             $order_merchandise->save();
 
             return response()->json($order_merchandise);
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

        if ($paymentType == 'shopeepay' || $paymentType == 'gopay' || $paymentType == 'qris') {
            $mtd_pembayaran = $paymentType;
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
        $order = OrderMerchandise::where('no_pesanan', $orderId)->first();
       
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

         $order_detail = OrderDetailMerchandise::where('no_pesanan', $orderId)->get();

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
                foreach ($order_detail as $item) {
                    $kode_produk = $item->kode_produk;
                    $quantity = $item->quantity;

                };
                $this->update_status_seragam('success', $mtd_pembayaran, $orderId);
                break;
            case 'pending':
                $order->update([
                    'status' => 'pending',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va,
                    'expire_time' => $request->expiry_time
                ]);
                foreach ($order_detail as $item) {
                    $kode_produk = $item->kode_produk;
                    $quantity = $item->quantity;
                }
                $this->update_status_seragam('pending', $mtd_pembayaran, $orderId);
                break;
            case 'deny':
                $order->update([
                    'status' => 'failed',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va
                ]);
                foreach ($order_detail as $item) {
                    $kode_produk = $item->kode_produk;
                    $quantity = $item->quantity;
                }
                break;
            case 'expire':
                $order->update([
                    'status' => 'expired',
                    'metode_pembayaran' => $mtd_pembayaran,
                    'va_number' => $no_va
                ]);
                // foreach ($order_detail as $item) {
                //     $kode_produk = $item->kode_produk;
                //     $quantity = $item->quantity;

                // }
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

    public function update_cart_status($user_id, $merch_id) 
    {
        $cart_detail = CartMerchandise::where('user_id', $user_id)
                ->where('status_cart', 0)
                ->where('merchandise_id', $merch_id)
                ->where('is_selected', 1)
                ->first();
        
        $update_status_cart = $cart_detail->update([
            'status_cart' => 1
        ]);

        return response()->json($update_status_cart);
    }

}
