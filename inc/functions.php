<?php
require_once 'db.php';
session_start();

// add new user
if (isset($_POST['do-register'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passConf = $_POST['pass-conf'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        setMessage('کاربری با این نام کاربری قبلا ثبت نام کرده است...');
        header("Location: ../register.php");
    } else {
        if ($password != $passConf) {
            setMessage('رمز عبور و تکرار آن باهم برابر نیستند');
            header("Location: ../auth/register.php");
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'customer'; // مقدار پیش‌فرض برای کاربران جدید

            $stmt = $db->prepare("INSERT INTO users (firstName, lastName, username, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $username, $passwordHash, $role);
            $insert = $stmt->execute();

            if ($insert) {
                setMessage('ثبت نام با موفقیت انجام شد. هم اکنون وارد شوید');
                header("Location: ../auth/login.php");
            } else {
                echo 'error';
            }
        }
    }
}

// check login
if (isset($_POST['do-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // مقداردهی اولیه متغیرهای سشن برای تلاش‌های ناموفق و زمان قفل
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }
    if (!isset($_SESSION['lock_time'])) {
        $_SESSION['lock_time'] = 0;
    }

    // بررسی قفل بودن حساب
    if (time() < $_SESSION['lock_time']) {
        $remaining = $_SESSION['lock_time'] - time();
        setMessage("شما به دلیل تلاش‌های ناموفق زیاد، لطفا {$remaining} ثانیه صبر کنید و دوباره تلاش کنید.");
        header("Location: ../auth/login.php");
        exit();
    }

    // جستجو در دیتابیس برای نام کاربری
    $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // بررسی صحت رمز عبور
        if (password_verify($password, $user['password'])) {
            // ورود موفق: ریست کردن شمارش تلاش‌ها و زمان قفل
            $_SESSION['login_attempts'] = 0;
            $_SESSION['lock_time'] = 0;

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role']; // ذخیره نقش کاربر در سشن

            if ($remember) {
                setcookie('username', $username, time() + (86400 * 30), "/");
            }
            // بعد از لاگین موفق (مثلاً login.php)
            
            $_SESSION['user_id'] = $user['id'];
            
            // تغییر مسیر بر اساس نقش کاربر
            if ($user['role'] === 'manager') {
                header("Location: ../manager/dashboard.php"); // مسیر پنل مدیریت
            } else {
                header("Location: ../customer/dashboard.php"); // مسیر پنل مشتری
            }
            exit();
        } else {
            // ورود ناموفق: افزایش تعداد تلاش‌ها
            $_SESSION['login_attempts']++;

            if ($_SESSION['login_attempts'] >= 5) {
                $_SESSION['lock_time'] = time() + 20;
                setMessage('تعداد تلاش‌های ناموفق زیاد است. لطفا 20 ثانیه صبر کنید.');
            } else {
                setMessage('نام کاربری یا کلمه عبور اشتباه است.');
            }
            header("Location: ../auth/login.php");
            exit();
        }
    } else {
        setMessage('نام کاربری یا کلمه عبور اشتباه است.');
        header("Location: ../auth/login.php");
        exit();
    }
}



// check reset password
if (isset($_POST['do-reset'])) {
    $username = $_POST['username'];

    // کوئری را به صورت prepared statement تغییر دهید
    $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username; // ذخیره نام کاربری در session
        header("Location: ../auth/confirm.php");
    } else {
        setMessage('کاربر با این شماره تلفن یافت نشد.');
        header("Location: ../auth/restore.php");
    }
}

if (isset($_POST['do-token'])) {
    $token = $_POST['token'];

    if ($token == '123456') {
        header("Location: ../auth/reset-password.php");
    } else {
        setMessage('کد تایید اشتباه است.');
        header("Location: ../auth/confirm.php");
    }
}

// بررسی درخواست تغییر رمز عبور
if (isset($_POST['new-password']) && isset($_POST['confirm-new-password'])) {
    $newPassword = $_POST['new-password'];
    $confirmNewPassword = $_POST['confirm-new-password'];

    // دریافت نام کاربری از جلسه (session)
    if (!isset($_SESSION['username'])) {
        setMessage('نام کاربری در جلسه وجود ندارد.');
        header("Location: ../auth/login.php");
        exit();
    }

    $username = $_SESSION['username'];

    if ($newPassword !== $confirmNewPassword) {
        setMessage('رمزهای عبور جدید مطابقت ندارند.');
        header("Location: ../auth/reset-password.php");
        exit();
    }

    if (strlen($newPassword) < 8) {
        setMessage('رمز عبور باید حداقل ۸ حرف باشد.');
        header("Location: ../auth/reset-password.php");
        exit();
    }

    // رمز عبور جدید را به صورت هش ذخیره می‌کنیم
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

    // کوئری را به صورت prepared statement تغییر دهید
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $newPasswordHash, $username);
    $result = $stmt->execute();

    if ($result) {
        setMessage('رمز عبور با موفقیت تغییر یافت.');
        header("Location: ../auth/login.php"); // انتقال به صفحه ورود بعد از تغییر رمز عبور
        exit();
    } else {
        setMessage('خطایی در تغییر رمز عبور رخ داد.');
        header("Location: ../auth/reset-password.php"); // بازگشت به صفحه تغییر رمز عبور در صورت بروز خطا
        exit();
    }
}

// set message
function setMessage($message)
{
    $_SESSION['message'] = $message;
}

// show message
function showMessage()
{
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-warning m-3'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
    }
}
