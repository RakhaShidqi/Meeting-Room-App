<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyperMeet - Home</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="halaman-home">
    <div class="container">
        <div class="box-1">
            <div class="container-dashboard">
                <div class="dashboard-header">
                    <img src="../img/logo_hypernet2.png" alt="">
                    <h2>HyperMeet</h2>
                </div>
                
                <div class="dashboard-body">
                    <div class="dashboard-menu">
                        <div class="tombol" id="home">
                            <img src="../img/home.png" class="gambar" alt="">
                            <h3>Home</h3>                            
                        </div>
                        <p>Menu<p>                      
                            <div class="tombol" id="ruang-meeting">                               
                                <img src="../img/room.png" class="gambar" alt="">
                                <a href="{{ route('ruangan.index') }}"><h3>Meeting Room</h3></a>                                                    
                            </div>

                            <div class="tombol" id="jadwal">
                                <img src="../img/calender.png" class="gambar" alt="">
                                <a href="{{ route('jadwal') }}"><h3>Schedule</h3></a>                            
                            </div>

                             <div class="tombol" id="pending-request">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> {{-- Assuming you have a pending.png icon --}}
                            <a href="{{ route('booking.waiting') }}"><h3>Pending Request</h3></a>             
                        </div>

                            <div class="tombol" id="log-activity">
                            <img src="../img/log.png" class="gambar" alt="Log Activity Icon"> {{-- Assuming you have a log.png icon --}}
                            <a href="{{ route('admin.log') }}"><h3>Log Activity</h3></a>
                        </div>

                        <div class="tombol" id="user-manage">
                            <img src="{{asset('img/umanage.png')}}" class="gambar" alt="User Management Icon"> 
                            <a href="{{ route('user.index') }}"><h3>User Management</h3></a>
                        </div>

                    </div>
                    <div class="dashboard-akun">
                        <p>Account<p>
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
                    <a href="{{ route('admin.akun') }}"><p class="username"></p></a>
                    <a href="{{ route('admin.akun') }}"><img class="profile-image" src="../img/user.png" alt=""></a>               
            </div>
            <div class="main-body">
    <div id="jam">00:00:00</div>
    <div id="tanggal">Hari, 00, 00, 0000</div>
</div>

<!-- ===== Bagian Cards ===== -->
<div class="main-cards">
    <div class="card available">
        <div class="card-inner">
            <h2>3</h2>
            <span class="material-icons-outlined">check</span>
        </div>
        <h1>Available Rooms</h1>
        <span>dd/mm/yy</span>
    </div>

    <div class="card booked">
        <div class="card-inner">
            <h2>7</h2>
            <span class="material-icons-outlined">lock</span>
        </div>
        <h1>Booked Rooms</h1>
        <span>dd/mm/yy</span>
    </div>

    <div class="card total">
        <div class="card-inner">
            <h2>13</h2>
            <span class="material-icons-outlined">meeting_room</span>
        </div>
        <h1>Total Rooms</h1>
        <span>dd/mm/yy</span>
    </div>

    <div class="card rejected">
        <div class="card-inner">
            <h2>5</h2>
            <span class="material-icons-outlined">close</span>
        </div>
        <h1>Rejected Rooms</h1>
        <span>dd/mm/yy</span>
    </div>
</div>

<!-- ===== Bagian Chart & Tabel ===== -->
<div class="dashboard-content">
    <div class="chart-section">
        <h2>Booking Statistic</h2>
        <select id="year-select">
            <option value="2025" selected>2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
        </select>
        <canvas id="bookingChart"></canvas>
    </div>

    <div class="activity-section">
        <div class="activity-header">
            <h2>Latest Activities</h2>
            <select name="" id="select-box">
                <option>Oct 2025</option>
                <option>Nov 2025</option>
                <option>Des 2025</option>
                <option>Jan 2026</option>
                <option>Feb 2026</option>
            </select>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Date, Time</th>
                    <th>Event</th>
                    <th>Name</th>
                    <th>Division</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01 Dec 2025, 14:00 - 16:00</td>
                    <td>Weekly Meeting</td>
                    <td>Lorem Ipsum</td>
                    <td>Marketing</td>
                    <td><span class="status in-progress">Progress</span></td>
                </tr>
                <tr>
                    <td>02 Jan 2026, 09:00 - 11:00</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td> 
                    <td>Lorem Ipsum</td>
                    <td><span class="status finished">Finished</span></td>
                </tr>
                <tr>
                    <td>13 Jan 2026, 16:00 - 17:00</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td>Lorem Ipsum</td>
                    <td><span class="status rejected">Rejected</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

    <script src="../js/script.js"></script>
    <script>
const ctx = document.getElementById('bookingChart').getContext('2d');

// Dataset berdasarkan tahun
const bookingData = {
  2025: [0, 5, 3, 14, 0, 6, 0, 0, 20, 0, 0, 0],
  2026: [4, 8, 6, 10, 12, 5, 8, 15, 10, 7, 9, 11],
  2027: [12, 10, 14, 9, 11, 13, 15, 12, 14, 10, 8, 9]
};

// Inisialisasi chart
const bookingChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
      label: 'Bookings',
      data: bookingData[2025],
      borderColor: '#26667F',
      backgroundColor: 'white',
      fill: true,
      tension: 0.4
    }]
  },
  options: {
    plugins: { legend: { display: false }},
    scales: { y: { beginAtZero: true } }
  }
});

// Event listener untuk select tahun
document.getElementById('year-select').addEventListener('change', function() {
  const selectedYear = this.value;
  bookingChart.data.datasets[0].data = bookingData[selectedYear];
  bookingChart.update();
});
</script>

</body>

</html>