<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room App</title>
    <link rel="icon" type="image/x-icon" href="../img/home.png ">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.google.com/specimen/Lato" rel="stylesheet">
    <link href="https://fonts.google.com/specimen/Rubik" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">
</head>
<body>
<!-- <div class="circle">
    <img src="../icon/user-regular.svg" alt="user icon" />
</div> -->
<div class="left-panel">
        </div>
<div class="right-panel">
    <div class="welcome-text">
        <h1>Hello !</h1>
        <h2>Welcome Back</h2>
    </div>

    <div class="container">
        <div class="login-header">
            <h3>ADMIN LOGIN</h3>
        </div>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <br><br>

            <input type="password" name="password" id="pass" placeholder="Password" required><br>

            @if ($errors->any())
                <span style="color: red; font-size: 14px; margin:0;">
                    {{ $errors->first() }}
                </span>
            @endif

            <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
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