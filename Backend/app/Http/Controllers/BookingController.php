<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan; // Import model Ruangan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\Auth;
use Throwable;

class BookingController extends Controller
{
    // Jadwal View
    public function jadwal()
    {
        // Pastikan user login
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Ambil booking approved
        $bookings = Booking::where('status', 'approved')->get();

        // Ambil role user
        $role = Auth::user()->role;

        return match ($role) {
            'admin'    => view('admin.jadwal', compact('bookings')),
            'approver' => view('approver.ajadwal', compact('bookings')),
            'user'     => view('user.ujadwal', compact('bookings')),
            default    => abort(403, 'Role tidak diizinkan'),
        };
    }

    // Form booking ruangan
    public function showBookingForm($id)
    {
        // Ambil data ruangan berdasarkan ID
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.formbooking', compact('ruangan'));
    }
public function storeBookingForm(Request $request)
{
    DB::listen(function ($query) {
        Log::info('SQL Query', [
            'sql' => $query->sql,
            'bindings' => $query->bindings,
            'time' => $query->time
        ]);
    });

    Log::info('📥 Data masuk ke storeBookingForm', ['request' => $request->all()]);

    $request->validate([
        'ruangan_id' => 'required|exists:ruangans,id',
        'nama_pemesan' => 'required|string',
        'divisi' => 'required|string',
        'event' => 'required|string',
        'tanggal' => 'required|date',
        'jam_mulai' => 'required',
        'jam_selesai' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                $start = strtotime($request->jam_mulai);
                $end = strtotime($value);

                // Kalau jam selesai lebih kecil → diasumsikan lewat tengah malam
                if ($end <= $start) {
                    $end = strtotime($value . ' +1 day');
                }

                // Log waktu untuk debug
                Log::info('⏱ Validasi Jam', [
                    'jam_mulai' => date('Y-m-d H:i:s', $start),
                    'jam_selesai' => date('Y-m-d H:i:s', $end),
                    'selisih_detik' => $end - $start
                ]);

                if ($end <= $start) {
                    $fail('Jam selesai harus lebih besar dari jam mulai.');
                }
            }
        ],
    ]);

    Log::info('✅ Validasi sukses');

    // 🔥 Cek bentrok jadwal
    $conflict = Booking::where('ruangan_id', $request->ruangan_id)
        ->where('tanggal', $request->tanggal)
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            });
        })
        ->exists();

    if ($conflict) {
        return redirect()->route('ruangan.index')->with('errorconflict', '❌ Jadwal bentrok! Ruangan sudah terbooking pada jam tersebut.');
    }


    try {
        Booking::create([
            'ruangan_id'   => $request->ruangan_id,
            'nama_pemesan' => $request->nama_pemesan,
            'divisi'       => $request->divisi,
            'event'        => $request->event,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'status'       => 'Waiting Approval',
        ]);

        // 🔥 Log activity
        $details = sprintf(
            "Booking berhasil: Ruangan #%s | Pemesan: %s | Divisi: %s | Event: %s | Tanggal: %s | Waktu: %s - %s",
            $request->ruangan_id,
            $request->nama_pemesan,
            $request->divisi,
            $request->event,
            $request->tanggal,
            $request->jam_mulai,
            $request->jam_selesai
        );

        ActivityLogHelper::add('Successful Booking', $details);


        return redirect()->route('ruangan.index')->with('success', 'Booking berhasil dibuat!');
    } catch (\Exception $e) {
        Log::error('❌ Gagal simpan booking', ['error' => $e->getMessage()]);

        // Kirim pesan error untuk SweetAlert
        return redirect()->route('ruangan.booking.form')->with('error', 'Gagal membuat booking: ' . $e->getMessage());
    }
    }
public function waitingApproval()
{
    // Ambil Semua booking yang statusnya waiting approval
    $bookings = Booking::where('status','waiting approval')->get();

    // Tampilkan dalam view
    return view('admin.req', compact('bookings'));
}

public function approve($id)
{
    $booking = Booking::findOrFail($id);
    $booking->update(['status' => 'approved']);

    // 🔥 Tambahkan log activity
    $details = sprintf(
        "Booking #%s untuk ruangan %s telah di-approve. Pemesan: %s, Event: %s, Tanggal: %s, Jam: %s - %s",
        $booking->id,
        $booking->nama_ruangan,
        $booking->ruangan_id,
        $booking->nama_pemesan,
        $booking->event,
        $booking->tanggal,
        $booking->jam_mulai,
        $booking->jam_selesai
    );

    ActivityLogHelper::add('Booking Approved', $details);

    return back()->with('success', 'Booking berhasil di-approve');
}

public function reject($id)
{
    $booking = Booking::findOrFail($id);
    $booking->update(['status' => 'rejected']);

    // 🔥 Tambahkan log activity
    $details = sprintf(
        "Booking #%s untuk ruangan %s telah di-reject. Pemesan: %s, Event: %s, Tanggal: %s, Jam: %s - %s",
        $booking->id,
        $booking->nama_ruangan,
        $booking->ruangan_id,
        $booking->nama_pemesan,
        $booking->event,
        $booking->tanggal,
        $booking->jam_mulai,
        $booking->jam_selesai
    );

    ActivityLogHelper::add('Booking Rejected', $details);

    return back()->with('success', 'Booking berhasil di-reject');
}

public function getApprovedBookings()
{
    $bookings = Booking::join('ruangans', 'bookings.ruangan_id', '=', 'ruangans.id')
        ->where('bookings.status', 'approved')
        ->select(
            'bookings.event',
            'bookings.nama_pemesan',
            'bookings.divisi',
            'bookings.tanggal',
            'bookings.jam_mulai',
            'bookings.jam_selesai',
            'ruangans.nama_ruangan' // << tambah ini
        )
        ->get();

    return response()->json($bookings);
}

// public function getApprovedBookings()
// {
//     $bookings = Booking::where('status', 'approved')
//         ->select('event', 'nama_pemesan', 'divisi', 'tanggal', 'jam_mulai', 'jam_selesai')
//         ->get();

//     return response()->json($bookings);
// }


}
