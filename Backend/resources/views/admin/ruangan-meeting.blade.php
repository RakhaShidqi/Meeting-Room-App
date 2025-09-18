@extends('layouts.ruangan')

@section('title', 'List Meeting Room')

@section('content')
    <div class="container-ruangan">
        @foreach ($ruangans as $ruangan)
                <div class="card">
                    <img src="{{ asset('storage/' . $ruangan->foto) }}" class="gambar-ruangan" alt="{{ $ruangan->nama }}">
                    <h3>{{ $ruangan->nama_ruangan }}</h3>
                    <p>{{ $ruangan->kapasitas }}</p>
                    <p>{{ $ruangan->lokasi }}</p>
                    <p>{{ $ruangan->deskripsi }}</p>

                    <form method="GET" action="{{ route('ruangan.booking.form', ['id' => $ruangan->id, 'nama' => Str::slug($ruangan->nama_ruangan)]) }}">
                        <button class="pilih" type="submit">Select Room</button>
                    </form>

                    <div class="action-buttons">
                        {{-- Tombol Edit --}}
                        <form action="{{ route('ruangan.edit', ['id' => $ruangan->id, 'nama' => Str::slug($ruangan->nama_ruangan)]) }}" method="GET">
                            <button type="submit" class="edit">Edit</button>
                        </form>

                        {{-- Tombol Delete --}}
                        <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="del">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach


        {{-- Load SweetAlert2 script first --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- SweetAlert Success --}}
        @if(session('successcreate'))
            <script>
                    Swal.fire({
                    title: "Berhasil",
                    text: "Berhasil Tambah Ruangan",
                    icon: "success"
                });
            </script>
        @endif

        {{-- SweetAlert Error Conflict Booking --}}
        @if(session('errorconflict'))
            <script>
                    Swal.fire({
                    title: "Error",
                    text: "Jadwal Sudah Penuh",
                    icon: "error"
                });
            </script>
        @endif
        
        @if(session('success'))
            <script>
                    Swal.fire({
                    title: "Booking Berhasil",
                    text: "Silahkan Menunggu Approval",
                    icon: "success"
                });
            </script>
        @endif

        @if(session('editsuccess'))
            <script>
                    Swal.fire({
                    title: "Success Edit",
                    text: "Data Ruangan Diperbaharui",
                    icon: "success"
                });
            </script>
        @endif

        @if(session('deletesuccess'))
            <script>
                    Swal.fire({
                    title: "Success Delete",
                    text: "Data Ruangan Berhasil Dihapus",
                    icon: "success"
                });
            </script>
        @endif
    </div>
@endsection
