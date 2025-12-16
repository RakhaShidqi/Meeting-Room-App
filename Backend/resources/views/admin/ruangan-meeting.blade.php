@extends('layouts.ruangan')

@section('title', 'HyperMeet - Meeting Room')

@section('content')
    <div class="container-ruangan">
        @foreach ($ruangans as $ruangan)
                <div class="card">
                    <img src="{{ asset('storage/' . $ruangan->foto) }}" class="gambar-ruangan" alt="{{ $ruangan->nama }}">
                    <h3>{{ $ruangan->nama_ruangan }}</h3>
                    <div class="info-row">
                        <span class="material-icons-outlined">person</span>
                        <p>{{ $ruangan->kapasitas }}</p>
                    </div>
                    <div class="info-row">
                        <span class="material-icons-outlined">location_on</span>
                        <p>{{ $ruangan->lokasi }}</p>
                    </div>
                    <div class="info-row">
                        <span class="material-icons-outlined">description</span>
                        <p>{{ $ruangan->deskripsi }}</p>
                    </div>
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
                    title: "Success",
                    text: "Successfully Added Room",
                    icon: "success",
                    customClass: {
                        popup: 'my-popup',
                        title: 'my-title',
                        htmlContainer: 'my-text',
                        icon: 'my-icon'
                    }
                });
            </script>
        @endif

        {{-- SweetAlert Error Conflict Booking --}}
        @if(session('errorconflict'))
            <script>
                    Swal.fire({
                    title: "Error",
                    text: "Schedule is Full",
                    icon: "error",
                    customClass: {
                        popup: 'my-popup',
                        title: 'my-title',
                        htmlContainer: 'my-text',
                        icon: 'my-error'
                    }
                });
            </script>
        @endif
        
        @if(session('success'))
            <script>
                    Swal.fire({
                    title: "Booking Successful",
                    text: "Please Wait for Approval",
                    icon: "success",
                    customClass: {
                        popup: 'my-popup',
                        title: 'my-title',
                        htmlContainer: 'my-text',
                        icon: 'my-icon'
                    }
                });
            </script>
        @endif

        @if(session('editsuccess'))
            <script>
                    Swal.fire({
                    title: "Successful Edit",
                    text: "Room Data Updated",
                    icon: "success",
                    customClass: {
                        popup: 'my-popup',
                        title: 'my-title',
                        htmlContainer: 'my-text',
                        icon: 'my-icon'
                    }
                });
            </script>
        @endif

        @if(session('deletesuccess'))
            <script>
                    Swal.fire({
                    title: "Successfully Deleted",
                    text: "Room Data Successfully Deleted",
                    icon: "success",
                    customClass: {
                        popup: 'my-popup',
                        title: 'my-title',
                        htmlContainer: 'my-text',
                        icon: 'my-icon'
                    }
                });
            </script>
        @endif


    </div>
@endsection
