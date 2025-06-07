<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>پنل مدیریتی وبسایت</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
  <link rel="stylesheet" href="../styles/manager/warehouse.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- اضافه کردن jQuery برای AJAX -->
</head>

<body>
  <?php
  // فعال کردن نمایش خطاها برای دیباگ
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // اتصال به دیتابیس
  require_once 'header.php';

  // چک کردن اتصال به دیتابیس
  if (!isset($db) || !$db) {
    echo "<p style='color: red; text-align: center;'>خطا: اتصال به دیتابیس برقرار نیست! " . mysqli_connect_error() . "</p>";
    exit;
  }

  // تنظیم charset برای پشتیبانی از فارسی
  mysqli_set_charset($db, 'utf8mb4');

  // کوئری برای دریافت داده‌ها
  $query = "SELECT id, product_name, product_type, quantity, min_quantity FROM inventory ORDER BY id DESC";
  $result = mysqli_query($db, $query);

  // بررسی خطای کوئری
  if (!$result) {
    echo "<p style='color: red; text-align: center;'>خطای کوئری: " . mysqli_error($db) . "</p>";
    echo "<p>کوئری اجرا شده: $query</p>";
    exit;
  }

  // بررسی تعداد ردیف‌ها
  $row_count = mysqli_num_rows($result);
  echo "<!-- Debug: تعداد ردیف‌های برگشتی: $row_count -->";
  ?>

  <?php require_once 'right-box.php' ?>

  <!-- باکس جدید ثبت موجودی انبار -->
  <div class="new-inventory-box" id="new-inventory-box">
    <i class="fas fa-plus"></i> ثبت موجودی انبار
  </div>

  <!-- لیست مشتریان با تغییرات درخواستی -->
  <div class="customer-list">
    <div class="table-scroll">
      <table id="inventory-table">
        <thead>
          <tr>
            <th>ردیف</th>
            <th>نام محصول</th>
            <th>نوع محصول</th>
            <th>تعداد</th>
            <th>حداقل موجودی</th>
            <th></th> <!-- وضعیت -->
            <th></th> <!-- کارکرد -->
            <th></th> <!-- هزینه -->
            <th></th> <!-- عملیات -->
          </tr>
        </thead>
        <tbody>
          <?php
          if ($row_count > 0) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              // چاپ داده‌های خام برای دیباگ
              echo "<!-- Debug Row $i: " . print_r($row, true) . " -->";
              // چک کردن وجود کلیدها
              $product_name = isset($row['product_name']) ? htmlspecialchars($row['product_name']) : 'ناموجود';
              $product_type = isset($row['product_type']) ? htmlspecialchars($row['product_type']) : 'ناموجود';
              $quantity = isset($row['quantity']) ? htmlspecialchars($row['quantity']) : 'ناموجود';
              $min_quantity = isset($row['min_quantity']) ? htmlspecialchars($row['min_quantity']) : 'ناموجود';
              $id = isset($row['id']) ? $row['id'] : '';

              echo "<tr>
                <td class='persian-number'>{$i}</td>
                <td class='persian-number'>{$product_name}</td>
                <td>{$product_type}</td>
                <td>{$quantity}</td>
                <td class='persian-number'>{$min_quantity}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <div class='action-buttons'>
                    <button class='edit-btn' title='ویرایش'><i class='fas fa-edit'></i></button>
                    <button class='delete-btn' data-id='{$id}' title='حذف'><i class='fas fa-trash'></i></button>
                  </div>
                </td>
              </tr>";
              $i++;
            }
          } else {
            echo "<tr><td colspan='9'>موردی برای نمایش وجود ندارد.</td></tr>";
            echo "<!-- Debug: هیچ داده‌ای در جدول inventory وجود ندارد -->";
          }
          // آزاد کردن نتیجه کوئری
          if (isset($result)) {
            mysqli_free_result($result);
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // کلیک روی باکس ثبت موجودی
      $('#new-inventory-box').click(function() {
        // بررسی اینکه آیا ردیف ورودی قبلاً وجود داره
        if ($('#new-row').length > 0) {
          alert('لطفاً ابتدا ردیف فعلی را تأیید یا لغو کنید.');
          return;
        }

        // اضافه کردن ردیف جدید با اینپوت‌ها
        const newRow = `
          <tr id="new-row">
            <td class="persian-number"></td>
            <td><input type="text" id="new-product-name" class="form-input" placeholder="نام محصول"></td>
            <td><input type="text" id="new-product-type" class="form-input" placeholder="نوع محصول"></td>
            <td><input type="number" id="new-quantity" class="form-input" placeholder="تعداد" min="0"></td>
            <td><input type="number" id="new-min-quantity" class="form-input" placeholder="حداقل موجودی" min="0"></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <div class="action-buttons">
                <button class="confirm-btn" title="تأیید"><i class="fas fa-check"></i></button>
                <button class="cancel-btn" title="لغو"><i class="fas fa-times"></i></button>
              </div>
            </td>
          </tr>`;
        $('#inventory-table tbody').prepend(newRow);
      });

      // هندل کردن کلیک روی دکمه تأیید
      $(document).on('click', '.confirm-btn', function() {
        const productName = $('#new-product-name').val().trim();
        const productType = $('#new-product-type').val().trim();
        const quantity = $('#new-quantity').val().trim();
        const minQuantity = $('#new-min-quantity').val().trim();

        // اعتبارسنجی
        if (!productName || !productType || !quantity || !minQuantity) {
          alert('لطفاً همه فیلدها را پر کنید.');
          return;
        }
        if (quantity < 0 || minQuantity < 0) {
          alert('تعداد و حداقل موجودی نمی‌توانند منفی باشند.');
          return;
        }

        // ارسال داده‌ها به سرور با AJAX
        $.ajax({
          url: '../inc/manager.php',
          type: 'POST',
          data: {
            product_name: productName,
            product_type: productType,
            quantity: quantity,
            min_quantity: minQuantity
          },
          success: function(response) {
            try {
              const res = JSON.parse(response);
              if (res.success) {
                // اضافه کردن ردیف جدید به جدول
                const newRow = `
                  <tr>
                    <td class="persian-number">${$('#inventory-table tbody tr').length + 1}</td>
                    <td class="persian-number">${productName}</td>
                    <td>${productType}</td>
                    <td>${quantity}</td>
                    <td class="persian-number">${minQuantity}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="action-buttons">
                        <button class="edit-btn" title="ویرایش"><i class="fas fa-edit"></i></button>
                        <button class="delete-btn" data-id="${res.id}" title="حذف"><i class="fas fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>`;
                $('#new-row').remove(); // حذف ردیف اینپوت
                $('#inventory-table tbody').prepend(newRow);

                $('#no-data-message').remove();
              } else {
                alert('خطا در ثبت داده‌ها: ' + res.message);
              }
            } catch (e) {
              alert('خطا در پردازش پاسخ سرور.');
            }
          },
          error: function() {
            alert('خطا در ارتباط با سرور.');
          }
        });
      });

      // هندل کردن کلیک روی دکمه لغو
      $(document).on('click', '.cancel-btn', function() {
        $('#new-row').remove();
      });
    });
  </script>
</body>
</html>