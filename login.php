<?php
    session_start();
    include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/img/icon/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
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

        .signup-link {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
            margin-top: 20px;
        }

        .signup-link label {
            color: #6B7280;
            font-size: 14px;
            margin: 0;
        }

        .signup-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #0b5ed7;
            text-decoration: underline;
        }

        .social-login {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
        }

        .social-title {
            text-align: center;
            color: #6B7280;
            font-size: 12px;
            margin-bottom: 20px;
            position: relative;
        }

        .social-title::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #E5E7EB;
            z-index: 1;
        }

        .social-title span {
            background: #fff;
            padding: 0 15px;
            position: relative;
            z-index: 2;
        }

        .sosmed {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .sosmed-items {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sosmed-items:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .bg1 {
            background: #3b5998;
        }

        .bg1:hover {
            background: #2d4373;
        }

        .bg2 {
            background: #1da1f2;
        }

        .bg2:hover {
            background: #1a91da;
        }

        .bg3 {
            background: #ea4335;
        }

        .bg3:hover {
            background: #d23321;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                border-radius: 12px;
            }
            
            .login-header {
                padding: 30px 20px 20px;
            }
            
            .login-form {
                padding: 30px 20px;
            }
            
            .login-header h2 {
                font-size: 24px;
            }

            .sosmed-items {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        /* Loading animation */
        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <title>Customer Login</title>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Welcome Back</h2>
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

            <div class="signup-link">
                <label>Don't have an account? <a href="signup.php">Sign Up</a></label>
            </div>
        </form>

        <?php
        if (isset($_POST['login'])) {
            $ambil = $db->query("SELECT * FROM tbl_pelanggan WHERE username = '" . $_POST['u'] . "' AND password = '" . $_POST['p'] . "'");
            $yangcocok = $ambil->num_rows;
            if ($yangcocok == 1) {
                $akun = $ambil->fetch_assoc();
                $_SESSION['pelanggan'] = $akun;

                echo "<script type='text/javascript'>swal('Selamat', 'Anda Berhasil Login', 'success');</script>";
                echo "<meta http-equiv='refresh' content='1;url=checkout.php'>";
            } else {
                echo "<script type='text/javascript'>swal('Login Gagal!', 'Username Dan Password Anda Salah', 'info');</script>";
            }
        }
        ?>
    </div>
</body>

</html>