<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/role.css">
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

    <div class="position-select-wrapper">
        <div class="position-select-container">
            <div class="position-select-box">
                <span>سمت کارمند را انتخاب کنید</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="position-options">
                <div class="position-option">
                    <span>مدیر</span>
                    <input type="checkbox">
                </div>
                <div class="position-option">
                    <span>ادمین</span>
                    <input type="checkbox">
                </div>
                <div class="position-option">
                    <span>کارگر</span>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        <div class="position-select-container">
            <div class="position-select-box">
                <span>سمت کارگر را انتخاب کنید</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="position-options">
                <div class="position-option">
                    <span>شستشو</span>
                    <input type="checkbox">
                </div>
                <div class="position-option">
                    <span>انباردار</span>
                    <input type="checkbox">
                </div>
                <div class="position-option">
                    <span>اتوزدن</span>
                    <input type="checkbox">
                </div>
                <div class="position-option">
                    <span>بسته بندی</span>
                    <input type="checkbox">
                </div>
            </div>
        </div>
    </div>

    <div class="permissions-table">
        <!-- ردیف اول -->
        <div class="permissions-row">
            <div class="permissions-cell">بخش</div>
            <div class="permissions-cell">مشاهده</div>
            <div class="permissions-cell">افزودن</div>
            <div class="permissions-cell">ویرایش</div>
            <div class="permissions-cell">حذف</div>
        </div>

        <!-- ردیف دوم -->
        <div class="permissions-row">
            <div class="permissions-cell">سفارش‌ها</div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
        </div>

        <!-- ردیف سوم -->
        <div class="permissions-row">
            <div class="permissions-cell">مشتریان</div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
        </div>

        <!-- ردیف چهارم -->
        <div class="permissions-row">
            <div class="permissions-cell">گزارش</div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
        </div>

        <!-- ردیف پنجم -->
        <div class="permissions-row">
            <div class="permissions-cell">انبار</div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
        </div>

        <!-- ردیف ششم (تنظیمات) -->
        <div class="permissions-row">
            <div class="permissions-cell">افزودن ادمین</div>
            <div class="permissions-cell settings-view-cell"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
            <div class="permissions-cell"><input type="checkbox" class="permissions-checkbox"></div>
        </div>
    </div>

    <div class="buttons-container">
        <div class="custom-box cancel-box">
            <span class="arrow-icon">
                <div><a href="employee-confirm.php" style=" text-decoration : none">
            </span> مرحله قبل
            </a>
        </div>
    </div><a href="employee-confirm.php" style=" text-decoration : none">
        <div class="custom-box next-step-box">
            مرحله بعد <span class="arrow-icon">></span>
        </div>
    </a>
    </div>

</body>

</html>