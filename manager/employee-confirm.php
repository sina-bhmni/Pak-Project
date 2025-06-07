<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>پنل مدیریتی وبسایت</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
  <link rel="stylesheet" href="../styles/manager/employee-confirm.css">

</head>

<body>



  <?php require_once 'header.php'; ?>
  <?php require_once 'right-box.php';
  if (!isset($_SESSION['employee_info'])) {
    header("Location: register_employee.php");
    exit;
  }

  $employee = $_SESSION['employee_info'];
  unset($_SESSION['employee_info']); ?>

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
      <span> انتخاب سمت کارمند</span>
    </div>
    <div class="left-section">
      <span>تایید نهایی</span>
      <i class="fas fa-check"></i>
    </div>
  </div>

  <!-- باکس تأیید ثبت مشتری -->
  <div class="confirmation-box">
    <div class="check-icon">
      <i class="fas fa-check"></i>
    </div>
    <div class="message-section">
      <h3>کارمند جدید با موفقیت ثبت شد</h3>
      <div class="customer-info">
        <p>کد پرسنلی : <span class="persian-number"><?php echo toPersianNumber($employee['id']); ?></span></p>
        <p>نام کاربری : <span class="persian-number"><?php echo htmlspecialchars($employee['username']); ?></span></p>
        <p>رمز عبور : <span class="persian-number"><?php echo htmlspecialchars($employee['password']); ?></span></p>
      </div>
      <div class="send-box" id="sendSMS">
        <i class="fas fa-sms"></i>
        <span>ارسال به شماره همراه</span>
      </div>

    </div>
  </div>

  <!-- دکمه تایید -->
  <button class="confirm-button">
    <i class="fas fa-check"></i>
    <span>تایید</span>
  </button>
  <script>
    document.getElementById("sendSMS").addEventListener("click", function() {
      let username = "<?php echo $employee['username']; ?>";
      alert("پیام به شماره " + username + " ارسال شد.");
    });
  </script>

</body>

</html>