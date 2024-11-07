<?php

namespace App\Http\Controllers;

use App\Models\HaveRead;
use App\Models\PalestineDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PalestineDayController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        return view('ortu.palestine_day.index');
        
    }

    public function materi_tk()
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::where('jenjang', 1)->get();
        // dd($materi);

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
        // dd($sudah_baca);
        
        return view('ortu.palestine_day.materi-by-id', compact('file', 'materi', 'sudah_baca'));
        
    }

    public function materi_smp()
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::where('jenjang', 2)->get();

        return view('ortu.palestine_day.materi-smp', compact('materi'));
        
    }

    public function materi_smp_by_id($id)
    {
        $user_id = Auth::user()->id;

        $materi = PalestineDay::find($id);

        $file = public_path('storage/'.$materi->file);
        
        return view('ortu.palestine_day.materi-smp-by-id', compact('file', 'materi'));
        
    }

    public function master_materi()
    {
        $materi_tksd = PalestineDay::where('jenjang', 1)->get();
        $materi_smp = PalestineDay::where('jenjang', 2)->get();
        return view('admin.master.palestineday.index', compact('materi_tksd', 'materi_smp'));
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
            return redirect()->back()->with('failed', 'File tidak boleh kosong');
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

        $store_have_read = HaveRead::create([
            'user_id' => $user_id,
            'user_name' => $user_name,
            'materi_id' => $materi_id,
        ]);

        return response()->json($store_have_read);
    }

    public function list_sudah_baca()
    {
        $haveRead = HaveRead::select('t_sudah_baca_materi.materi_id', 'mpro.nis', 'mpro.nama_lengkap', 'mls.sublokasi as lokasi', 'mpd.judul')
                            ->leftJoin('m_palestine_day as mpd', 'mpd.id', 't_sudah_baca_materi.materi_id')
                            ->leftJoin('m_profile as mpro', 'mpro.user_id', 't_sudah_baca_materi.user_id')
                            ->leftJoin('mst_lokasi_sub as mls', 'mpro.sekolah_id', 'mls.id')
                            ->groupby('t_sudah_baca_materi.materi_id', 't_sudah_baca_materi.user_id')
                            ->get();
        // dd($haveRead);
        return view('admin.master.palestineday.sudahbaca', compact('haveRead'));
    }
}
