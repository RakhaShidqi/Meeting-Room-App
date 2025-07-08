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
<<<<<<< HEAD
                </form>
                <form action="{{ route('form.editruang', ['id' => $ruangan->id, 'nama' => Str::slug($ruangan->nama)]) }}">
                    <br><button class="edit">Edit</button>
=======
                    <br><button class="edit">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="del">Delete</button>
>>>>>>> e7dee2548e0d1e1cae3baf42fd1e24c8ebd3957c
                </form>
            </div>
        @endforeach
    </div>
@endsection
