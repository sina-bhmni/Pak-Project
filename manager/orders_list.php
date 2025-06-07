<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>پنل مدیریتی وبسایت</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
  <link rel="stylesheet" href="../styles/manager/orders_list.css">

</head>

<body>

  <?php require_once 'header.php' ?>

  <?php require_once 'right-box.php' ?>

  <div class="new-box">

    <a href="register_order.php" style="text-decoration: none; color: inherit;">
      <div class="right-text">ثبت سفارش</div>
    </a>
    <div class="left-text">لیست مشتریان</div>
  </div>

  <!-- لیست مشتریان با تغییرات نهایی -->
  <?php


  $query = "SELECT orders.id, orders.customer_id, orders.service_type, orders.status, orders.created_at,
                 users.firstName, users.lastName
          FROM orders
          JOIN users ON orders.customer_id = users.id
          ORDER BY orders.created_at DESC";
  $result = mysqli_query($db, $query);
  ?>

  <div class="customer-list">
    <table>
      <thead>
        <tr>
          <th>ردیف</th>
          <th>کد مشتری</th>
          <th>کد پرداخت</th>
          <th>نام</th>
          <th>خانوادگی</th>
          <th>نوع خدمات</th>
          <th>وضعیت</th>
          <th>تاریخ ثبت سفارش</th>
          <th class="empty-header"></th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php $i = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td class="persian-number"><?= toPersianNumber($i++) ?></td>
              <td class="persian-number"><?= toPersianNumber($row['customer_id']) ?></td>
              <td class="persian-number"><?= toPersianNumber($row['id']) ?></td>
              <td><?= htmlspecialchars($row['firstName']) ?></td>
              <td><?= htmlspecialchars($row['lastName']) ?></td>
              <td><?= serviceToPersian($row['service_type']) ?></td>
              <td>
                <span class="status-<?= status_class($row['status']) ?>">
                  <?= statusToPersian($row['status']) ?>
                </span>
              </td>
              <td class="persian-number"><?= convert_date($row['created_at']) ?></td>
              <td>
                <div class="action-buttons">
                  <button class="delete-btn" data-id="<?= $row['id'] ?>" title="حذف">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="9">سفارشی ثبت نشده است.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <script>
     document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const orderId = this.getAttribute('data-id');

        if (!confirm('آیا از حذف این سفارش مطمئن هستید؟')) return;

        fetch('../inc/manager.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `action=delete_order&id=${orderId}`
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === 'success') {
                this.closest('tr').remove();
            } else {
                alert('خطا در حذف سفارش: ' + data);
            }
        })
        .catch(err => {
            console.error(err);
            alert('خطای ارتباط با سرور');
        });
    });
});
    </script>

  </div>