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
use Throwable;

class BookingController extends Controller
{
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

public function jadwal()
{
    // Ambil semua booking yang statusnya approved
    $bookings = Booking::where('status', 'approved')->get();

    // Kirim ke view jadwal.blade.php
    return view('admin.jadwal', compact('bookings'));
}

public function getApprovedBookings()
{
    $bookings = Booking::where('status', 'approved')
        ->select('event', 'nama_pemesan', 'divisi', 'tanggal', 'jam_mulai', 'jam_selesai')
        ->get();

    return response()->json($bookings);
}


}
