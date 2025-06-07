<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>پنل مدیریتی وبسایت</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
  <link rel="stylesheet" href="../styles/manager/address.css">

</head>

<body>

  <?php require_once 'header.php' ?>

  <?php require_once 'right-box.php' ?>

  <div class="new-box">
    <div class="right-text">ثبت مشتری</div>
    <div class="left-text">
      <a href="customers_list.php" style="text-decoration: none; color: inherit;">لیست مشتریان</a>
    </div>
  </div>

  <div class="second-box">
    <div class="right-section">
      <i class="fas fa-user"></i>
      <span>اطلاعات پایه</span>
    </div>
    <div class="center-section">
      <i class="fas fa-home"></i>
      <span>اطلاعات آدرس</span>
    </div>
    <div class="left-section">
      <span>تایید نهایی</span>
      <i class="fas fa-check"></i>
    </div>
  </div>

  <form class="form-container" action="submit-address.php" method="POST">
  <div class="column">
    <div class="editable-box">
      <i class="fas fa-map-marker-alt"></i>
      <input type="text" name="address_title" placeholder="عنوان آدرس" required>
    </div>

    <div class="description-box">
      <i class="fas fa-align-left"></i>
      <textarea class="description-text" name="description" placeholder="توضیحات بیشتر در مورد آدرس"></textarea>
    </div>
  </div>

  <div class="column">
    <div class="editable-box">
      <i class="fas fa-building"></i>
      <input type="text" name="city" placeholder="شهر" required>
    </div>
  </div>

  <div class="column">
    <div class="editable-box">
      <i class="fas fa-road"></i>
      <input type="text" name="street" placeholder="خیابان" required>
    </div>
  </div>

  <div class="buttons-container">
    
    <a href="register_customer.php"  style="text-decoration: none;" class="custom-box cancel-box">مرحله قبل</a>
    
    
    <a href="confirm.php"  style="text-decoration: none;" class="custom-box cancel-box">مرحله بعد</a>
    
  </div>
</form>

</body>

</html>