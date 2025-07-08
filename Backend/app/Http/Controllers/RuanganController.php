<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    // Tampilkan Semua Ruangan Dari Database
    public function index()
    {
        $ruangans = Ruangan::all(); // ambil semua data dari tabel ruangan
        return view('ruangan-meeting', compact('ruangans'));
    }

    // Form tambah Ruangan
    public function create()
    {
        return view('form-tambahruang');
    }

    // Simpan Ruangan Baru
    public function store(Request $request)
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
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    // Form edit ruangan
    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('form-editruang', compact('ruangan'));
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

        return redirect()->route('ruangan.index')->with('success', 'Data ruangan diperbarui.');
    }

    // Form booking ruangan
    public function showBookingForm($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('formbooking', compact('ruangan'));
    }

    // Simpan booking
    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'nama_pemesan' => 'required|string',
        ]);

        Booking::create([
            'ruangan_id' => $id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'nama_pemesan' => $request->nama_pemesan,
        ]);

        return redirect()->route('ruangan.index')->with('success', 'Booking berhasil disimpan.');
    }
}

?>