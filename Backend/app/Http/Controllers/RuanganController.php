<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Booking;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RuanganController extends Controller
{
    // Tampilkan Semua Ruangan Dari Database
    public function index()
    {
        $ruangans = Ruangan::all(); // ambil semua data dari tabel ruangan
        return view('admin.ruangan-meeting', compact('ruangans'));
    }

    // Form tambah Ruangan
    public function create()
    {
        return view('admin.form-tambahruang');
    }

    // Simpan Ruangan Baru
    public function storeRuangan(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'lokasi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('ruangan', 'public');
        }

        Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
            'lokasi' => $request->lokasi,
            'deskripsi'    => $request->deskripsi ?? '', // default kosong
            'foto' => $fotoPath,
        ]);

        // Tambahkan log activity
        ActivityLogHelper::add(
        'Membuat Ruangan',
        'Nama: ' . $request->nama_ruangan . 
        ', Kapasitas: ' . $request->kapasitas . 
        ', Lokasi: ' . $request->lokasi
    );

        return redirect()->route('ruangan.index')->with('successcreate', 'Ruangan berhasil ditambahkan.');
    }

    // Form edit ruangan
    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.form-editruang', compact('ruangan'));
    }

    // Update ruangan
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required|integer',
            'lokasi' => 'required',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($ruangan->foto) {
                Storage::disk('public')->delete($ruangan->foto);
            }
            $ruangan->foto = $request->file('foto')->store('ruangan', 'public');
        }
        $ruangan->update([
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas' => $request->kapasitas,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('ruangan.index')->with('editsuccess', 'Data ruangan diperbarui.');
    }

    public function destroy($id)
{
    $ruangan = Ruangan::findOrFail($id);

    // Hapus foto dari storage kalau ada
    if ($ruangan->foto) {
        Storage::disk('public')->delete($ruangan->foto);
    }

    // Hapus data ruangan
    $ruangan->delete();

    return redirect()->route('ruangan.index')->with('deletesuccess', 'Data ruangan berhasil dihapus.');
}

}

?>