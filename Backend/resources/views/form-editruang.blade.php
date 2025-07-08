@extends('layouts.editruang')

@section('title', 'Form Edit')

@section('content')
<div class="booking-form-container">
    <h2>Form Edit Ruang Meeting</h2>

    <form action="{{ url('/ruangan/' . $ruangan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_ruangan">Nama Ruangan</label>
            <input type="text" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama) }}" required>
        </div>

        <div>
            <label for="kapasitas">Kapasitas Ruangan</label>
            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $ruangan->kapasitas) }}" required>
        </div>

        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $ruangan->lokasi) }}" required>
        </div>

        <div>
            <label for="deskripsi">Deskripsi (opsional)</label>
            <input type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $ruangan->deskripsi) }}">
        </div>

        <div class="foto-preview-wrapper">
            <div class="input-foto">
                <label for="foto">Foto Ruangan</label>
                <input type="file" id="foto" name="foto" accept="image/*" onchange="previewFoto()">
                <button type="button" class="btn-reset-foto" onclick="resetPreview()">Reset Foto</button>
            </div>

            <div class="preview-card">
                <img id="preview-img" class="gambar-ruangan"
                     src="{{ asset('storage/' . ($ruangan->foto ?? 'img/placeholder.jpg')) }}"
                     alt="Preview Foto Ruangan">
            </div>
        </div>

        <div>
            <button type="submit" class="btn-submit">Simpan Ruangan</button>
        </div>
    </form>
</div>
@endsection
