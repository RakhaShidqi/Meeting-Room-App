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
        <h2>Form Booking Ruangan</h2>

        <form action="/booking" method="POST">
            @csrf {{-- Token keamanan Laravel --}}
            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">
            <div>
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div>
                <label for="divisi">Divisi/Jabatan</label>
                <input type="text" id="divisi" name="divisi" required>
            </div>

            <div>
                <label for="event">Event/Acara</label>
                <input type="text" id="event" name="event" required>
            </div>

            <div>
                <label for="tanggal">Tanggal Booking</label>
                <input type="date" id="tanggal" name="tanggal" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="time-group">
                <div>
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" required>
                </div>
                <div>
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" required>
                </div>
            </div>

            <div>
                <button type="submit" class="btn-submit">Request Approval</button>
            </div>
        </form>
    </div>

@endsection
