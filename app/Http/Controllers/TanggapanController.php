<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function reply(Request $request, $pengaduanId)
    {
        $request->validate([
            'isi' => 'required',
        ]);

        $pengaduan = Pengaduan::findOrFail($pengaduanId);
        $tanggapan = new Tanggapan([
            'isi' => $request->input('isi'),
        ]);

        $pengaduan->tanggapan()->save($tanggapan);
        if ($pengaduan->status !== 'Selesai') {
            if ($pengaduan->status === 'Proses') {
                $pengaduan->update(['status' => 'Selesai']);
            } else {
                $pengaduan->update(['status' => 'Proses']);
            }
        }
        return redirect('/pengaduan')->with('success_message', 'Tanggapan berhasil ditambahkan.')->with('success', true);
    }

    public function showTanggapan(Tanggapan $tanggapan)
    {
        $tanggapan = Tanggapan::all();
        $active = 'tanggapan';
        return view('admin.tanggapan', compact('tanggapan', 'active'));
    }

    public function tanggapanDestroy($id)
    {

        $tanggapan = Tanggapan::findOrFail($id);
        $pengaduan = $tanggapan->pengaduan;
        $pengaduan->update(['Status' => "Proses"]);
        $tanggapan->delete();

        return redirect('/tanggapan');
    }
}
