@extends('layouts.booking')

@section('title', 'Form Booking')

@section('content')

    {{-- Kartu Ruangan yang Dipilih --}}
    <div class="selected-room-card">
        <div class="card">
            <img src="{{ asset('storage/' . $ruangan->foto) }}" class="gambar-ruangan" alt="{{ $ruangan->nama_ruangan }}">
            <h3>{{ $ruangan->nama }}</h3>
            <p>{{ $ruangan->deskripsi }}</p>
        </div>
    </div>

    {{-- Formulir Booking --}}
        <div class="booking-form-container">
            <h2>Room Booking Form</h2>
        <form action="{{ route('ruangan.booking.store', $ruangan->id) }}" method="POST">
            @csrf {{-- Token keamanan Laravel --}}
            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">
            <div>
                <label for="nama">Full Name</label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" required>
            </div>

            <div>
                <label for="divisi">Division/Position</label>
                <input type="text" id="divisi" name="divisi" required>
            </div>

            <div>
                <label for="event">Event</label>
                <input type="text" id="event" name="event" required>
            </div>

            <div>
                <label for="tanggal">Booking Date</label>
                <input type="date" id="tanggal" name="tanggal" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="time-group">
                <div>
                    <label for="jam_mulai">Start Time</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" required>
                </div>
                <div>
                    <label for="jam_selesai">Finish Time</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" required>
                </div>
            </div>

            <div>
                <button type="submit" class="btn-submit">Request Approval</button>
            </div>
        </form>
    </div>
    @endsection

