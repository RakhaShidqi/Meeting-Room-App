<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'HyperMeet - User Manage')</title>

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
                    <h2>HyperMeet</h2>
                </div>

                <div class="dashboard-body">
                    <div class="dashboard-menu">
                        <div class="tombol" id="home">
                            <img src="{{ asset('img/home.png') }}" class="gambar" alt="Home Icon">
                            <a href="{{ route('admin.home') }}"><h3>Home</h3></a>             
                        </div>

                        <p>Menu</p>

                        <div class="tombol" id="ruang-meeting">
                            <img src="{{ asset('img/room.png') }}" class="gambar" alt="Room Icon">
                            <a href="{{ route('ruangan.index') }}"><h3>Meeting Room</h3></a>           
                        </div>

                        <div class="tombol" id="jadwal">
                            <img src="{{ asset('img/calender.png') }}" class="gambar" alt="Calendar Icon">
                            <a href="{{ route('jadwal') }}"><h3>Schedule</h3></a>             
                        </div>
                        
                        <div class="tombol" id="pending-request">
                            <img src="{{ asset('img/req.png') }}" class="gambar" alt="Pending Request Icon"> 
                            <a href="{{ route('booking.waiting') }}"><h3>Pending Request</h3></a>             
                        </div>

                    </div>

                    <div class="tombol" id="log-activity">
                            <img src="../img/log.png" class="gambar" alt="Log Activity Icon"> 
                            <a href="{{ route('admin.activity-log') }}"><h3>Activity Log</h3></a>
                        </div>

                         <div class="tombol" id="user-manage">
                            <img src="../img/umanage.png" class="gambar" alt="User Management Icon"> 
                            <a href="{{ route('user.index') }}"><h3>User Management</h3></a>
                        </div>

                    <div class="dashboard-akun">
                        <p>Account</p>
                        <div class="tombol" id="akun-saya">
                            <img src="{{ asset('img/account.png') }}" class="gambar" alt="Account Icon">
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
                <!-- <h2>User Management</h2> -->
                <div class="user-management-actions">
                    <button class="add-user-button" onclick="openAddUserModal()">
                        <span class="plus-icon-button">+</span> Add New User
                    </button>
                </div>

                <div class="user-list-container">
                    <h3>User List</h3>
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
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
                                            onclick="openEditUserModal(
                                                '{{ $user->id }}',
                                                '{{ $user->email }}',
                                                '{{ $user->name }}',
                                                '{{ $user->role }}'
                                            )">
                                            Edit
                                        </button>

                                        <button class="action-button delete-button"
                                            onclick="confirmDeleteUser('{{ $user->id }}', '{{ $user->name }}')">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">No Users</td>
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
                            <input type="hidden" id="user_id" name="user_id">

                            <label>Email:</label>
                            <input type="email" id="email" name="email" required>

                            <label>Nama:</label>
                            <input type="text" id="name" name="name" required>

                            <div id="password-section">
                                <label>Password:</label>
                                <input type="password" id="password" name="password" minlength="8">

                                <label>Konfirmasi Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" minlength="8">
                            </div>

                            <label>Role</label>
                            <select name="role" id="role" required>
                                <option value="user">User</option>
                                <option value="approver">Approver</option>
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
    document.getElementById('modalTitle').innerText = 'Tambah User Baru';
    document.getElementById('userForm').reset();
    document.getElementById('user_id').value = '';

    document.getElementById('password').required = true;
    document.getElementById('password_confirmation').required = true;

    document.getElementById('userForm').action =
        "{{ route('users.store') }}";

    document.getElementById('userModal').style.display = 'flex';
}

    // Fungsi untuk membuka modal edit pengguna
    function openEditUserModal(id, email, name, role) {
    document.getElementById('modalTitle').innerText = 'Edit User';
    document.getElementById('user_id').value = id;
    document.getElementById('email').value = email;
    document.getElementById('name').value = name;
    document.getElementById('role').value = role;

    // password tidak wajib saat edit
    document.getElementById('password').required = false;
    document.getElementById('password_confirmation').required = false;

    // ganti action ke update role
    document.getElementById('userForm').action =
        `/admin/users/${id}/update-role`;

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

    function confirmDeleteUser(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus pengguna ${name}?`)) {
                fetch(`/admin/users/${id}`, {
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
                        document.querySelector(`#user-row-${id}`).remove();
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
