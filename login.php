<?php require_once 'inc/functions.php'; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles/login/styles.css">
    
</head>

<body class="body-container">
    <form action="inc/functions.php" method="post">
        <div class="box-container">
            <img class="logo" src="images/logo.png" alt="">

            <div class="username-label">نام کاربری<span class="username-label-desc">(شماره تلفن یا کد مشتری خود را وارد کنید.)</span></div>
            <div class="input-group input-group-username">
                <span class="icon"> <img class="icon-img" src="images/profile.jpg" alt=""></span>
                <input type="text" name="username" >
            </div>

            <div class="password-label">رمز عبور</div>
            <div class="input-group input-group-password">
                <span class="icon"><img class="icon-img" src="images/password.jpg" alt=""></span>
                <input type="password" name="password">
            </div>
            <div class="remember-forgot-container">
                <div class="remember-me">
                    <label for="remember-me">مرا به خاطر بسپار</label>
                    <input type="checkbox" name="remember" id="remember-me">
                </div>
                <a href="restore.php"  class="forgot-password">فراموشی رمز عبور</a>
            </div>

            <button class="login-button" name="do-login">ورود به حساب کاربری</button>
            <span style="position: absolute; top: 134px; right: 120px;"><?php showMessage(); ?></span>
            
    </form>
    <div style="position: absolute; bottom: 70px; left: 50%; transform: translateX(-50%); font-size: 14px;">

        <a href="register.php" style="color: #0017AF; font-weight: bold;">ثبت نام</a>
    </div>
    </div>
</body>

</html>