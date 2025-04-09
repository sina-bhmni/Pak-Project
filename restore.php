<?php require_once 'inc/functions.php'; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازیابی رمز عبور</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles/restore/restore-styles.css">
</head>

<body>
    <div class="body-container">
        <div class="box-container">
            <form action="inc/functions.php" method="post">
                <img class="logo" src="images/logo.png" alt="">
                <div class="phone-label">بازیابی رمز عبور</div>
                <div class="phone-instruction">لطفا شماره تلفن خود را وارد کنید.</div>
                <div class="input-group">
                    <input type="text" class="username" name="username" maxlength="10" placeholder="0000 000 921">
                </div>

                <button class="send-code-button" name="do-reset">ورود</button>
                <?php  showMessage(); ?>
            </form>
        </div>
    </div>
</body>

</html>