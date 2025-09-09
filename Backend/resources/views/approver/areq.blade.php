<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Meeting X')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('../css/req.css') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
</head>

<body id="halaman-ruang-meeting">
    <div class="container">

        {{-- Sidebar Kiri --}}
        <div class="box-1">
            <div class="container-dashboard">
                <div class="dashboard-header">
                    <img src="{{ asset('img/logo_hypernet2.png') }}" alt="Logo Hypernet">
                    <h2>Meeting X</h2>
                </div>

                <hr>
                
                <div class="dashboard-body">
                    <div class="dashboard-menu">
                        <div class="tombol" id="home">
                            <img src="{{ asset('/img/home.png') }}" class="gambar" alt="Home Icon">
                            <a href="{{ route('admin.home')}}"><h3>Home</h3></a>             
                        </div>

                        <p>Menu</p>

                        <div class="tombol" id="ruang-meeting">
                            <img src="{{ asset('img/room.png') }}" class="gambar" alt="Room Icon">
                            <a href="{{ route('ruangan.index') }}"><h3>Ruang Meeting</h3></a>  
                        
                        </div>

                        <div class="tombol" id="jadwal">
                            <img src="{{ asset('img/calender.png') }}" class="gambar" alt="Calendar Icon">
                            <a href="{{ route('jadwal') }}"><h3>Jadwal</h3></a>             
                        </div>
                        
                        <div class="tombol" id="pending-requests">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> {{-- Assuming you have a pending.png icon --}}
                            <a href="{{ route('booking.waiting') }}"><h3>Pending Request</h3></a>             
                        </div>

                    </div>

                    <div class="tombol" id="log-activity">
                            <img src="{{ asset('/img/log.png') }}" class="gambar" alt="Log Activity Icon"> {{-- Assuming you have a log.png icon --}}
                            <a href="{{ route('admin.log') }}"><h3>Log Activity</h3></a>
                        </div>
                        
                        
                    <div class="dashboard-akun">
                        <p>Akun</p>
                        <div class="tombol" id="akun-saya">
                            <img src="{{ asset('img/account.png') }}" class="gambar" alt="Account Icon">
                            <a href="{{ route('admin.akun') }}"><h3>Akun Saya</h3></a>             
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        <main class="box-2">
            <div class="main-header">
                <a href="{{ url('/akun') }}"><p class="username"></p></a>
                <a href="{{ url('/akun') }}"><img class="profile-image" src="{{ asset('img/user.png') }}" alt="User Icon"></a>    
            </div>

            <div class="main-body">
                
                {{-- NEW: Content for Pending Requests --}}
            <div class="container-pending-requests">
                    @forelse($bookings as $booking)
                        <div class="card pending-card">
                            <img src="{{ asset('img/ruangan.jpg') }}" alt="Meeting Room" class="gambar-ruangan">

                            <h3>{{ $booking->ruangan->nama_ruangan ?? 'Ruang Rapat' }}</h3>

                            <div class="booking-details">
                                <p><strong>Nama:</strong> {{ $booking->nama_pemesan }}</p>
                                <p><strong>Divisi:</strong> {{ $booking->divisi }}</p>
                                <p><strong>Event/Acara:</strong> {{ $booking->event }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal)->format('d/m/Y') }}</p>
                                <p><strong>Jam Mulai:</strong> {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }}</p>
                                <p><strong>Jam Selesai:</strong> {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</p>
                            </div>

                            <div class="action-buttons">
                                <form action="{{ route('booking.approve', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="accept-button">Accept</button>
                                </form>

                                <form action="{{ route('booking.reject', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="reject-button">Reject</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada booking yang menunggu approval.</p>
                    @endforelse
                </div>

                @yield('content')
            </div>
        </main>
    </div>

    {{-- JS --}}
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>