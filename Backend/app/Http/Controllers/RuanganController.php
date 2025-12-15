<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Ruangan;
    use App\Models\Booking;
    use App\Helpers\ActivityLogHelper;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Auth;


    class RuanganController extends Controller
    {
        // Tampilkan Semua Ruangan Dari Database
        public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $ruangans = Ruangan::all();
        // dd($user->role);
        return match ($user->role) {
            'admin'    => view('admin.ruangan-meeting', compact('ruangans')),
            'user'     => view('user.uruangan-meeting', compact('ruangans')),
            default    => abort(403, 'Role tidak diizinkan'),
        };
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

        $ruangan=Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas' => $request->kapasitas,
            'fasilitas' => $request->fasilitas,
            'lokasi' => $request->lokasi,
            'deskripsi'    => $request->deskripsi ?? '', // default kosong
            'foto' => $fotoPath,
        ]);

        // Tambahkan log activity
        ActivityLogHelper::add(
        'Adding Ruangan',
        'Nama: ' . $ruangan->nama_ruangan . 
        ', Kapasitas: ' . $ruangan->kapasitas . 
        ', Lokasi: ' . $ruangan->lokasi
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

        // 🔥 Log activity
        ActivityLogHelper::add(
        'Update Ruangan',
        "ID: {$ruangan->id}, Nama: {$ruangan->nama_ruangan}, Kapasitas: {$ruangan->kapasitas}, Lokasi: {$ruangan->lokasi}"
        );

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

    // 🔥 Log activity
    ActivityLogHelper::add(
    'Hapus Ruangan',
    "ID: {$id}, Nama: {$ruangan->nama_ruangan}, Lokasi: {$ruangan->lokasi}"
    );

    return redirect()->route('ruangan.index')->with('deletesuccess', 'Data ruangan berhasil dihapus.');
}

}

?>