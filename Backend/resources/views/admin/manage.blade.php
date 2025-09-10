<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Meeting X')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('../css/manage.css') }}">

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
                            <img src="{{ asset('img/home.png') }}" class="gambar" alt="Home Icon">
                            <a href="{{ url('/home') }}"><h3>Home</h3></a>             
                        </div>

                        <p>Menu</p>

                        <div class="tombol" id="ruang-meeting">
                            <img src="{{ asset('img/room.png') }}" class="gambar" alt="Room Icon">
                            <a href="{{ url('/ruangan-meeting') }}"><h3>Ruang Meeting</h3></a>           
                        </div>

                        <div class="tombol" id="jadwal">
                            <img src="{{ asset('img/calender.png') }}" class="gambar" alt="Calendar Icon">
                            <a href="{{ url('/jadwal') }}"><h3>Jadwal</h3></a>             
                        </div>
                        
                        <div class="tombol" id="pending-request">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> 
                            <a href="{{ url('/admin/pending-requests') }}"><h3>Pending Request</h3></a>             
                        </div>

                    </div>

                    <div class="tombol" id="log-activity">
                            <img src="../img/log.png" class="gambar" alt="Log Activity Icon"> 
                            <a href="{{ url('/log-activity') }}"><h3>Log Activity</h3></a>
                        </div>

                         <div class="tombol" id="user-manage">
                            <img src="../img/manage.png" class="gambar" alt="User Management Icon"> 
                            <a href="{{ url('/user-manage') }}"><h3>User Management</h3></a>
                        </div>

                    <div class="dashboard-akun">
                        <p>Akun</p>
                        <div class="tombol" id="akun-saya">
                            <img src="{{ asset('img/account.png') }}" class="gambar" alt="Account Icon">
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
                <h2>User Management</h2>
                <div class="user-management-actions">
                    <button class="add-user-button" onclick="openAddUserModal()">
                        <span class="plus-icon-button">+</span> Tambah Pengguna Baru
                    </button>
                </div>

                <div class="user-list-container">
                    <h3>Daftar Pengguna</h3>
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr id="user-row-{{ $user->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <button class="action-button edit-button" 
                                            onclick="openEditUserModal('{{ $user->email }}', '{{ $user->name }}')">
                                            Edit
                                        </button>

                                        <button class="action-button delete-button" 
                                            onclick="confirmDeleteUser('{{ $user->id }}, {{ $user->email }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">Tidak ada pengguna</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Modal untuk Tambah/Edit Pengguna --}}
                <div id="userModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button" onclick="closeUserModal()">&times;</span>
                        <h2 id="modalTitle">Tambah Pengguna</h2>
                        <form id="userForm" method="post" action="{{ route('users.store') }}">
                            @csrf

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            
                            <label for="name">Nama:</label>
                            <input type="text" id="name" name="name" required>
                            
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>

                            <label for="password_confirmation">Konfirmasi Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required>

                            <label for="role">Role</label>
                            <select name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="user">User</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Admin</option>
                            </select>
                            
                            <button type="submit" class="submit-button">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="../js/script.js"></script>
    <script>

    // Fungsi untuk membuka modal tambah pengguna
    function openAddUserModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Pengguna Baru';
        document.getElementById('userForm').reset();
        document.getElementById('userModal').style.display = 'flex'; 
    }

    // Fungsi untuk membuka modal edit pengguna
    function openEditUserModal(email, name) {
        document.getElementById('modalTitle').innerText = 'Edit Pengguna';
        document.getElementById('email').value = email;
        document.getElementById('name').value = name;
        document.getElementById('password').value = ''; 
        document.getElementById('userModal').style.display = 'flex'; 
    }

    // Fungsi untuk menutup modal
    function closeUserModal() {
        document.getElementById('userModal').style.display = 'none';
    }

    // Fungsi konfirmasi hapus pengguna
    // function confirmDeleteUser(email) {
    //     if (confirm(`Apakah Anda yakin ingin menghapus pengguna ${email}?`)) {
    //         alert(`Pengguna ${email} dihapus (simulasi).`);
    //     }
    // }

    // ✅ Biarkan submit jalan normal ke Laravel
    document.getElementById('userForm').addEventListener('submit', function() {
        // tutup modal setelah tombol simpan ditekan
        document.getElementById('userModal').style.display = 'none';
        // form akan lanjut submit ke route users.store
    });

    function confirmDeleteUser(userId, email) {
            if (confirm(`Apakah Anda yakin ingin menghapus pengguna ${email}?`)) {
                fetch(`/admin/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        // hapus baris user dari tabel tanpa reload
                        document.querySelector(`#user-row-${userId}`).remove();
                    } else {
                        alert("❌ " + data.message);
                    }
                })
                .catch(err => {
                    console.error("❌ Error:", err);
                    alert("Terjadi kesalahan saat menghapus user.");
                });
            }
        }


    </script>

</body>

</html>
