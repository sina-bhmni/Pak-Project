<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>پنل مدیریتی وبسایت</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css">
  <style>
    body {
      font-family: 'IRANSans', sans-serif;
      background: #E2E2E4;
      margin: 0;
      padding: 0;
    }

    .persian-number {
      font-family: 'IRANSans', sans-serif;
    }

    .horizontal-box {
      position: fixed;
      width: 1200px;
      height: 80px;
      top: 15px;
      right: 300px;
      background: #FFFFFF;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      z-index: 100;
      display: flex;
      align-items: center;
      padding-right: 20px;
      justify-content: space-between;
    }

    .search-container {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .search-box {
      display: flex;
      align-items: center;
      background: #E2E2E4;
      border-radius: 20px;
      padding: 0 15px;
      height: 36px;
      position: relative;
    }

    .search-box input {
      border: none;
      background: transparent;
      outline: none;
      width: 180px;
      font-size: 14px;
      color: #333;
      padding-right: 10px;
    }

    .search-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #3b13c2;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      position: absolute;
      left: 0;
    }

    .datetime {
      font-size: 14px;
      color: #555;
      white-space: nowrap;
      direction: rtl;
      unicode-bidi: embed;
    }

    .notification-bell {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #FFD700;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .notification-bell i {
      color: #333;
      font-size: 16px;
    }

    .profile-section {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
    }

    .profile-pic {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #007bff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 14px;
    }

    .profile-name {
      font-size: 14px;
      color: #333;
    }

    .profile-dropdown {
      font-size: 12px;
      color: #666;
    }

    .header-controls {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .horizontal-box .icon-text {
      display: flex;
      align-items: center;
      font-size: 35px;
      color: #333;
    }

    .horizontal-box .icon-text .title-text {
      font-weight: bold;
      margin-left: 70px;
    }

    .blue-arrow {
      color: #007bff;
      font-size: 35px;
      margin-right: 10px;
    }

    .right-box {
      width: 286px;
      height: 1024px;
      background: white;
      position: fixed;
      top: 1px;
      right: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 10;
      box-shadow: -2px 0 10px rgba(0,0,0,0.1);
    }

    .logo-container {
      position: absolute;
      top: 20px;
      right: 0;
      left: 0;
      z-index: 20;
      text-align: center;
      padding: 0 20px;
    }

    .logo {
      width: 100%;
      height: auto;
      max-height: 120px;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: block;
      margin: 0 auto;
    }

    .hamburger {
      height: 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      margin-top: 100px;
    }

    .hamburger div {
      height: 4px;
      background-color: #333;
      border-radius: 2px;
      margin: 3px 0;
    }
    
    .menu-icons {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
      gap: 25px;
    }

    .menu-icon {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      width: 200px;
      gap: 10px;
      font-size: 16px;
      color: #333;
      padding: 8px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .menu-icon i {
      font-size: 20px;
      width: 25px;
      text-align: center;
    }

    .menu-icon:hover {
      background-color: #f0f0f0;
      transform: translateX(-5px);
    }
    
    .service-list {
      position: fixed;
      width: 881px;
      height: 240px; 
      top: 239px;
      left: 170px;
      border-radius: 5px;
      background: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }
    
    .list-header {
      display: flex;
      background: #FF9D00;
      color: white;
      font-weight: bold;
      height: 60px;
      align-items: center;
      padding: 0 10px;
    }
    
    .list-row {
      display: flex;
      height: 60px;
      align-items: center;
      padding: 0 20px;
      border-bottom: 1px solid #eee;
    }
    
    .row-cell {
      width: 15%; 
      text-align: center;
      padding: 0 5px;
    }
    
    .empty-space {
      width: 60%; 
    }
    
    .data-row {
      display: flex;
      height: 60px;
      align-items: center;
      padding: 0 10px;
      border-bottom: 1px solid #eee;
      background: #f9f9f9;
    }

    .menu-exit {
      display: flex;
      display: inline-flex;
      width: 100%;
      gap: 800px;
      direction: ltr;
      flex-direction: row-reverse;
      justify-content: center;
      position: absolute;
      top: 680px;
    }
  </style>
</head>
<body>
  <div class="horizontal-box">
    <div class="icon-text">
      <span class="blue-arrow">></span>
      <span class="title-text">لیست خدمات </span>
    </div>
    <div class="header-controls">
      <div class="search-container">
        <span class="datetime persian-number">۱۴:۲۵:۳۵ | ۱۴۰۲/۰۲/۰۲</span>
        <div class="search-box">
          <input type="text" placeholder=" جستجو کنید...">
          <div class="search-icon">
            <i class="fas fa-search"></i>
          </div>
        </div>
      </div>
      <div class="notification-bell">
        <i class="fas fa-bell"></i>
      </div>
      <div class="profile-section">
        <div class="profile-pic">ا</div>
        <span class="profile-name">امیرحسین محمدی</span>
        <i class="fas fa-chevron-down profile-dropdown"></i>
      </div>
    </div>
  </div>

  <div class="right-box">
    <div class="logo-container">
      <img src="file:///C:/Users/0&1/Desktop/html.weresoft/pak.jpg" alt="PAK Logo" class="logo">
    </div>

    <div class="hamburger">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
      <div class="line4"></div>
    </div>

    <div class="menu-icons">
      <div class="menu-icon">
        <i class="fas fa-home dashboard-icon"></i> داشبورد
      </div>
      <div class="menu-icon">
        <i class="fas fa-tasks orders-icon"></i> سفارشات
      </div>
      <div class="menu-icon">
        <i class="fas fa-clipboard-list services-icon"></i> لیست خدمات
      </div>
      <div class="menu-icon">
        <i class="fas fa-user-circle profile-icon"></i> پروفایل
      </div>
      <div class="menu-icon">
        <i class="fas fa-headset support-icon"></i> ارتباط با پشتیبانی
      </div>
    </div>

    <!-- گزینه بازگشت (خروج) -->
    <div class="menu-exit">
      <div class="menu-icon"><i class="fas fa-sign-out-alt"></i> خروج</div>
    </div>
  </div>

  <!-- لیست خدمات با اطلاعات کامل -->
  <div class="service-list">
    <div class="list-header">
      <div class="row-cell">ردیف</div>
      <div class="row-cell">آیتم</div>
      <div class="row-cell">نوع خدمات</div>
      <div class="row-cell"> قیمت فی</div>
      <div class="empty-space"></div>
    </div>
    <div class="data-row">
      <div class="row-cell persian-number">۱</div>
      <div class="row-cell">پیراهن</div>
      <div class="row-cell">اتو کشی</div>
      <div class="row-cell persian-number">۱۵۰,۰۰۰ تومان</div>
      <div class="empty-space"></div>
    </div>
    <div class="data-row">
      <div class="row-cell persian-number">۲</div>
      <div class="row-cell">پیراهن</div>
      <div class="row-cell">لکه گیری</div>
      <div class="row-cell persian-number">۲۰,۰۰۰ تومان</div>
      <div class="empty-space"></div>
    </div>
    <div class="data-row">
      <div class="row-cell persian-number">۳</div>
      <div class="row-cell">پیراهن</div>
      <div class="row-cell">شستشو</div>
      <div class="row-cell persian-number">۴۵۰,۰۰۰ تومان</div>
      <div class="empty-space"></div>
    </div>
  </div>
</body>
</html>