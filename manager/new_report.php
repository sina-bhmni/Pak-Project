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

    <!-- باکس جدید اول -->
    <div class="new-box">
        <a href="new_report.php" style="text-decoration: none; color: black;" class="right-text">گزارش گیری جدید</a>
        <a href="reports_list.php" class="left-text" style="text-decoration: none; color: black;">لیست گزارش ها</a>
    </div>

    <form action="../inc/manager.php" method="POST" id="report-form">
        <!-- باکس‌های فرم -->

        <form action="/your-server-endpoint" method="POST">
            <div class="boxes-container">

                <!-- باکس بخش مورد نظر -->
                <div class="selection-box section-box">
                    <div class="section-title">
                        <span>بخش مورد نظر</span>
                    </div>
                    <div class="section-options">
                        <label class="section-option">
                            <input type="radio" name="section" value="سفارش">
                            <span>سفارش</span>

                        </label>
                        <label class="section-option">
                            <input type="radio" name="section" value="مشترکین">
                            <span>مشترکین</span>

                        </label>
                        <label class="section-option">
                            <input type="radio" name="section" value="انبار">
                            <span>انبار</span>

                        </label>
                        <label class="section-option">
                            <input type="radio" name="section" value="همه">
                            <span>همه</span>

                        </label>
                    </div>
                </div>

                <!-- باکس بازه مورد نظر -->
                <div class="selection-box period-box">
                    <div class="period-title">
                        <span>بازه مورد نظر</span>
                    </div>
                    <div class="period-options">
                        <label class="period-option">
                            <input type="radio" name="period" value="هفتگی">
                            <span>هفتگی</span>

                        </label>
                        <label class="period-option">
                            <input type="radio" name="period" value="ماهانه">
                            <span>ماهانه</span>

                        </label>
                        <label class="period-option">
                            <input type="radio" name="period" value="سه ماهه">
                            <span>سه ماهه</span>

                        </label>
                        <label class="period-option">
                            <input type="radio" name="period" value="شش ماهه">
                            <span>شش ماهه</span>

                        </label>
                        <label class="period-option">
                            <input type="radio" name="period" value="یکساله">
                            <span>یکساله</span>

                        </label>
                    </div>
                </div>

            </div>
            <!-- دکمه‌های فرم -->
            <div class="buttons-container">
                <div class="custom-box cancel-box" type="reset">
                    لغو <span class="close-icon">×</span>
                </div>
                <input type="hidden" name="action" value="get_report">

                <button type="submit" class="custom-box start-box">
                    شروع <span class="arrow-icon"><i class="fas fa-sync-alt"></i></span>
                </button>
            </div>
        </form>





        <!-- جدول نمایش داده‌ها -->
        <table class="summary-table">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>تعداد کل سفارش</th>
                    <th>سفارش تحویل داده شده</th>
                    <th>درآمد کل</th>
                    <th>بازه تاریخ</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>۱</td>
                    <td>۲۵</td>
                    <td>۲۰</td>
                    <td>۱۲۵۰۰۰۰۰تومان</td>
                    <td>۱۴۰۲/۰۲/۰۳</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </form>


    <!-- اسکریپت‌ها -->
    <script>
        // انتخاب گزینه‌های بخش مورد نظر
        document.querySelectorAll('.section-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.section-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input').checked = true;
            });
        });


        document.querySelectorAll('.period-option').forEach(label => {
            label.addEventListener('click', function() {
                // حذف کلاس selected از همه گزینه‌ها
                document.querySelectorAll('.period-option').forEach(opt => {
                    opt.classList.remove('selected');
                    opt.querySelector('input').checked = false;
                });

                // افزودن کلاس selected به گزینه انتخاب‌شده
                this.classList.add('selected');
                this.querySelector('input').checked = true;
            });
        });



        // انتخاب تاریخ
        document.querySelectorAll('.calendar-day:not(.other-month)').forEach(day => {
            day.addEventListener('click', function() {
                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
                const selectedDay = this.textContent.trim();
                const monthYear = document.querySelector('.calendar-title').textContent.trim();
                const fullDate = `${monthYear} / ${selectedDay}`;
                document.getElementById('selected-date-display').textContent = fullDate;
                document.getElementById('selected-date').value = fullDate;
            });
        });

        // چرخش آیکون شروع هنگام کلیک
        document.querySelector('.start-box').addEventListener('click', function() {
            const icon = this.querySelector('.arrow-icon i');
            icon.style.animation = 'spin 1s linear infinite';
            setTimeout(() => {
                icon.style.animation = 'none';
            }, 2000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>



</body>

</html>