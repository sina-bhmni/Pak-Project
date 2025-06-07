<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/reports_list.css">

</head>

<body>

    <?php require_once 'header.php'; ?>
    <?php require_once 'right-box.php'; ?>


    <div class="new-box">
        <a href="new_report.php" style="text-decoration: none; color:black;" class="right-text">گزارش گیری جدید</a>
        <div class="left-text">لیست گزارش‌ها</div>
    </div>


    <!-- جدول جدید با 3 ردیف و ستون عملیات خالی -->
    <?php
    // فرض: اتصال به دیتابیس در $db هست

    $query = "
    SELECT r.id, r.section, r.duration, r.report_date, u.firstName, u.lastName
    FROM reports r
    JOIN users u ON r.created_by = u.id
    ORDER BY r.report_date DESC
";

    $result = $db->query($query);

    ?>

    <div class="report-list">
        <table>
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>بخش مورد نظر</th>
                    <th>مدت زمان گزارش</th>
                    <th>تاریخ</th>
                    <th>توسط کی انجام شده</th>
                    <th></th> <!-- ستون خالی برای عملیات -->
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    // تبدیل تاریخ میلادی به شمسی یا نمایش ساده میلادی:
                    $reportDate = $row['report_date']; // می‌تونی تبدیل کنی اگر شمسی لازم داری
                    $fullName = htmlspecialchars($row['firstName'] . ' ' . $row['lastName']);
                    echo "<tr>";
                    echo "<td class='persian-number'>{$counter}</td>";
                    echo "<td>" . htmlspecialchars($row['section']) . "</td>";
                    echo "<td class='persian-number'>" . htmlspecialchars($row['duration']) . "</td>";
                    echo "<td class='persian-number'>{$reportDate}</td>";
                    echo "<td>{$fullName}</td>";
                    echo "<td></td>";
                    echo "</tr>";
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>