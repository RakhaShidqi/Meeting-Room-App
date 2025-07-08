<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room App</title>
    <link rel="icon" type="image/x-icon" href="../img/meeting-room.png ">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="circle">
    <img src="../icon/user-regular.svg" alt="user icon" />
</div>

    <div class="container">
        <form method="POST" action="/login">
            @csrf

            <h2>Selamat Datang</h2>

            <input type="email" name="email" id="email" placeholder="Email ID/Username" required>
            <br><br>

            <input type="password" name="password" id="pass" placeholder="Password" required><br>

            @if ($errors->any())
                <span style="color: red; font-size: 14px; margin:0;">
                    {{ $errors->first() }}
                </span>
            @endif

            <a href="{{ url('/forgot-password') }}">Lupa Password?</a>
            <br><br>

            <button type="submit" class="log">Login</button>
            <br><br>

            <a href="{{ url('/register') }}">Belum ada akun? Daftar</a>

        </form>
    </div>
</body>
</html>