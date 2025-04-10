

<?php 

require_once 'inc/functions.php'; 
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید کد</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles/restore/confirm.css">

</head>

<body>
    <div class="box-container">
        <form action="inc/functions.php" method="post">
            <img class="logo" src="images/logo.png" alt="">

            <h2><strong>کد تایید را وارد کنید</strong></h2>

            <!-- <p class="verification-info">کد تأیید به شماره ۰۹۱۲۰۰۰۰۰۰۰ ارسال گردید.</p> -->
            <p class="verification-info">کد تأیید به نام کاربری <?php echo $_SESSION['username']; ?> ارسال گردید.</p>


            <div class="input-group">
                <input type="text" name="token" id="verification-code" maxlength="6">
            </div>

            <p class="countdown-message" id="countdown">۰۱:۳۰ مانده تا دریافت مجدد کد</p>

            <button class="button" name="do-token">تایید</button>
            <?php showMessage(); ?>
        </form>
    </div>

    <script>
        let countdown = 90;
        let countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            let minutes = Math.floor(countdown / 60);
            let seconds = countdown % 60;

            if (countdown > 0) {
                countdownElement.textContent = `${padZero(minutes)}:${padZero(seconds)} مانده تا دریافت مجدد کد`;
            } else {
                countdownElement.textContent = 'ارسال مجدد کد';
                countdownElement.style.cursor = 'pointer';
                countdownElement.onclick = function() {
                    window.location.href = window.location.href;
                };
            }

            countdown -= 1;

            if (countdown >= 0) {
                setTimeout(updateCountdown, 1000);
            }
        }

        function padZero(number) {
            return (number < 10 ? '0' : '') + number;
        }

        updateCountdown();
    </script>

</body>

</html>
