<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>پنل مدیریتی وبسایت</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/IRANSans/IRANSansWeb.css" />
    <link rel="stylesheet" href="../styles/manager/employee_list.css">

</head>

<body>

    <?php require_once 'header.php'; ?>
    <?php require_once 'right-box.php'; ?>

    <div class="new-box">
        <a href="register_employee.php" style="text-decoration: none; color: inherit;">
            <div class="right-text">ثبت کارمند جدید</div>
        </a>
        <div class="left-text">لیست کارمندان</div>
    </div>


    <!-- لیست مشتریان با ستون‌های کارکرد و هزینه خالی -->
    <div class="customer-list">
        <table>
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>کد پرسنلی</th>
                    <th>نام</th>
                    <th> خانوادگی</th>
                    <th>شماره همراه</th>

                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $managers = []; // تعریف پیش‌فرض برای جلوگیری از خطای undefined

                $stmt = $db->prepare("SELECT id, firstName, lastName, username FROM users WHERE role = 'manager'");
                if ($stmt && $stmt->execute()) {
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $managers[] = $row;
                    }
                }

                foreach ($managers as $index => $manager): ?>
                    <tr>
                        <td class="persian-number"><?php echo $index + 1; ?></td>
                        <td class="persian-number"><?php echo $manager['id']; ?></td>
                        <td><?php echo htmlspecialchars($manager['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($manager['lastName']); ?></td>
                        <td class="persian-number"><?php echo htmlspecialchars($manager['username']); ?></td>

                        <td></td>
                        <td></td>
                        <td>
                            <div class='action-buttons'>
                                <button class='edit-btn' title='ویرایش'><i class='fas fa-edit'></i></button>
                                <button class='delete-btn' title='حذف'><i class='fas fa-trash'></i></button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tbody = document.querySelector("tbody");

            tbody.addEventListener("click", function(event) {
                const button = event.target.closest("button");
                if (!button) return;

                const row = button.closest("tr");
                const idCell = row.children[1]; // ستون ID
                const fnameCell = row.children[2];
                const lnameCell = row.children[3];
                const phoneCell = row.children[4];

                // دکمه ویرایش یا ذخیره
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
                    const newFname = fnameCell.querySelector("input").value.trim();
                    const newLname = lnameCell.querySelector("input").value.trim();
                    const newPhone = phoneCell.querySelector("input").value.trim();
                    const id = idCell.textContent.trim();

                    fetch('../inc/manager.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'edit_employee',
                                id: id,
                                first_name: newFname,
                                last_name: newLname,
                                username: newPhone
                            })
                        })
                        .then(res => res.text())
                        .then(data => {
                            if (data === "success") {
                                fnameCell.textContent = newFname;
                                lnameCell.textContent = newLname;
                                phoneCell.textContent = newPhone;

                                button.innerHTML = '<i class="fas fa-edit"></i>';
                                button.title = "ویرایش";
                                button.classList.remove("save-btn");
                                button.classList.add("edit-btn");
                            } else {
                                alert("خطا در ذخیره تغییرات: " + data);
                            }
                        })
                        .catch(err => {
                            console.error('خطا:', err);
                            alert("خطا در ارتباط با سرور");
                        });

                    // دکمه حذف
                } else if (button.classList.contains("delete-btn")) {
                    if (!confirm("آیا مطمئن هستید که می‌خواهید این کارمند را حذف کنید؟")) return;

                    const id = idCell.textContent.trim();

                    fetch('../inc/manager.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'delete_employee',
                                id: id
                            })
                        })
                        .then(res => res.text())
                        .then(data => {
                            if (data === "success") {
                                row.remove();
                                alert("کارمند با موفقیت حذف شد.");
                            } else {
                                alert("خطا در حذف کارمند: " + data);
                            }
                        })
                        .catch(err => {
                            console.error('خطا:', err);
                            alert("خطا در ارتباط با سرور");
                        });
                }
            });
        });

        // ویرایش/ذخیره کارمند
        document.querySelectorAll(".edit-btn, .save-btn").forEach(button => {
            button.addEventListener("click", function() {
                const row = button.closest("tr");
                const idCell = row.children[1]; // ستون ID
                const fnameCell = row.children[2];
                const lnameCell = row.children[3];
                const phoneCell = row.children[4];

                if (button.classList.contains("edit-btn")) {
                    // وارد حالت ویرایش شو
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
                    // ذخیره تغییرات
                    const newFname = fnameCell.querySelector("input").value.trim();
                    const newLname = lnameCell.querySelector("input").value.trim();
                    const newPhone = phoneCell.querySelector("input").value.trim();
                    const id = idCell.textContent.trim();

                    fetch('../inc/manager.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'edit_employee',
                                id: id,
                                first_name: newFname,
                                last_name: newLname,
                                username: newPhone // چون موبایل هم به عنوان نام کاربری استفاده میشه
                            })
                        })
                        .then(res => res.text())
                        .then(data => {
                            if (data === "success") {
                                fnameCell.textContent = newFname;
                                lnameCell.textContent = newLname;
                                phoneCell.textContent = newPhone;

                                button.innerHTML = '<i class="fas fa-edit"></i>';
                                button.title = "ویرایش";
                                button.classList.remove("save-btn");
                                button.classList.add("edit-btn");
                            } else {
                                alert("خطا در ذخیره تغییرات: " + data);
                            }
                        })
                        .catch(err => {
                            console.error('خطا:', err);
                            alert("خطا در ارتباط با سرور");
                        });
                }
            });
        });

        // حذف کارمند
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                if (!confirm("آیا مطمئن هستید که می‌خواهید این کارمند را حذف کنید؟")) return;

                const row = button.closest("tr");
                const id = row.children[1].textContent.trim();

                fetch('../inc/manager.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            action: 'delete_employee',
                            id: id
                        })
                    })
                    .then(res => res.text())
                    .then(data => {
                        if (data === "success") {
                            row.remove();
                            alert("کارمند با موفقیت حذف شد.");
                        } else {
                            alert("خطا در حذف کارمند: " + data);
                        }
                    })
                    .catch(err => {
                        console.error('خطا:', err);
                        alert("خطا در ارتباط با سرور");
                    });
            });
        });
    </script>

</body>

</html>