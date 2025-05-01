<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;

class MemeriksaController extends Controller
{
    public function index()
    {
        $records = Periksa::with('pasien')
            ->where('id_dokter', auth()->id())
            ->get();

        return view('dokter.memeriksa.memeriksa', compact('records'));
    }

    public function edit($id)
    {
        $periksa = Periksa::with('pasien')->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.memeriksa.tambah_pemeriksaan_pasien', compact('periksa', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'biaya_periksa' => 'required|numeric|min:0',
            'obats' => 'required|array|min:1',
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'biaya_periksa' => $request->biaya_periksa
        ]);

        // Hapus dulu jika ada obat sebelumnya
        DetailPeriksa::where('id_periksa', $id)->delete();

        foreach ($request->obats as $obat_id) {
            DetailPeriksa::create([
                'id_periksa' => $id,
                'id_obat' => $obat_id,
            ]);
        }

        return redirect()->route('dokter.periksa')->with('success', 'Pemeriksaan berhasil diperbarui.');
    }
}
