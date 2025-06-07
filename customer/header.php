<?php 
require_once '../inc/functions.php';
require_once '../inc/db.php';
require_once '../inc/manager.php';
require_once '../inc/jdf.php';

$fullname = $_SESSION['username'];

$initial = mb_substr($fullname, 0, 1);
?>

<div class="horizontal-box">
        <div class="icon-text">
            <span class="blue-arrow">></span>
            <span class="title-text">پنل مدیریتی وبسایت</span>
        </div>
        <div class="header-controls">
            <div class="search-container">
                <span class="datetime persian-number">۱۴:۲۵:۳۵ | ۱۴۰۲/۰۲/۰۲</span>
                <div class="search-box">
                    <form action="../inc/manager.php" method="get">
                        <input type="text" name="search" placeholder="جستجو کنید..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    </form>
                    <div class="search-icon" onclick="this.closest('form').submit()">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="notification-bell">
                <i class="fas fa-bell"></i>
            </div>
            <div class="profile-section">
                <div class="profile-pic"><?= htmlspecialchars($initial) ?></div>
                <span class="profile-name"><?= htmlspecialchars($fullname) ?></span>
                <i class="fas fa-chevron-down profile-dropdown"></i>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jalaali-js/dist/jalaali.min.js"></script>
    <script>
        function updateDateTime() {
            const now = new Date();
            const time = now.toLocaleTimeString('fa-IR', {
                hour12: false
            });

            const j = jalaali.toJalaali(now.getFullYear(), now.getMonth() + 1, now.getDate());
            const date = `${j.jy}/${String(j.jm).padStart(2, '0')}/${String(j.jd).padStart(2, '0')}`;

            document.querySelector('.datetime').innerText = `${time} | ${date}`;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>