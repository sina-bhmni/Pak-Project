<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/register_employee.css">

</head>

<body>

    <?php require_once 'header.php'; ?>
    <?php require_once 'right-box.php'; ?>

    <div class="new-box">
        <div class="right-text">ثبت کارمند جدید</div>
        <div class="left-text">
            <a href="employee_list.php" style="text-decoration: none; color: inherit;">لیست کارمندان</a>
        </div>
    </div>

    <div class="second-box">
        <div class="right-section">
            <i class="fas fa-user"></i>
            <span>اطلاعات پایه</span>
        </div>
        <div class="center-section">
            <i class="fas fa-id-badge"></i>
            <span>انتخاب سمت کارمند</span>
        </div>
        <div class="left-section">
            <span>تایید نهایی</span>
            <i class="fas fa-check"></i>
        </div>
    </div>

    <form action="../inc/manager.php" method="POST" class="form-container">

    <div class="column">
        <div class="editable-box">
            <i class="fas fa-user"></i>
            <input type="text" name="first_name" placeholder="نام" required style="all: unset; font-size: 16px; flex: 1;">
        </div>

        <div class="editable-box">
            <i class="fas fa-calendar-alt"></i>
            <input type="text" name="birth_date" placeholder="۱۳۸۲/۰۲/۰۳" required style="all: unset; font-size: 16px; flex: 1;">
        </div>
    </div>

    <div class="column">
        <div class="editable-box">
            <i class="fas fa-user"></i>
            <input type="text" name="last_name" placeholder="نام خانوادگی" required style="all: unset; font-size: 16px; flex: 1;">
        </div>

        <div class="degree-box">
            <i class="fas fa-user-graduate"></i>
            <select name="degree" required style="all: unset; font-size: 16px; flex: 1;">
                <option value="">انتخاب مقطع</option>
                <option value="کاردانی">کاردانی</option>
                <option value="کارشناسی">کارشناسی</option>
                <option value="کارشناسی ارشد">کارشناسی ارشد</option>
                <option value="دکترا">دکترا</option>
            </select>
        </div>
    </div>

    <div class="column">
        <div class="editable-box">
            <i class="fas fa-mobile-alt"></i>
            <input type="tel" name="mobile" placeholder="شماره همراه" required style="all: unset; font-size: 16px; flex: 1;">
        </div>
    </div>

    <div class="buttons-container">
        <button type="reset" class="custom-box cancel-box">
            لغو <span class="close-icon">×</span>
        </button>
        <button type="submit" name="do-insert-employee" class="custom-box next-step-box">
            مرحله بعد <span class="arrow-icon">›</span>
        </button>
    </div>

</form>


</body>

</html>