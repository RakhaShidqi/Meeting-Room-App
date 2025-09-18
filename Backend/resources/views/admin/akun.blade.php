<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting X - My Account</title>
    <link rel="stylesheet" href="../css/akun.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
</head>

<body id="halaman-akun">
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
                        
                            <div class="tombol" id="ruangan-meeting">
                                <img src="../img/room.png" class="gambar" alt="">
                                <a href="{{ url('/ruangan-meeting') }}"><h3>Meeting Room</h3></a>                           
                            </div>
                        
                        <div class="tombol" id="jadwal">
                            <img src="../img/calender.png" class="gambar" alt="">
                            <a href="{{ url('/jadwal') }}"><h3>Schedule</h3></a>                            
                        </div>

                         <div class="tombol" id="pending-request">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> {{-- Assuming you have a pending.png icon --}}
                            <a href="{{ url('/admin/pending-requests') }}"><h3>Pending Request</h3></a>             
                        </div>

                        <div class="tombol" id="log-activity">
                            <img src="../img/log.png" class="gambar" alt="Log Activity Icon"> {{-- Assuming you have a log.png icon --}}
                            <a href="{{ route('admin.log') }}"><h3>Log Activity</h3></a>
                        </div>

                        <div class="tombol" id="user-manage">
                            <img src="../img/umanage.png" class="gambar" alt="User Management Icon"> 
                            <a href="{{ route('user.index') }}"><h3>User Management</h3></a>
                        </div>
                    </div>
                    <div class="dashboard-akun">
                        <p>Account<p>
                        <div class="tombol" id="akun-saya">
                            <img src="../img/account.png" class="gambar" alt="">
                            <h3>My Account</h3>                            
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
                <div class="container-akun">
                    <img src="../img/user.png" class="profile-image" id="profile-image-akun" alt="">
                    <h1 class="username"></h1>
                    <input type="text" id="input-username" placeholder="Username baru">
                    <button onclick="saveName()">Save</button>
                    <br><br><br>
                    <label for="file">Photo Profile</label>
                    <br><br>
                    <input type="file" id="input-file">
                    <button onclick="savePhoto()">Save</button>
                    <br><br>
                    <br><br>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout">Log Out</button>
                    </form>
                </div>
            </div>
            <p id="copyright">Made with heart by Developer</p>
        </main>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>