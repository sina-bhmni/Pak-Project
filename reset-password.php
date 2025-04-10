<?php

require_once 'inc/functions.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغییر رمز عبور</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles/restore/reset-password.css">
    <script>
        // تابع برای اعتبارسنجی رمز عبور
        function validatePassword(password) {
            const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,10}$/;
            if (regex.test(password)) {
                return true;
            } else {
                alert("رمز عبور باید ترکیبی از حروف انگلیسی، عدد و کاراکترهای خاص باشد.");
                return false;
            }
        }

        // تابع برای بررسی رمز عبور در هنگام ارسال فرم
        function checkPassword() {
            const newPassword = document.getElementsByName('new-password')[0].value;
            const confirmPassword = document.getElementsByName('confirm-new-password')[0].value;

            if (!validatePassword(newPassword)) {
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert("رمز عبور جدید و تکرار آن باید یکسان باشد.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="box-container">
        <form action="inc/functions.php" method="post" onsubmit="return checkPassword()">
            <img class="logo" src="images/logo.png" alt="">

            <div class="change-password-text">تغییر رمز عبور</div>

            <div class="password-requirement">رمز عبور باید حداقل ۸ کاراکتر باشد</div>

            <div class="input-group input-group-old-password">
                <label for="new-password">رمز عبور جدید</label>
                <input type="password" id="new-password" name="new-password" maxlength="10" minlength="8">
            </div>

            <div class="input-group input-group-new-password">
                <label for="repeat-password">تکرار رمز عبور جدید</label>
                <input type="password" id="repeat-password" name="confirm-new-password" maxlength="10" minlength="8">
            </div>

            <button class="change-password-button" type="submit">تایید</button>
            <?php showMessage(); ?>
        </form>
    </div>
</body>

</html>
