<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function create()
    {
        $dokters = User::where('role', 'dokter')->get(); // Sesuaikan jika nama rolenya beda
        return view('pasien.periksa', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date|after_or_equal:now',
            'catatan' => 'nullable|string',
        ]);

        Periksa::create([
            'id_pasien' => auth()->id(),
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => 0, // default, bisa diisi nanti
        ]);

        return redirect()->route('pasien.riwayat')->with('success', 'Janji berhasil dibuat!');
    }

    public function index()
    {
        $records = Periksa::with(['dokter', 'detailPeriksas.obat'])
        ->where('id_pasien', auth()->id())
        ->latest()
        ->get();

        return view('pasien.riwayat', compact('records'));
    }
}
