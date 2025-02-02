<?php require_once "./../db/dbOperation.php" ?>
<?php require_once "./../include/Session.php" ?>
<?php require_once "./../include/Functions.php" ?>
<?php
confirmLogin();
if (isset($_GET["id"])) {

    $id = $_GET['id'];

    $db = new DBOperation();

    if ($db->deletePost($id)) {
        $_SESSION['successMessage'] = 'مطلب با موفقیت حذف شد';
        header('Location: ' . './../dashboard.php');
    } else {
        $_SESSION['errorMessage'] = 'مشکلی بوجود آمد';
        header('Location: ' . './../dashboard.php');
    }
}
?>