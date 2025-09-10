<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room App</title>
    <link rel="icon" type="image/x-icon" href="../img/home.png ">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="circle">
    <img src="../icon/user-regular.svg" alt="user icon" />
</div>

    <div class="container">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <h2>ADMIN LOGIN</h2>

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

            <button type="submit" class="log">LOGIN</button>
            <br><br>

            <!-- <a href="{{ route('register') }}">Belum ada akun? Daftar</a> -->

        </form>
    </div>
    {{-- SweetAlert Success --}}
        @if(session('success'))
            <script>
                    Swal.fire({
                    title: "Successfull",
                    text: "Registration Successful! Please log in.",
                    icon: "success"
                });
            </script>
        @endif
</body>
</html>