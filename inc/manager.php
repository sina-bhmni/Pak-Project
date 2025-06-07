<?php
require_once '../inc/functions.php';
require_once '../inc/db.php';





// تاریخ امروز (فرمت Y-m-d)
$today = date('Y-m-d');

// کوئری برای جمع درآمد امروز
$sql = "SELECT SUM(total_price) AS income_today FROM orders WHERE DATE(created_at) = '$today'";
$result = $db->query($sql);

$income_today = 0;
if ($result && $row = $result->fetch_assoc()) {
    $income_today = $row['income_today'] ?? 0;
}
$income_display = toPersianNumber($income_today);





//  شمارش تعداد سفارش‌های امروز
$sql = "SELECT COUNT(*) AS order_count FROM orders WHERE DATE(created_at) = '$today'";
$result = $db->query($sql);

$order_count = 0;
if ($result && $row = $result->fetch_assoc()) {
    $order_count = $row['order_count'];
}
$limit = 3;



//  گرفتن سفارشات اخیر
$sql = "SELECT o.id, o.service_type, o.status, u.firstName, u.lastname 
        FROM orders o
        JOIN users u ON o.customer_id = u.id
        ORDER BY o.created_at DESC
        LIMIT $limit";
$result = $db->query($sql);


// do-insert-customer

if (isset($_POST['do-insert-customer'])) {
    session_start();
    $firstName = $_POST['first_name'];
    $lastName  = $_POST['last_name'];
    $mobile    = $_POST['mobile'];
    $username  = $mobile;          // موبایل به‌عنوان نام‌کاربری
    $password  = $mobile;          // رمز پیش‌فرض برابر موبایل
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'customer';

    // بررسی تکراری نبودن نام‌کاربری
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        setMessage('کاربری با این شماره قبلاً ثبت شده است.');
        header("Location: ../manager/register_customer.php");
        exit;
    } else {
        $stmt = $db->prepare("INSERT INTO users (firstName, lastName, username, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $username, $passwordHash, $role);
        $insert = $stmt->execute();

        if ($insert) {
            $newId = $db->insert_id;
            $_SESSION['customer_info'] = [
                'id'       => $newId,
                'username' => $username,
                'password' => $password
            ];
            header("Location: ../manager/address.php");
            exit;
        } else {
            setMessage('خطا در ثبت مشتری.');
            header("Location: ../manager/register_customer.php");
            exit;
        }
    }
}





function getOrdersList($limit = null)
{
    global $db;
    $sql = "SELECT o.*, u.firstName, u.lastName FROM orders o JOIN users u ON o.customer_id = u.id ORDER BY o.created_at DESC";
    if ($limit) {
        $sql .= " LIMIT " . intval($limit);
    }
    $result = $db->query($sql);
    $orders = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    return $orders;
}

/**
 * تبدیل وضعیت سفارش به کلاس نمایشی برای رنگ‌بندی
 */
function status_class($status)
{
    return match ($status) {
        'pending' => 'status-pending',
        'completed' => 'status-completed',
        'cancelled' => 'status-cancelled',
        'delivered' => 'status-delivered',
        'processing' => 'status-in-progress',
        default => 'status-unknown',
    };
}

/**
 * تبدیل وضعیت انگلیسی به فارسی
 */
function statusToPersian($status)
{
    return match ($status) {
        'pending' => 'در حال بررسی',
        'completed' => 'تکمیل‌شده',
        'cancelled' => 'لغو شده',
        'delivered' => 'تحویل داده شده',
        'processing' => 'در صف انتظار',
        default => $status,
    };
}

/**
 * تبدیل نوع خدمات به فارسی
 */
function serviceToPersian($service)
{
    return match ($service) {
        'dry clean' => 'خشکشویی',
        'wash & fold' => 'شستشو و تا',
        'ironing' => 'اتوکشی',
        'full service' => 'خدمات کامل',
        'wash' => 'شستشو',
        'stain' => 'لکه‌گیری',
        'iron' => 'اتو',
        default => $service,
    };
}

/**
 * تبدیل عدد به فرمت فارسی
 */
function toPersianNumber($num)
{
    $western_number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ','];
    $persian_number = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '،'];
    return str_replace($western_number, $persian_number, number_format($num));
}

/**
 * تبدیل تاریخ میلادی به شمسی
 */
function convert_date($datetime)
{
    if (!function_exists('jdate')) {
        return $datetime; // اگر jdate نصب نباشد، تاریخ را به همان شکل برمی‌گرداند
    }
    return jdate("Y/m/d", strtotime($datetime));
}







