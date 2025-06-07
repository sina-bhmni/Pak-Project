<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/register_customer.css">
</head>

<body>

    <?php require_once 'header.php' ?>

    <?php require_once 'right-box.php' ?>

    <!-- باکس جدید اول -->
    <div class="new-box">
        <div class="right-text">ثبت مشتری</div>
        <div class="left-text">
            <a href="customers_list.php" style="text-decoration: none; color: inherit;">لیست مشتریان</a>
        </div>
    </div>


    <!-- نوار بالا -->
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

    <!-- فرم اطلاعات -->
    <form id="customer-form" action="../inc/manager.php" method="POST">
    <div class="form-container">

        <!-- این خط جدید برای فعال شدن PHP -->
        <input type="hidden" name="do-insert-customer" value="1">

        <!-- ستون راست -->
        <div class="column">
            <div class="input-box">
                <label for="first_name"><i class="fas fa-user"></i> نام</label>
                <input type="text" id="first_name" name="first_name" placeholder="مثلاً: علی" required>
            </div>

            <div class="input-box">
                <label><i class="fas fa-venus-mars"></i> جنسیت</label>
                <div class="gender-options">
                    <label>
                        <input type="radio" name="gender" value="male" required> مرد
                    </label>
                    <label>
                        <input type="radio" name="gender" value="female"> زن
                    </label>
                </div>
            </div>
        </div>

        <!-- ستون وسط -->
        <div class="column">
            <div class="input-box">
                <label for="last_name"><i class="fas fa-user"></i> نام خانوادگی</label>
                <input type="text" id="last_name" name="last_name" placeholder="مثلاً: محمدی" required>
            </div>

            <div class="input-box">
                <label for="dob"><i class="fas fa-calendar-alt"></i> تاریخ تولد</label>
                <input type="text" id="dob" name="dob" placeholder="مثلاً: ۱۳۸۲/۰۲/۰۳">
            </div>
        </div>

        <!-- ستون چپ -->
        <div class="column">
            <div class="input-box">
                <label for="mobile"><i class="fas fa-mobile-alt"></i> شماره همراه</label>
                <input type="text" id="mobile" name="mobile" placeholder="مثلاً: 09121234567" required>
            </div>
        </div>

    </div>

    <!-- دکمه‌ها -->
    <div class="buttons-container">
        <!-- دکمه لغو با ریست فرم -->
        <button type="button" class="custom-box cancel-box" onclick="document.getElementById('customer-form').reset();">
            لغو <span class="close-icon">×</span>
        </button>

        <!-- دکمه مرحله بعد -->
        <button type="submit" class="custom-box next-step-box">
            مرحله بعد <span class="arrow-icon">›</span>
        </button>
    </div>
    <div style="position: absolute; top: 135px; right: 1220px;"><?php showMessage(); ?></div>
</form>




</body>

</html>