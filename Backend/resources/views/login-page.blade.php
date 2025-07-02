<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting X - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="https://www.hypernet.co.id/wp-content/uploads/2020/01/cropped-hypernet-logo-192x192.png">


</head>

<body>
    <div class="container">
        <div class="tabel">
            <div class="box-1">
                <div class="card">
                    <div class="card_header">
                    <h2>Meeting X</h2>
                    </div>

                    <div class="card_body">
                    <h3>Selamat Datang!</h3>
                    <form action="../Tampilan-Home/home.html" method="get">
                        <input type="email" name="email" id="email" placeholder="Email">
                        <br>
                        <br>
                        <input type="password" name="password" id="password" placeholder="Password">
                        <br><br><br>
                        <input type="submit" name="login" id="login" value="Login">
                    </form>
                    </div>

                    <div class="card_footer">
                        <p>Copyright &copy; 2025<p>
                    </div>
                </div>
            </div>
            <div class="box-2">
                <img src="../gambar/logo_hypernet.jpg" alt="">

            </div>
        </div>
    </div>

    <script src="/Tampilan-Login/tampilan_login.js"></script>
</body>