<?php require_once "./../db/dbOperation.php" ?>
<?php require_once "./../include/Session.php" ?>
<?php require_once "./../include/Functions.php" ?>
<?php
confirmLogin();
if (isset($_GET["id"])) {

    $id = $_GET['id'];

    $db = new DBOperation();

    if ($db->deleteCategory($id)) {
        $_SESSION['successMessage'] = 'دسته بندی با موفقیت حذف شد';
        header('Location: ' . './../categories.php');
    } else {
        $_SESSION['errorMessage'] = 'مشکلی بوجود آمد';
        header('Location: ' . './../categories.php');
    }
}
?>