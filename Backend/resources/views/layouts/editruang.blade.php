<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meeting X - Ruang Meeting</title>
  <link rel="stylesheet" href="{{ asset('css/tambah_ruang.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
</head>

<body id="halaman-ruang-meeting">
  <div class="container">
    <div class="box-1">
      <div class="container-dashboard">
        <div class="dashboard-header">
          <img src="{{ asset('img/logo_hypernet2.png') }}" alt="">
          <h2>Meeting X</h2>
        </div>
        <hr>
        <div class="dashboard-body">
          <div class="dashboard-menu">
            <div class="tombol" id="home">
              <img src="{{ asset('img/home.png') }}" class="gambar" alt="">
              <a href="{{ url('/home') }}"><h3>Home</h3></a>
            </div>
            <p>Menu</p>
            <div class="tombol" id="ruang-meeting">
              <img src="{{ asset('img/room.png') }}" class="gambar" alt="">
              <h3>Ruang Meeting</h3>
            </div>
            <div class="tombol" id="jadwal">
              <img src="{{ asset('img/calender.png') }}" class="gambar" alt="">
              <a href="{{ url('/jadwal') }}"><h3>Jadwal</h3></a>
            </div>
            <div class="tombol" id="log-activity">
              <img src="{{ asset('img/log.png') }}" class="gambar" alt="Log Activity Icon">
              <a href="{{ url('/log-activity') }}"><h3>Log Activity</h3></a>
            </div>
          </div>
          <div class="dashboard-akun">
            <p>Akun</p>
            <div class="tombol" id="akun-saya">
              <img src="{{ asset('img/account.png') }}" class="gambar" alt="">
              <a href="{{ url('/akun') }}"><h3>Akun Saya</h3></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <main class="box-2">
      <div class="main-header">
        <a href="{{ url('/akun') }}"><p class="username"></p></a>
        <a href="{{ url('/akun') }}"><img class="profile-image" src="{{ asset('img/user.png') }}" alt=""></a>
      </div>

      <div class="main-body">
        <a href="{{ url('/home') }}" class="back-button-text-link">
          <span class="back-button-text">Back</span>
        </a>

        @yield('content')
      </div>
    </main>
  </div>

  <script>
    function previewFoto() {
      const fileInput = document.getElementById('foto');
      const previewImg = document.getElementById('preview-img');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
        }
        reader.readAsDataURL(fileInput.files[0]);
      }
    }

    function resetPreview() {
      const fileInput = document.getElementById('foto');
      const previewImg = document.getElementById('preview-img');
      fileInput.value = "";
      previewImg.src = "{{ asset('img/placeholder.jpg') }}";
    }
  </script>
</body>
</html>
