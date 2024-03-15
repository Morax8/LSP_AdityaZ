<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $lastPengaduan = Pengaduan::latest()->first();
        $nextId = $lastPengaduan ? $lastPengaduan->id + 1 : 1;
        $idSearch = $request->input('search');
        $tujuanSearch = $request->input('id_kategori');
        $activeSearch = $request->input('status');
        $search_date = $request->input('tanggal');
        
    
        $pengaduan = Pengaduan::query()
            ->when($idSearch, function ($query) use ($idSearch) {
                return $query->where('id', $idSearch);
            })->when($tujuanSearch, function ($query) use ($tujuanSearch) {
                return $query->where('id_kategori', $tujuanSearch);
            })->when(isset($activeSearch), function ($query) use ($activeSearch) {
                return $query->where('status', (bool) $activeSearch);
            })->when($search_date, function ($query) use ($search_date) {
                return $query->where('tanggal', $search_date);
            })->latest()->get();


        return view('home', ['nextId' => $nextId,'request' => $request ], compact('pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama' => 'required',
            'NIS' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required',
            'Keterangan' => 'required',
            'gambar' => 'required|image',
            'status' => 'nullable|in:Menunggu,Proses,Selesai',
        ]);

    // dd($request->all());
        
        try {
            $input = $request->all();
        
            if ($image = $request->file('gambar')) {
                $imageName = $request->input('nama') . '_' . now()->format('Y-m-d') . '.' . $image->getClientOriginalExtension();
                $newPath = public_path('images/pengaduan');
                $image->move($newPath, $imageName);
                $input['gambar'] = $imageName;
            }
            $input['status'] = 'Menunggu'; 
        // dd($input);
            Pengaduan::create($input);
            
            return redirect('/')->with('success_message', 'Pengaduan Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Handle any exceptions here
            return back()->with(['error_message' => 'Format Data Tidak Sesuai']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function showCMS(Pengaduan $pengaduan, Request $request)
    {
        $idSearch = $request->input('search');
        $tujuanSearch = $request->input('id_kategori');
        $activeSearch = $request->input('status');
        $search_date = $request->input('tanggal');
        
    
        $pengaduan = Pengaduan::query()
            ->when($idSearch, function ($query) use ($idSearch) {
                return $query->where('id', $idSearch);
            })->when($tujuanSearch, function ($query) use ($tujuanSearch) {
                return $query->where('id_kategori', $tujuanSearch);
            })->when(isset($activeSearch), function ($query) use ($activeSearch) {
                return $query->where('status', (bool) $activeSearch);
            })->when($search_date, function ($query) use ($search_date) {
                return $query->where('tanggal', $search_date);
            })->latest()->get();

        $active = 'table';

        return view('admin.pengaduan',['request' => $request], compact('pengaduan', 'active'));
    }

    public function Dashboard(pengaduan $pengaduan, Request $request)
    {
        $idSearch = $request->input('search');
        $tujuanSearch = $request->input('id_kategori');
        $activeSearch = $request->input('status');
        $search_date = $request->input('tanggal');
        
    
        $pengaduan = Pengaduan::query()
            ->when($idSearch, function ($query) use ($idSearch) {
                return $query->where('id', $idSearch);
            })->when($tujuanSearch, function ($query) use ($tujuanSearch) {
                return $query->where('id_kategori', $tujuanSearch);
            })->when(isset($activeSearch), function ($query) use ($activeSearch) {
                return $query->where('status', (bool) $activeSearch);
            })->when($search_date, function ($query) use ($search_date) {
                return $query->where('tanggal', $search_date);
            })->latest()->get();

        $active = 'dashboard';
        return view('admin.dashboard',['request' => $request], compact('pengaduan', 'active'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        pengaduan::findorfail($id)->delete();
        return redirect('/pengaduan');
    }
}
