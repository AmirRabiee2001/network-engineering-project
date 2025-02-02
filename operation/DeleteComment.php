<?php require_once "./../db/dbOperation.php" ?>
<?php require_once "./../include/Session.php" ?>
<?php require_once "./../include/Functions.php" ?>
<?php
confirmLogin();
if (isset($_GET["id"])) {

    $id = $_GET['id'];

    $db = new DBOperation();

    if ($db->deleteComment($id)) {
        $_SESSION['successMessage'] = 'نظر با موفقیت حذف شد';
        header('Location: ' . './../Comments.php');
    } else {
        $_SESSION['errorMessage'] = 'مشکلی بوجود آمد';
        header('Location: ' . './../Comments.php');
    }
}
?>