

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css">
    <link rel="stylesheet" href="../styles/manager/dashboard.css">

</head>

<body>
    <?php require_once 'header.php' ?>

    <?php require_once 'right-box.php' ?>


    </div>


    <div class="income-box">
        <div class="income-sticker">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="income-box-content">
            <div class="income-title">درآمد امروز</div>
            <div class="income-amount persian-number">
                <?php echo $income_display; ?> تومان
            </div>
        </div>
    </div>


    <div class="order-box">
        <div class="order-sticker">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <div class="order-box-content">
            <div class="order-title">تعداد سفارش‌های امروز</div>
            <div class="order-count persian-number"><?php echo toPersianNumber($order_count); ?></div>
        </div>
    </div>

    <div class="recent-orders-box">
        <div class="recent-orders-sticker">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="orders-title">سفارشات اخیر</div>
        <div class="orders-list">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="order-item">
                        <span class="order-number persian-number">
                            <?= toPersianNumber($row['id']) ?>
                            <?= htmlspecialchars($row['firstName']) ?> - <?= serviceToPersian($row['service_type']) ?>
                        </span>
                        <span class="order-status"><?= statusToPersian($row['status']) ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="order-item">سفارشی یافت نشد.</div>
            <?php endif; ?>
        </div>
    </div>

    

</body>

</html>