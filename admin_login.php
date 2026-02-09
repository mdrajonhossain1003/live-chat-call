<?php
session_start();

if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: admin_dashboard.php");
    exit();
}

$error_msg = "";
$admin_username = "mdrajonhossain5090@gmail.com";
$admin_password = "rajon@2#";

if(isset($_POST['login'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $error_msg = "ইউজারনেম এবং পাসওয়ার্ড প্রয়োজন!";
    }
    elseif($username === $admin_username && $password === $admin_password){
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin_username;
        header("Location: admin_dashboard.php");
        exit();
    }
    else{
        $error_msg = "ইউজারনেম বা পাসওয়ার্ড ভুল!";
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MOBILE REQUEST</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Hind Siliguri', sans-serif;
            background: linear-gradient(135deg, #a8d5d5 0%, #009688 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
            text-align: center;
        }

        .logo {
            font-size: 60px;
            color: #009688;
            margin-bottom: 15px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: #1a237e;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #999;
            margin-bottom: 30px;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
            font-size: 13px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            color: #555;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
            font-family: 'Hind Siliguri', sans-serif;
        }

        .form-group input:focus {
            border-color: #009688;
            box-shadow: 0 0 8px rgba(0,150,136,0.2);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #a8d5d5 0%, #009688 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            font-family: 'Hind Siliguri', sans-serif;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,150,136,0.4);
        }

        .creds {
            background: #e0f2f1;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 4px solid #009688;
            font-size: 12px;
            color: #00796b;
            text-align: left;
        }

        .creds strong {
            color: #1a237e;
        }

        @media (max-width: 480px) {
            .card {
                padding: 35px 25px;
            }
            .title { font-size: 22px; }
            .logo { font-size: 50px; }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="logo"><i class="fas fa-lock"></i></div>
    <h1 class="title">এডমিন লগইন</h1>
    <p class="subtitle">MOBILE REQUEST প্যানেল</p>

    <?php if($error_msg != ""): ?>
        <div class="error">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label><i class="fas fa-user"></i> ইউজারনেম</label>
            <input type="text" name="username" required autofocus>
        </div>

        <div class="form-group">
            <label><i class="fas fa-lock"></i> পাসওয়ার্ড</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">
            <i class="fas fa-sign-in-alt"></i> লগইন করুন
        </button>
    </form>

</body>
</html>