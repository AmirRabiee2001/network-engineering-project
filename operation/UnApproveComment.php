<?php require_once "./../db/dbOperation.php" ?>
<?php require_once "./../include/Session.php" ?>
<?php require_once "./../include/Functions.php" ?>
<?php
confirmLogin();
if (isset($_GET["id"])) {

    $id = $_GET['id'];
    $status = 'off';

    $db = new DBOperation();

    if ($db->approveComment($status, $id)) {
        $_SESSION['successMessage'] = 'تایید نظر با موفقیت گرفته شد';
        header('Location: ' . './../Comments.php');
    } else {
        $_SESSION['errorMessage'] = 'مشکلی بوجود آمد';
        header('Location: ' . './../Comments.php');
    }
}
?>