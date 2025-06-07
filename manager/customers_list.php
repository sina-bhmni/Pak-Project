<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>پنل مدیریتی وبسایت</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
  <link rel="stylesheet" href="../styles/manager/customers_list.css">

</head>

<body>

  <?php require_once 'header.php' ?>

  <?php require_once 'right-box.php' ?>


  <div class="new-box">
    <a href="register_customer.php" style="text-decoration: none; color: inherit;">ثبت مشتری </a>
    <div class="left-text">لیست مشتریان</div>
  </div>

  <!-- لیست مشتریان با ستون‌های کارکرد و هزینه خالی -->

  <?php
  $query = "SELECT * FROM users";
  $result = mysqli_query($db, $query);

  if (!$result) {
    echo "خطا در دریافت اطلاعات مشتری‌ها!";
    exit;
  }
  ?>

  <div class="customer-list">
    <div class="table-container">
      <table>
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="action" value="delete">
        <thead>
          <tr>
            <th>ردیف</th>
            <th>کد مشتری</th>
            <th>نام</th>
            <th>خانوادگی</th>
            <th>شماره همراه</th>
            <th>وضعیت</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM users WHERE role != 'manager'";
          
          $result = mysqli_query($db, $query);
          if (!$result) {
            echo "<tr><td colspan='9'>خطا در دریافت اطلاعات!</td></tr>";
          } else {
            $row_num = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                  <td class='persian-number'>{$row_num}</td>
                  <td class='persian-number'>{$row['id']}</td>
                  <td>{$row['firstName']}</td>
                  <td>{$row['lastName']}</td>
                  <td class='persian-number'>{$row['username']}</td>
                  <td><span class='status-active'>فعال</span></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class='action-buttons'>
                      <button class='edit-btn' title='ویرایش'><i class='fas fa-edit'></i></button>
                      <button class='delete-btn' title='حذف'><i class='fas fa-trash'></i></button>
                    </div>
                  </td>
              </tr>";
              $row_num++;
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
          const row = button.closest("tr");

          const codeCell = row.children[1]; // فرض: ستون کد مشتری دومین ستون است
          const fnameCell = row.children[2];
          const lnameCell = row.children[3];
          const phoneCell = row.children[4];

          if (button.classList.contains("edit-btn")) {
            // حالت ویرایش
            const fname = fnameCell.textContent.trim();
            const lname = lnameCell.textContent.trim();
            const phone = phoneCell.textContent.trim();

            // فقط فیلدهای نام و نام خانوادگی و تلفن را input می‌کنیم، کد مشتری ثابت است و بدون input باقی می‌ماند
            fnameCell.innerHTML = `<input type="text" value="${fname}" class="edit-input">`;
            lnameCell.innerHTML = `<input type="text" value="${lname}" class="edit-input">`;
            phoneCell.innerHTML = `<input type="text" value="${phone}" class="edit-input">`;

            button.innerHTML = '<i class="fas fa-check"></i>';
            button.title = "ذخیره";
            button.classList.remove("edit-btn");
            button.classList.add("save-btn");
          } else if (button.classList.contains("save-btn")) {
            // حالت ذخیره

            const newFname = fnameCell.querySelector("input").value;
            const newLname = lnameCell.querySelector("input").value;
            const newPhone = phoneCell.querySelector("input").value;
            const customerCode = codeCell.textContent.trim(); // کد مشتری را از متن ثابت می‌گیریم

            fetch('../inc/manager.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `code=${encodeURIComponent(customerCode)}&fname=${encodeURIComponent(newFname)}&lname=${encodeURIComponent(newLname)}&phone=${encodeURIComponent(newPhone)}&action=edit`
              })

              .then(response => response.text())
              .then(data => {
                if (data === "success") {
                  fnameCell.textContent = newFname;
                  lnameCell.textContent = newLname;
                  phoneCell.textContent = newPhone;

                  button.innerHTML = '<i class="fas fa-edit"></i>';
                  button.title = "ویرایش";
                  button.classList.remove("save-btn");
                  button.classList.add("edit-btn");
                }


              })
              .catch(error => {
                console.error('خطا:', error);
                alert("خطا در ارتباط با سرور");
              });
          }
        });
      });
    });

    document.addEventListener("DOMContentLoaded", function() {

      document.querySelectorAll(".edit-btn, .save-btn").forEach(button => {
        button.addEventListener("click", function() {
          const row = button.closest("tr");

          const codeCell = row.children[1]; // ستون کد مشتری
          const fnameCell = row.children[2];
          const lnameCell = row.children[3];
          const phoneCell = row.children[4];

          if (button.classList.contains("edit-btn")) {
            const fname = fnameCell.textContent.trim();
            const lname = lnameCell.textContent.trim();
            const phone = phoneCell.textContent.trim();

            fnameCell.innerHTML = `<input type="text" value="${fname}" class="edit-input">`;
            lnameCell.innerHTML = `<input type="text" value="${lname}" class="edit-input">`;
            phoneCell.innerHTML = `<input type="text" value="${phone}" class="edit-input">`;

            button.innerHTML = '<i class="fas fa-check"></i>';
            button.title = "ذخیره";
            button.classList.remove("edit-btn");
            button.classList.add("save-btn");
          } else if (button.classList.contains("save-btn")) {
            const newFname = fnameCell.querySelector("input").value;
            const newLname = lnameCell.querySelector("input").value;
            const newPhone = phoneCell.querySelector("input").value;
            const customerCode = codeCell.textContent.trim();

            fetch('../inc/manager.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `code=${encodeURIComponent(customerCode)}&fname=${encodeURIComponent(newFname)}&lname=${encodeURIComponent(newLname)}&phone=${encodeURIComponent(newPhone)}`
              })
              .then(response => response.text())
              .then(data => {
                if (data === "success") {
                  fnameCell.textContent = newFname;
                  lnameCell.textContent = newLname;
                  phoneCell.textContent = newPhone;

                  button.innerHTML = '<i class="fas fa-edit"></i>';
                  button.title = "ویرایش";
                  button.classList.remove("save-btn");
                  button.classList.add("edit-btn");
                }
              })
              .catch(error => {
                console.error('خطا:', error);
                alert("خطا در ارتباط با سرور");
              });
          }
        });
      });

      // بخش حذف
      document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
          if (!confirm("آیا مطمئن هستید که می‌خواهید این مشتری را حذف کنید؟")) return;

          const row = button.closest("tr");
          const customerCode = row.children[1].textContent.trim();

          fetch('../inc/manager.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: `code=${encodeURIComponent(customerCode)}&action=delete`


            })
            .then(response => response.text())
            .then(data => {
              if (data === "success") {
                row.remove(); // حذف ردیف از جدول
                alert("مشتری با موفقیت حذف شد.");
              } else {
                alert("خطا در حذف مشتری: " + data);
              }
            })
            .catch(error => {
              console.error('خطا:', error);
              alert("خطا در ارتباط با سرور");
            });
        });
      });
    });
  </script>

  <!-- CSS ساده برای ظاهر input هنگام ویرایش -->
  <style>
    .edit-input {
      width: 100%;
      padding: 4px;
      box-sizing: border-box;
      font-family: inherit;
    }
  </style>
</body>

</html>