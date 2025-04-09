<?php require_once 'inc/functions.php'; ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت‌نام</title>
    <link rel="stylesheet" href="styles/register/styles.css">
    <script>
        
        function allowOnlyPersianLetters(event) {
            const persianRegex = /^[\u0600-\u06FF\s]+$/; 
            const inputChar = String.fromCharCode(event.which || event.keyCode);

            if (!persianRegex.test(inputChar)) {
                event.preventDefault(); 
            }
        }

        
        function allowOnlyNumbers(event) {
            const numberRegex = /^[0-9]+$/; 
            const inputChar = String.fromCharCode(event.which || event.keyCode);

            if (!numberRegex.test(inputChar)) {
                event.preventDefault(); 
            }
        }

    
        function validatePassword(password) {
            const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,10}$/;
            if (regex.test(password)) {
                return true;
            } else {
                alert("رمز عبور باید ترکیبی از حروف انگلیسی، عدد و کاراکترهای خاص باشد.");
                return false;
            }
        }

        
        function checkPassword() {
            const password = document.getElementsByName('password')[0].value;
            const confirmPassword = document.getElementsByName('pass-conf')[0].value;

            if (!validatePassword(password)) {
                return false;
            }

            if (password !== confirmPassword) {
                alert("رمز عبور و تکرار آن باید یکسان باشد.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        
        <form action="inc/functions.php" method="post" onsubmit="return checkPassword()">
            <img src="images/logo.png" alt="">
            <div class="form-group">
                <div>
                    <label class="label">نام</label>
                    
                    <input type="text" name="first_name" id="name" required maxlength="10" placeholder="علی" onkeypress="allowOnlyPersianLetters(event)">
                </div>
                <div>
                    <label class="label">نام خانوادگی</label>
                    
                    <input type="text" name="last_name" required maxlength="15" placeholder="احمدی" onkeypress="allowOnlyPersianLetters(event)">
                </div>
            </div>
            <label class="label-in" style="position: relative; right: 30px;">شماره همراه</label>
            
            <input type="text" class="full-width" name="username" required maxlength="10" placeholder="0000 000 921" onkeypress="allowOnlyNumbers(event)">
            
            <label class="label-in">رمز عبور (حداقل ۸ کارکتر)</label>
            <input type="password" maxlength="10" minlength="8" name="password" class="full-width" required>
            <label class="label-in">تکرار رمز عبور</label>
            <input type="password" maxlength="10" minlength="8" name="pass-conf" class="full-width" required>
            <?php  showMessage(); ?>
            <button class="submit-btn" name="do-register">ثبت نام</button>
        </form>
        <p>حساب کاربری دارید؟ <a href="login.php" class="login-link">ورود</a></p>
    </div>

</body>

</html>
