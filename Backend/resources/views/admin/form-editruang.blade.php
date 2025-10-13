@extends('layouts.editruang')

@section('title', 'HyperMeet - Edit Meeting Room')

@section('content')
<div class="booking-form-container">
    <h2>Edit Meeting Room Form</h2>

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_ruangan">Room Name</label>
            <input type="text" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
        </div>

        <div>
            <label for="kapasitas">Room Capacity</label>
            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $ruangan->kapasitas) }}" required>
        </div>

        <div>
            <label for="lokasi">Location</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $ruangan->lokasi) }}" required>
        </div>

        <div>
            <label for="deskripsi">Description (optional)</label>
            <input type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $ruangan->deskripsi) }}">
        </div>

        <div class="foto-preview-wrapper">
            <div class="input-foto">
                <label for="foto">Room Photo</label>
                <input type="file" id="foto" name="foto" accept="image/*" onchange="previewFoto()">
                <button type="button" class="btn-reset-foto" onclick="resetPreview()">Reset Photo</button>
            </div>

            <div class="preview-card">
                <img id="preview-img" class="gambar-ruangan"
                     src="{{ asset('storage/' . ($ruangan->foto ?? 'img/placeholder.jpg')) }}"
                     alt="Preview Foto Ruangan">
            </div>
        </div>

        <div>
            <button type="submit" class="btn-submit">Save Room</button>
        </div>
    </form>
</div>
@endsection
