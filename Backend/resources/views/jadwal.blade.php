<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting X - Jadwal</title>
    <link rel="stylesheet" href="../css/jadwal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
</head>

<body id="halaman-jadwal">
    <div class="container">
        <div class="box-1">
            <div class="container-dashboard">
                <div class="dashboard-header">
                    <img src="../img/logo_hypernet2.png" alt="">
                    <h2>Meeting X</h2>
                </div>

                <hr>
                
                <div class="dashboard-body">
                    <div class="dashboard-menu">
                        
                            <div class="tombol" id="home">
                                <img src="../img/home.png" class="gambar" alt="">
                                <a href="{{ url('/home') }}"><h3>Home</h3></a>                            
                            </div>
                        
                        <p>Menu<p>
                        
                            <div class="tombol" id="ruang-meeting">
                                <img src="../img/room.png" class="gambar" alt="">
                                <a href="{{ url('/ruangan-meeting') }}"><h3>Ruang Meeting</h3></a>                           
                            </div>
                        
                        <div class="tombol" id="jadwal">
                            <img src="../img/calender.png" class="gambar" alt="">
                            <h3>Jadwal</h3>                            
                        </div>

                         <div class="tombol" id="pending-request">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> {{-- Assuming you have a pending.png icon --}}
                            <a href="{{ url('/admin/pending-requests') }}"><h3>Pending Request</h3></a>             
                        </div>

                        <div class="tombol" id="log-activity">
                            <img src="../img/log.png" class="gambar" alt="Log Activity Icon">
                            <a href="{{ url('/log-activity') }}"><h3>Log Activity</h3></a>
                        </div>
                    </div>
                    <div class="dashboard-akun">
                        <p>Akun<p>
                        <div class="tombol" id="akun-saya">
                            <img src="../img/account.png" class="gambar" alt="">
                            <a href="{{ url('/akun') }}"><h3>Akun Saya</h3></a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="box-2">
            <div class="main-header">
                <a href="{{ url('/akun') }}"><p class="username"></p></a>
                <a href="{{ url('/akun') }}"><img class="profile-image" src="../img/user.png" alt=""></a>    
            </div>
            <div class="main-body">
                <div class="container-kalender">
                    <div class="kalender">
                      <div class="header-kalender">
                        <button id="prevMonth">&lt;</button>
                        <span id="monthYear"></span>
                        <button id="nextMonth">&gt;</button>
                      </div>
                      <div class="days-name">
                        <div>Min</div>
                        <div>Sen</div>
                        <div>Sel</div>
                        <div>Rab</div>
                        <div>Kam</div>
                        <div>Jum</div>
                        <div>Sab</div>
                      </div>
                      <div class="days" id="days"></div>
                    </div>
                  </div>
            </div>
            <p id="copyright">Made with heart by Ryan/Tama/Rynetz/Tamskutt</p>
        </main>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>