@extends('layouts.ruangan')

@section('title', 'Daftar Ruangan Meeting')

@section('content')
    <div class="container-ruangan">
        @foreach ($ruangans as $ruangan)
            <div class="card">
                <img src="{{ asset('storage/' . $ruangan->foto) }}" class="gambar-ruangan" alt="{{ $ruangan->nama }}">
                <h3>{{ $ruangan->nama_ruangan }}</h3>
                <p>{{ $ruangan->kapasitas }}</p>
                <p>{{ $ruangan->lokasi }}</p>
                <p>{{ $ruangan->deskripsi }}</p>
                <form method="GET" action="{{ route('form.pemesanan', ['id' => $ruangan->id, 'nama' => Str::slug($ruangan->nama_ruangan)]) }}">
                    <button class="pilih" type="submit">Pilih Ruangan</button>
                </form>
                <form action="{{ route('form.editruang', ['id' => $ruangan->id, 'nama' => Str::slug($ruangan->nama_ruangan)]) }}">
                    <br><button class="edit">Edit</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="del">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
