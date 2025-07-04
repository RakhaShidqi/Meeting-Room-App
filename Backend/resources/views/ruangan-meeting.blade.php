@extends('layouts.ruangan')

@section('title', 'Daftar Ruangan Meeting')

@section('content')
    <div class="container-ruangan">
        @foreach ($ruangans as $ruangan)
            <div class="card">
                <img src="{{ asset('storage/' . $ruangan->foto) }}" class="gambar-ruangan" alt="{{ $ruangan->nama }}">
                <h3>{{ $ruangan->nama }}</h3>
                <p>{{ $ruangan->kapasitas }}</p>
                <p>{{ $ruangan->lokasi }}</p>
                <p>{{ $ruangan->deskripsi }}</p>
                <form method="GET" action="{{ route('form.pemesanan', ['id' => $ruangan->id, 'nama' => Str::slug($ruangan->nama)]) }}">
                    <button class="pilih" type="submit">Pilih Ruangan</button>
                    <br><button class="edit">Edit</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
