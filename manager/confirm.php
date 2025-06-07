<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/confirm.css">

</head>

<body>

    <?php require_once 'header.php' ?>

    <?php require_once 'right-box.php' ?>

    <div class="new-box">
        <div class="right-text">ثبت مشتری</div>
        <div class="left-text">
            <a href="customers_list.php" style="text-decoration: none; color: inherit;">لیست مشتریان</a>
        </div>
    </div>

    <div class="second-box">
        <div class="right-section">
            <i class="fas fa-user"></i>
            <span>اطلاعات پایه</span>
        </div>
        <div class="center-section">
            <i class="fas fa-home"></i>
            <span>اطلاعات آدرس</span>
        </div>
        <div class="left-section">
            <span>تایید نهایی</span>
            <i class="fas fa-check"></i>
        </div>
    </div>

    <!-- باکس تأیید ثبت مشتری -->
    <div class="confirmation-box">
            <div class="check-icon">
            <i class="fas fa-check"></i>
        </div>
        <div class="message-section">
            <h3>مشتری با موفقیت ثبت شد</h3>
            <div class="customer-info">
                <?php if (isset($_SESSION['customer_info'])): ?>
                    <p>کد مشتری : <span class="persian-number"><?= $_SESSION['customer_info']['id'] ?></span></p>
                    <p>نام کاربری : <span class="persian-number"><?= $_SESSION['customer_info']['username'] ?></span></p>
                    <p>رمز عبور : <span class="persian-number"><?= $_SESSION['customer_info']['password'] ?></span></p>
                <?php else: ?>
                    <p>اطلاعاتی برای نمایش وجود ندارد.</p>
                <?php endif; ?>
            </div>
            <!-- دکمه ارسال پیام -->
            <div class="send-box" id="sendSmsBtn" data-username="<?= $_SESSION['customer_info']['username'] ?>">
                <i class="fas fa-sms"></i>
                <span>ارسال به شماره همراه</span>
            </div>





        </div>
    </div>



    <button class="confirm-button">
        <i class="fas fa-check"></i>
        <a href="register_customer.php" style="text-decoration: none;"><span>تایید</span></a>
    </button>


    <script>
        document.getElementById('sendSmsBtn').addEventListener('click', function() {
            const username = this.getAttribute('data-username');
            alert('پیام برای نام کاربری ' + username + ' ارسال شد');
        });
    </script>
</body>

</html>