<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting X - Log Activity</title> <link rel="stylesheet" href="../css/log.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="halaman-log-activity"> <div class="container">
        <div class="box-1">
            <div class="container-dashboard">
                <div class="dashboard-header">
                    <img src="../img/logo_hypernet2.png" alt="">
                    <h2>Hyper Meet</h2>
                </div>

                <div class="dashboard-body">
                    <div class="dashboard-menu">
                        <div class="tombol" id="home">
                            <img src="../img/home.png" class="gambar" alt="">
                            <a href="{{ route('admin.home') }}"><h3>Home</h3></a>
                        </div>
                        <p>Menu</p>
                        <div class="tombol" id="ruang-meeting">
                            <img src="../img/room.png" class="gambar" alt="">
                            <a href="{{ url('/ruangan-meeting') }}"><h3>Meeting Room</h3></a>
                        </div>
                        <div class="tombol" id="jadwal">
                            <img src="{{ asset('/img/calender.png') }}" class="gambar" alt="">
                            <a href="{{ url('/jadwal') }}"><h3>Schedule</h3></a>
                        </div>
                         <div class="tombol" id="pending-request">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> {{-- Assuming you have a pending.png icon --}}
                            <a href="{{ url('/admin/pending-requests') }}"><h3>Pending Request</h3></a>             
                        </div>
                        <div class="tombol" id="log-activity">
                            <img src="../img/log.png" class="gambar" alt="Log Activity Icon">
                            <a href="{{ url('/log-activity') }}"><h3>Log Activity</h3></a>
                        </div>
                        <div class="tombol" id="user-manage">
                            <img src="../img/umanage.png" class="gambar" alt="User Management Icon"> 
                            <a href="{{ route('user.index') }}"><h3>User Management</h3></a>
                        </div>
                    </div>
                    <div class="dashboard-akun">
                        <p>Account</p>
                        <div class="tombol" id="akun-saya">
                            <img src="../img/account.png" class="gambar" alt="">
                            <a href="{{ route('admin.akun') }}"><h3>My Account</h3></a>
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
                <!-- <a href="{{ route('admin.home') }}" class="back-button-text-link">
                    <span class="back-button-text">Back</span>
                </a> -->
                <div class="log-activity-container"> <h2>User Log Activity</h2>
                    <div class="log-table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>Activity</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-07-07 10:30</td>
                                    <td>John Doe</td>
                                    <td>Membuat Booking</td>
                                    <td>Ruangan: Meeting Room A, Waktu: 14:00-15:00</td>
                                </tr>
                                <tr>
                                    <td>2025-07-07 09:15</td>
                                    <td>Jane Smith</td>
                                    <td>Mengedit Ruangan</td>
                                    <td>Ruangan: Creative Hub, Kapasitas: 12 -> 15</td>
                                </tr>
                                <tr>
                                    <td>2025-07-06 16:00</td>
                                    <td>Admin User</td>
                                    <td>Menghapus Booking</td>
                                    <td>Booking ID: #12345, Ruangan: Conf Room C</td>
                                </tr>
                                <tr>
                                    <td>2025-07-06 11:45</td>
                                    <td>John Doe</td>
                                    <td>Login</td>
                                    <td>IP Address: 192.168.1.100</td>
                                </tr>
                                <tr>
                                    <td>2025-07-05 08:00</td>
                                    <td>Jane Smith</td>
                                    <td>Logout</td>
                                    <td></td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>