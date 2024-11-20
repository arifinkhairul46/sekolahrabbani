<?php

namespace App\Http\Controllers;

use App\Exports\HaveReadList;
use App\Models\HaveRead;
use App\Models\PalestineDay;
use App\Models\Profile;
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
                            ->get();
            // return response()->json($data);
            
            
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
                            ->get();

        return view('admin.master.palestineday.sudahbaca', compact('haveRead'));
    }

    public function export_have_read()
    {
        $now = date('d-m-y');
        $file_name = 'haveread-'.$now.'.xlsx';
        return Excel::download(new HaveReadList(), $file_name);
    }
}
