<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room App</title>
    <link rel="icon" type="image/x-icon" href="../img/meeting-room.png ">
    <link rel="stylesheet" href="css/style1.css">
</head> 
<body>
<div class="circle">
    <img src="icon/user-regular.svg" alt="user icon" />
  </div>

    <div class="container">
        <form action="{{ route('register.post') }}" method="POST">
            <h2>Pembuatan Akun Baru</h2>
            @csrf
            <input type="text" name="name" id="user" placeholder="Username">
            <br>
            <input type="email" name="email" id="email" placeholder="Email ID">
            <br>
            <input type="password" name="password" id="pass" placeholder="Password">
            <br>
            <input type="password" name="password_confirmation" id="pass" placeholder="Confirm Password" required>
            <br>
            <label for="role">Role</label>
                <select name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="user">User</option>
                    <option value="Approver">Approver</option>
                    <option value="admin">Admin</option>
                </select>
            <br><br>
            <button type="submit" class="reg">Register</button>
            <br><br>
        </form>
        <a href="{{route('login')}}">Back to Home</a>
    </div>
</body>
</html>