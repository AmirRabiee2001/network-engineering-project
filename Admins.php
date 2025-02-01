<?php require_once "./db/DBOperation.php" ?>
<?php require_once "./include/Session.php" ?>
<?php require_once "./include/Functions.php" ?>
<?php confirmLogin(); ?>
<?php
$admin = 'Amir';
if (isset($_POST['btnAddAdmin'])) {
    if (empty($_POST['txtUsername']) || empty($_POST['txtPassword']) || empty($_POST['txtConfirmPassword'])) {
        $_SESSION['errorMessage'] = 'Please fill the field';
    } else {
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];
        $confirmPass = $_POST['txtConfirmPassword'];
        if ($password === $confirmPass) {
            $db = new DBOperation();
            $db->insertAdmin(dateTime(), $username, $password, $admin);

            $_SESSION['successMessage'] = 'Admin Added successfully';
        } else {
            $_SESSION['errorMessage'] = 'password does not match';
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>مدیریت ادمین ها</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="Blog.php?page=1">خبرنامه</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="SignOut.php">خارج شوید</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="Dashboard.php">
                                <span data-feather="home"></span>
                                داشبورد <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AddNewPost.php">
                                <span data-feather="file"></span>
                                اضافه کردن مطلب جدید
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Categories.php">
                                <span data-feather="shopping-cart"></span>
                                دسته بندی <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Admins.php">
                                <span data-feather="users"></span>
                                مدیریت ادمین ها
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Comments.php">
                                <span data-feather="bar-chart-2"></span>
                                نظرات
                                <?php
                                $db = new dbOperation();
                                $result = $db->countComments();

                                echo '<button type="button" class="btn btn-warning btn-sm float-right">';
                                echo $result;
                                echo '</button>';

                                ?>
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>------------------------------- </span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="Blog.php?page=1">
                                <span data-feather="file-text"></span>
                                بلاگ زنده
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-lg-0">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">مدیریت ادمین ها</h1>
                </div>

                <div class="col-md-8 order-md-1 mw-100 p-0">
                    <div>
                        <?php echo successMessage();
                        echo errorMessage(); ?>
                    </div>
                    <form class="needs-validation " novalidate method="post" action="Admins.php">
                        <div class="mb-3">
                            <label for="username">نام کاربری</label>
                            <input type="text" class="form-control" id="username" placeholder="" name="txtUsername">
                            <div class="invalid-feedback">
                                نام معتبر وارد کنید
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password">رمز عبور</label>
                            <input type="password" class="form-control" id="password" placeholder=""
                                name="txtPassword">
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                پسورد باید بین 8 تا 10 کاراکتر باشد و شامل حروف و اعداد خاص نباشد
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword">تکرار رمز عبور</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder=""
                                name="txtConfirmPassword">
                            <div class="invalid-feedback">
                                رمز معتبر وارد کنید
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg btn-block" type="submit" name="btnAddAdmin">اضافه کردن ادمین
                        </button>
                    </form>
                </div>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاریخ</th>
                                <th>نام ادمین</th>
                                <th>اضافه شده توسط</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = new dbOperation();
                            $finalResult = $db->selectAdmin();

                            $result = $finalResult[0];
                            $rowCount = $finalResult[1];

                            for ($i = 0; $i < $rowCount; $i++) {
                                echo '<tr>';
                                echo '<td>' . ($i + 1) . '</td>';
                                echo '<td>' . $result[$i]['datetime'] . '</td>';
                                echo '<td>' . $result[$i]['username'] . '</td>';
                                echo '<td>' . $result[$i]['added_by'] . '</td>';
                                echo '<td>' . '<a href="operation/DeleteAdmin.php?id=' . $result[$i]['id'] . '">'
                                    . '<button class="btn btn-danger btn-block" type="submit" name="btnDeleteAdmin">حذف</button>'
                                    . '</a>' . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

</body>

</html>