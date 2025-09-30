<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meeting X - Meeting Room</title>
  <link rel="stylesheet" href="../css/tambah_ruang.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
</head>

<body id="halaman-ruang-meeting">
  <div class="container">
    <div class="box-1">
      <div class="container-dashboard">
        <div class="dashboard-header">
          <img src="../img/logo_hypernet2.png" alt="">
          <h2>Meeting X</h2>
        </div>
        <!-- <hr> -->
        <div class="dashboard-body">
          <div class="dashboard-menu">
            <div class="tombol" id="home">
              <img src="../img/home.png" class="gambar" alt="">
              <a href="{{ url('/home') }}"><h3>Home</h3></a>
            </div>
            <p>Menu</p>
            <div class="tombol" id="ruang-meeting">
              <img src="../img/room.png" class="gambar" alt="">
              <h3>Meeting Room</h3>
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
                            <a href="{{ url('/log-activity') }}"><h3>Log Activity</h3></a>
                        </div>
                        
                        <div class="tombol" id="user-manage">
                            <img src="../img/umanage.png" class="gambar" alt="User Management Icon"> 
                            <a href="{{ url('/user-manage') }}"><h3>User Management</h3></a>
                        </div>
          </div>
          <div class="dashboard-akun">
            <p>Account</p>
            <div class="tombol" id="akun-saya">
              <img src="../img/account.png" class="gambar" alt="">
              <a href="{{ url('/akun') }}"><h3>My Account</h3></a>
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
        <a href="{{ route('ruangan.index') }}" class="back-button-text-link">
                        <span class="back-button-text">Back</span>
                    </a>
        <div class="booking-form-container">
          <h2>Add Meeting Room Form</h2>
          <form action="{{route('ruangan.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
              <label for="nama_ruangan">Room Name</label>
              <input type="text" id="nama_ruangan" name="nama_ruangan" required>
            </div>

            <div>
              <label for="kapasitas">Room Capacity</label>
              <input type="number" id="kapasitas" name="kapasitas" required>
            </div>

            <div>
              <label for="fasilitas">Room Facility</label>
              <input type="text" id="fasilitas" name="fasilitas" required>
            </div>

            <div>
              <label for="lokasi">Location</label>
              <input type="text" id="lokasi" name="lokasi" required>
            </div>

            <div>
              <label for="deskripsi">Description (optional)</label>
              <input type="text" id="deskripsi" name="deskripsi">
            </div>

            <div class="foto-preview-wrapper">
              <div class="input-foto">
                <label for="foto">Room Photo</label>
                <input type="file" id="foto" name="foto" accept="image/*" onchange="previewFoto()" required>
                <button type="button" class="btn-reset-foto" onclick="resetPreview()">Reset Photo</button>
              </div>

              <div class="preview-card">
                <img id="preview-img" class="gambar-ruangan" src="../img/placeholder.jpg" alt="Preview Room Photo">
              </div>
            </div>

            <div>
              <button type="submit" class="btn-submit">Save Room</button>
            </div>
          </form>

        </div>
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
      previewImg.src = "../img/placeholder.jpg";
    }
  </script>
</body>
</html>
