<?php
    session_start();
    include "../koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../assets/img/icon/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-2px);
        }

        .login-header {
            background: #0d6efd;
            padding: 40px 30px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .login-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .login-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 16px;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            font-size: 14px;
            background: #fff;
            transition: all 0.3s ease;
            outline: none;
            color: #374151;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #9CA3AF;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: #0d6efd;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
            background: #0b5ed7;
        }

        .btn-login:active {
            transform: translateY(0);
        }
    </style>
    <title>Pimpinan Login</title>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Pimpinan Login</h2>
            <p>Please sign in to your account</p>
        </div>
        
        <form class="login-form" action="" method="post">
            <div class="form-group">
                <label class="form-label">Username</label>
                <div class="input-wrapper">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" class="form-control" name="u" placeholder="Enter your username" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fa fa-lock input-icon"></i>
                    <input type="password" class="form-control" name="p" placeholder="Enter your password" required>
                </div>
            </div>
            
            <button type="submit" name="login" class="btn-login">
                Sign In
            </button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            $ambil = $db->query("SELECT * FROM tbl_pimpinan WHERE username = '" . $_POST['u'] . "' AND password = '" . $_POST['p'] . "'");
            $yangcocok = $ambil->num_rows;
            if ($yangcocok == 1) {
                $akun = $ambil->fetch_assoc();
                $_SESSION['pimpinan'] = $akun;

                echo "<script type='text/javascript'>swal('Selamat', 'Anda Berhasil Login', 'success');</script>";
                echo "<meta http-equiv='refresh' content='1;url=index.php?pages=laporan'>";
            } else {
                echo "<script type='text/javascript'>swal('Login Gagal!', 'Username Dan Password Anda Salah', 'info');</script>";
            }
        }
        ?>
    </div>
</body>

</html>