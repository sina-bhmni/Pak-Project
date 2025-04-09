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

    // کوئری را به صورت prepared statement تغییر دهید
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
            header("Location: ../register.php");
        } else {
            // رمز عبور را به صورت هش ذخیره می‌کنیم
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // کوئری را به صورت prepared statement تغییر دهید
            $stmt = $db->prepare("INSERT INTO users (firstName, lastName, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $username, $passwordHash);
            $insert = $stmt->execute();

            if ($insert) {
                setMessage('ثبت نام با موفقیت انجام شد. هم اکنون وارد شوید');
                header("Location: ../login.php");
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

    // کوئری را به صورت prepared statement تغییر دهید
    $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // رمز عبور را با هش ذخیره شده مقایسه می‌کنیم
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = $username;

            if ($remember) {
                setcookie('username', $username, time() + (86400 * 30), "/");
                // ذخیره رمز عبور به صورت plain text در کوکی خطرناک است.
                // بهتر است از روش‌های امنیتی‌تر استفاده کنید.
            }

            header("Location: ../index.php");
        } else {
            setMessage('نام کاربری یا کلمه عبور اشتباه است.');
            header("Location: ../login.php");
        }
    } else {
        setMessage('نام کاربری یا کلمه عبور اشتباه است.');
        header("Location: ../login.php");
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
        header("Location: ../confirm.php"); 
    } else {
        setMessage('کاربر با این شماره تلفن یافت نشد.');
        header("Location: ../restore.php"); 
    }
}

if (isset($_POST['do-token'])) {
    $token = $_POST['token'];

    if ($token == '123456') { 
        header("Location: ../reset-password.php");
    } else {
        setMessage('کد تایید اشتباه است.');
        header("Location: ../confirm.php"); 
    }
}

// بررسی درخواست تغییر رمز عبور
if (isset($_POST['new-password']) && isset($_POST['confirm-new-password'])) {
    $newPassword = $_POST['new-password'];
    $confirmNewPassword = $_POST['confirm-new-password'];

    // دریافت نام کاربری از جلسه (session)
    if (!isset($_SESSION['username'])) {
        setMessage('نام کاربری در جلسه وجود ندارد.');
        header("Location: ../login.php");
        exit();
    }

    $username = $_SESSION['username'];

    if ($newPassword !== $confirmNewPassword) {
        setMessage('رمزهای عبور جدید مطابقت ندارند.');
        header("Location: ../reset-password.php");
        exit();
    }

    if (strlen($newPassword) < 8) {
        setMessage('رمز عبور باید حداقل ۸ حرف باشد.');
        header("Location: ../reset-password.php");
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
        header("Location: ../login.php"); // انتقال به صفحه ورود بعد از تغییر رمز عبور
        exit();
    } else {
        setMessage('خطایی در تغییر رمز عبور رخ داد.');
        header("Location: ../reset-password.php"); // بازگشت به صفحه تغییر رمز عبور در صورت بروز خطا
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