// edit and delete in list



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_employee':
            $firstName = $_POST['first_name'] ?? '';
            $lastName  = $_POST['last_name'] ?? '';
            $mobile    = $_POST['mobile'] ?? '';
            $username  = $mobile;
            $password  = $mobile;
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'manager';

            if (empty($firstName) || empty($lastName) || empty($mobile)) {
                echo "missing_fields";
                break;
            }

            // بررسی تکراری بودن شماره
            $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                echo "duplicate";
                break;
            }

            $stmt = $db->prepare("INSERT INTO users (firstName, lastName, username, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $username, $passwordHash, $role);

            if ($stmt->execute()) {
                $newId = $db->insert_id;
                $_SESSION['employee_info'] = [
                    'id'       => $newId,
                    'username' => $username,
                    'password' => $password
                ];
                echo "success";
            } else {
                echo "db_error";
            }
            $stmt->close();
            break;

        case 'edit_employee':
            $id       = intval($_POST['id'] ?? 0);
            $fname    = $_POST['first_name'] ?? '';
            $lname    = $_POST['last_name'] ?? '';
            $username = $_POST['username'] ?? '';

            if ($id <= 0 || empty($fname) || empty($lname) || empty($username)) {
                echo "missing_fields";
                break;
            }

            // بررسی تکراری بودن شماره (غیر از خودش)
            $stmt = $db->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->bind_param("si", $username, $id);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                echo "duplicate";
                break;
            }

            $stmt = $db->prepare("UPDATE users SET firstName = ?, lastName = ?, username = ? WHERE id = ? AND role = 'manager'");
            $stmt->bind_param("sssi", $fname, $lname, $username, $id);
            echo $stmt->execute() ? "success" : "error";
            $stmt->close();
            break;

        case 'delete_employee':
            $id = intval($_POST['id'] ?? 0);
            if ($id > 0) {
                $stmt = $db->prepare("DELETE FROM users WHERE id = ? AND role = 'manager'");
                $stmt->bind_param("i", $id);
                echo $stmt->execute() ? "success" : "error";
                $stmt->close();
            } else {
                echo "invalid_id";
            }
            break;

        default:
            echo "invalid_action";
            break;
    }

} else {
    echo "invalid_request";
}





if (isset($_POST['do-insert-employee'])) {
    session_start();
    $firstName = $_POST['first_name'];
    $lastName  = $_POST['last_name'];
    $mobile    = $_POST['mobile'];
    $username  = $mobile;
    $password  = $mobile;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'manager';  // اینجا نقش کارمند را تنظیم می‌کنیم

    // بررسی تکراری بودن username
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        setMessage('کاربری با این شماره قبلاً ثبت شده است.');
        header("Location: ../manager/register_employee.php");
        exit;
    } else {
        $stmt = $db->prepare("INSERT INTO users (firstName, lastName, username, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $username, $passwordHash, $role);
        $insert = $stmt->execute();

        if ($insert) {
            $newId = $db->insert_id;
            $_SESSION['employee_info'] = [
                'id'       => $newId,
                'username' => $username,
                'password' => $password
            ];
            header("Location: ../manager/role.php ");
            exit;
        } else {
            setMessage('خطا در ثبت کارمند.');
            header("Location: ../manager/register_employee.php");
            exit;
        }
    }
}


// دریافت بازه زمانی از فرم (POST)
$period = $_POST['period'] ?? 'هفتگی';

// تاریخ امروز
$today = date('Y-m-d');

// تعیین تاریخ شروع بر اساس بازه انتخابی
switch ($period) {
    case 'هفتگی':
        $start_date = date('Y-m-d', strtotime('-7 days'));
        break;
    case 'ماهانه':
        $start_date = date('Y-m-d', strtotime('-1 month'));
        break;
    case 'سه ماهه':
        $start_date = date('Y-m-d', strtotime('-3 months'));
        break;
    case 'شش ماهه':
        $start_date = date('Y-m-d', strtotime('-6 months'));
        break;
    case 'یکساله':
        $start_date = date('Y-m-d', strtotime('-1 year'));
        break;
    default:
        $start_date = date('Y-m-d', strtotime('-7 days'));
}

// کوئری درآمد کل در بازه انتخابی
$sql = "SELECT SUM(total_price) AS income_period FROM orders WHERE DATE(created_at) BETWEEN '$start_date' AND '$today'";
$result = $db->query($sql);

$income_period = 0;
if ($result && $row = $result->fetch_assoc()) {
    $income_period = $row['income_period'] ?? 0;
}
$income_display = toPersianNumber($income_period);

// کوئری تعداد کل سفارشات در بازه
$sql = "SELECT COUNT(*) AS order_count FROM orders WHERE DATE(created_at) BETWEEN '$start_date' AND '$today'";
$result = $db->query($sql);

$order_count = 0;
if ($result && $row = $result->fetch_assoc()) {
    $order_count = $row['order_count'];
}
