<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/register-order.css">

</head>

<body>

    <?php require_once 'header.php'; ?>
    <?php require_once 'right-box.php'; ?>

    <!-- باکس جدید اول -->
    <div class="new-box">
        <div class="right-text">ثبت سفارش</div>
        <div class="left-text">لیست سفارش</div>
    </div>

    <!-- ردیف اول باکس‌ها -->
    <div class="first-row-container">
        <!-- باکس جستجوی کد مشتری -->
        <div class="customer-search-box">
            <input type="text" placeholder="جستجو بر اساس کد مشتری" />
            <i class="fas fa-search search-icon"></i>
        </div>

        <!-- گروه باکس نوع آیتم -->
        <div class="box-group">
            <div class="item-type-box">
                <span>نوع آیتم</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
        </div>

        <!-- گروه باکس نوع خدمات -->
        <div class="box-group">
            <div class="service-type-box">
                <span>نوع خدمات</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
        </div>

        <!-- باکس تعداد -->
        <div class="quantity-box">
            <span>تعداد</span>
            <div class="quantity-controls">
                <button class="increase">▲</button>
                <button class="decrease">▼</button>
            </div>
        </div>

        <!-- باکس قیمت واحد -->
        <div class="unit-price-box">
            <span>قیمت واحد</span>
        </div>

        <!-- باکس قیمت نهایی -->
        <div class="final-price-box">
            <span>قیمت نهایی</span>
        </div>

        <!-- باکس افزودن آیتم جدید -->
        <div class="add-item-box">
            <i class="fas fa-plus"></i>
            <span>افزودن آیتم جدید</span>
        </div>
    </div>

    <!-- ردیف دوم باکس‌ها (منوهای بازشونده) -->
    <div class="second-row-container">
        <!-- باکس آیتم‌ها -->
        <div class="item-options-box">
            <div class="item-option">
                <label for="shirt">پیراهن</label>
                <input type="checkbox" id="shirt" name="item" value="shirt">
            </div>
            <div class="item-option">
                <label for="pants">شلوار</label>
                <input type="checkbox" id="pants" name="item" value="pants">
            </div>
            <div class="item-option">
                <label for="coat">کت</label>
                <input type="checkbox" id="coat" name="item" value="coat">
            </div>
            <div class="item-option">
                <label for="socks">جوراب</label>
                <input type="checkbox" id="socks" name="item" value="socks">
            </div>
            <div class="item-option">
                <label for="kids">لباس بچگانه</label>
                <input type="checkbox" id="kids" name="item" value="kids">
            </div>
            <div class="item-option">
                <label for="manto">مانتو</label>
                <input type="checkbox" id="manto" name="item" value="manto">
            </div>
        </div>

        <!-- باکس خدمات -->
        <div class="service-options-box">
            <div class="service-option">
                <label for="wash">شستشو</label>
                <input type="checkbox" id="wash" name="service" value="wash">
            </div>
            <div class="service-option">
                <label for="stain">لکه‌گیری</label>
                <input type="checkbox" id="stain" name="service" value="stain">
            </div>
            <div class="service-option">
                <label for="iron">اتوکشی</label>
                <input type="checkbox" id="iron" name="service" value="iron">
            </div>
        </div>
    </div>

    <!-- باکس توضیحات جدید -->
    <div class="description-container">
        <div class="description-box">
            <div class="description-header">
                <i class="fas fa-info-circle description-icon"></i>
                <span class="description-title">توضیحات سفارش</span>
            </div>
            <p class="description-text">
            </p>
        </div>
    </div>

    <!-- باکس‌های جدید اضافه شده -->
    <div class="additional-boxes-container">
        <!-- گروه آدرس -->
        <div class="address-group">
            <div class="address-box">
                <input type="text" placeholder="منزل یا محل کار" />
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="new-address-box">
                <i class="fas fa-plus"></i>
                <span>افزودن آدرس جدید</span>
            </div>
        </div>

        <!-- گروه تاریخ -->
        <div class="date-group">
            <div class="date-box">
                <input type="text" placeholder="۱۴۰۱/۰۲/۰۱" />
                <i class="fas fa-calendar-alt date-icon"></i>
            </div>
            <div class="delivery-date-box">
                <input type="text" placeholder="۱۴۰۲/۰۲/۰۱" />
                <i class="fas fa-calendar-alt date-icon"></i>
            </div>
        </div>

        <!-- گروه ساعت -->
        <div class="time-group">
            <div class="time-box">
                <input type="text" placeholder="۱۴:۰۰" />
                <i class="fas fa-clock time-icon"></i>
            </div>
            <div class="delivery-time-box">
                <input type="text" placeholder="۱۶:۰۰" />
                <i class="fas fa-clock time-icon"></i>
            </div>
        </div>

        <!-- گروه روش پرداخت -->
        <div class="payment-group">
            <div class="payment-type-box">
                <span>روش پرداخت</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <div class="payment-options-box">
                <div class="payment-option">
                    <label for="cash">نقدی</label>
                    <input type="radio" id="cash" name="payment" value="cash" checked>
                </div>
                <div class="payment-option">
                    <label for="card">کارتخوان</label>
                    <input type="radio" id="card" name="payment" value="card">
                </div>
                <div class="payment-option">
                    <label for="online">درگاه پرداخت</label>
                    <input type="radio" id="online" name="payment" value="online">
                </div>
            </div>
        </div>
    </div>

    <!-- باکس خلاصه قیمت -->
    <div class="price-summary-container">
        <div class="price-row">
            <span>قیمت محاسبه شده</span>
            <span class="price-value">۱۵۰۰۰۰۰ تومان</span>
        </div>
        <div class="price-row">
            <span>کد تخفیف</span>
            <span class="price-value">0</span>
        </div>
        <div class="price-row final-price-row">
            <span>قیمت نهایی</span>
            <span class="price-value">۱۵۰۰۰۰۰ تومان</span>
            <div class="buttons-container">
                <div class="custom-box cancel-box">
                    لغو <span class="close-icon">×</span>
                </div>
                <div class="custom-box next-step-box">
                    ثبت سفارش <span class="arrow-icon">›</span>
                </div>
            </div>