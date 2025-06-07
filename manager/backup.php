<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/new_report.css">

</head>

<body>

    <?php require_once 'header.php'; ?>
    <?php require_once 'right-box.php'; ?>

    <div class="new-box">
        <div class="right-text"> پشتیبان گیری</div>
        
        <div class="left-text">لیست پشتیبان گیری</div>
    </div>

    <div class="boxes-container">
    <!-- بخش مورد نظر -->
    <div class="selection-box section-box">
        <div class="section-title">
            <span>بخش مورد نظر</span>
        </div>
        <div class="section-options">
            <label class="section-option">
                <input type="radio" name="section" value="order">
                <span>سفارش</span>
            </label>
            <label class="section-option">
                <input type="radio" name="section" value="subscribers">
                <span>مشترکین</span>
            </label>
            <label class="section-option">
                <input type="radio" name="section" value="warehouse">
                <span>انبار</span>
            </label>
            <label class="section-option">
                <input type="radio" name="section" value="all">
                <span>همه</span>
            </label>
        </div>
    </div>

    <!-- بازه مورد نظر -->
    <div class="selection-box period-box">
        <div class="period-title">
            <span>بازه مورد نظر</span>
        </div>
        <div class="period-options">
            <label class="period-option">
                <input type="radio" name="period" value="weekly">
                <span>هفتگی</span>
            </label>
            <label class="period-option">
                <input type="radio" name="period" value="monthly">
                <span>ماهانه</span>
            </label>
            <label class="period-option">
                <input type="radio" name="period" value="quarterly">
                <span>سه ماهه</span>
            </label>
            <label class="period-option">
                <input type="radio" name="period" value="semiannual">
                <span>شش ماهه</span>
            </label>
            <label class="period-option">
                <input type="radio" name="period" value="annual">
                <span>یکساله</span>
            </label>
        </div>
    </div>

    <!-- نوع ذخیره‌سازی -->
    <div class="selection-box storage-box">
        <div class="storage-title">
            <span>نوع ذخیره‌سازی</span>
        </div>
        <div class="storage-options">
            <label class="storage-option">
                <input type="radio" name="storage" value="cloud">
                <span>فضای ابری</span>
            </label>
            <label class="storage-option">
                <input type="radio" name="storage" value="harddisk">
                <span>هارد دیسک</span>
            </label>
        </div>
    </div>
</div>


    <div class="buttons-container">
        <div class="custom-box cancel-box">
            لغو <span class="close-icon">×</span>
        </div>
        <div class="custom-box start-box">
            شروع پشتیبانگیری <span class="arrow-icon"><i class="fas fa-sync-alt"></i></span>
        </div>
    </div>

    <table class="summary-table">
        <thead>
            <tr>
                <th>ردیف</th>
                <th> بخش</th>
                <th>بازه زمانی</th>
                <th> محل ذخیره سازی</th>
                <th> توسط کی انجام شده</th>
                <th>تاریخ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>۱</td>
                <td>سفارش</td>
                <td>روزانه</td>
                <td>هارد دیسک</td>
                <td> مدیر</td>
                <td>۱۴۰۲/۰۲/۰۳</td>

                <td></td>
            </tr>
        </tbody>
    </table>

    <script>
        document.querySelectorAll('.section-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.section-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });

        document.querySelectorAll('.period-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.period-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });

        document.querySelectorAll('.storage-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.storage-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });

        document.querySelector('.start-box').addEventListener('click', function() {
            const icon = this.querySelector('.arrow-icon i');
            icon.style.animation = 'spin 1s linear infinite';

            setTimeout(() => {
                icon.style.animation = 'none';
            }, 2000);
        });
    </script>

</body>

</html>