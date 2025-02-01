<?php require_once "./db/DBOperation.php" ?>
<?php require_once "./include/Session.php" ?>
<?php require_once "./include/Functions.php" ?>
<?php
$admin = 'Amir';
if (isset($_POST['btnAddComment'])) {
    if (empty($_POST['txtUsername']) || empty($_POST['txtEmail']) || empty($_POST['txtComment'])) {
        $_SESSION['errorMessage'] = 'Please fill all the fields';
    } else {
        $username = $_POST['txtUsername'];
        $email = $_POST['txtEmail'];
        $comment = $_POST['txtComment'];
        $postID = $_GET['id'];

        $db = new DBOperation();
        $db->insertComment(dateTime(), $username, $email, $comment, $admin, 'off', $postID);

        $_SESSION['successMessage'] = 'Comment Added successfully';
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

    <title>خبرنامه - خبر</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="css/blog.css" rel="stylesheet">
    <link rel="stylesheet" href="css/starter-template.css">
</head>

<body>

    <div class="container pb-3">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="text-muted" href="#">عضویت در خبرنامه</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="Blog.php?page=1">خبرنامه</a>
                </div><!--  d-flex justify-content-end align-items-center  ml-1 -->
                <div class="col-4 clearfix">
                    <div class="input-group input-group-sm d-flex flex-row-reverse">
                        <form class="form-inline" action="Blog.php?page=1" method="get">
                            <input type="text" class="form-control form-control-sm" placeholder="جستجو کنید..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-sm" type="submit" name="search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="mx-3">
                                        <circle cx="10.5" cy="10.5" r="7.5"></circle>
                                        <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                <a class="p-2 text-muted" href="Blog.php?page=1&category=سیاسی">سیاسی</a>
                <a class="p-2 text-muted" href="Blog.php?page=1&category=کسب و کار">کسب و کار</a>
                <a class="p-2 text-muted" href="Blog.php?page=1&category=علمی">علم</a>
                <a class="p-2 text-muted" href="Blog.php?page=1&category=تکنولوژی">تکنولوژی</a>
                <a class="p-2 text-muted" href="Blog.php?page=1&category=ورزش">ورزش</a>
                <a class="p-2 text-muted" href="Blog.php?page=1&category=سلامت">سلامت</a>
                <a class="p-2 text-muted" href="Blog.php?page=1&category=جهان">جهان</a>
            </nav>
        </div>
    </div>

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <div class="blog-post">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $db = new dbOperation();
                        $finalResult = $db->selectPostFromID($id);

                        $result = $finalResult[0];
                        $rowCount = $finalResult[1];

                        for ($i = 0; $i < $rowCount; $i++) {
                            echo '<h2 class="blog-post-title">' . $result[$i]['title'] . '</h2>';
                            echo '<p class="blog-post-meta">' . $result[$i]['datetime']
                                . '  نوشته شده توسط <a href="Blog.php?author=' . $result[$i]['author'] . '">' . $result[$i]['author'] . '</a></p>';
                            echo '<hr>';
                            echo '<p>' . $result[$i]['post'] . '</p>';
                        }
                    }
                    ?>
                </div><!-- /.blog-post -->


                <div class="col-md-8 order-md-1 mw-100 p-0">
                    <h4 class="mb-3">نظرات</h4>
                    <!-- <div>
                        <?php echo successMessage();
                        echo errorMessage(); ?>
                    </div> -->
                    <form class="needs-validation " novalidate method="post"
                        action="FullPost.php?id=<?php echo $_GET['id']; ?>">
                        <div class="mb-3">
                            <label for="username">نام کاربری</label>
                            <input type="text" class="form-control" id="username" placeholder="نام کاربری" name="txtUsername">
                            <div class="invalid-feedback">
                                Please enter a valid name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">ایمیل</label>
                            <input type="email" class="form-control" id="email" placeholder="ایمیل" name="txtEmail">
                        </div>
                        <div class="mb-3">
                            <label for="comment">نظر</label>
                            <textarea class="form-control" id="comment" name="txtComment" rows="2">

                        </textarea>
                            <div class="invalid-feedback">
                                Please enter a valid password.
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg btn-block" type="submit" name="btnAddComment">ثبت نظر</button>
                    </form>
                </div>

                <?php
                $db = new dbOperation();
                $finalResult = $db->selectComments('on');

                $result = $finalResult[0];
                $rowCount = $finalResult[1];

                for ($i = 0; $i < $rowCount; $i++) {

                    echo '<div class="row mt-2 mb-2 pt-3 mr-0 ml-0 img-thumbnail" style="background-color: #f6f7f9">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <img class="card-img img-thumbnail" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" alt="Card image cap">';

                    echo '<p class="card-title text-center">' . $result[$i]['name'] . '</p>';
                    echo '</div>';

                    echo '<div class="card-body col-md-9">';
                    echo '<p class="card-text">' . $result[$i]['comment'] . '</p>';
                    echo '<p class="card-subtitle text-muted text-right">' . $result[$i]['datetime'] . '</p>';

                    echo '</div>
            </div>';
                }
                ?>
            </div><!-- /.blog-main -->

            <aside class="col-md-4 blog-sidebar">
                <div class="p-3 mb-2 bg-light rounded">
                    <h4 class="font-italic">درباره</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus
                        sit
                        amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">اخبار تازه</h4>
                    <ol class="list-unstyled mb-0">
                        <?php
                        $db = new dbOperation();
                        $finalResult = $db->selectPost();

                        $result = $finalResult[0];
                        $rowCount = $finalResult[1];
                        if ($rowCount > 8) {
                            $rowCount = 8;
                        }

                        for ($i = 0; $i < $rowCount; $i++) {
                            echo '<li>';
                            echo '<a href="FullPost.php?id=' . $result[$i]['id'] . '">' . $result[$i]['title'] . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ol>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">دسته ها</h4>
                    <ol class="list-unstyled">
                        <?php
                        $db = new dbOperation();
                        $finalResult = $db->selectCategory();

                        $result = $finalResult[0];
                        $rowCount = $finalResult[1];

                        for ($i = 0; $i < $rowCount; $i++) {
                            echo '<li>';
                            echo '<a href="Blog.php?category=' . $result[$i]['category'] . '">' . $result[$i]['category'] . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main><!-- /.container -->
    <footer class="blog-footer mt-5">
        <div class="row">
            <div class="col-6 col-md">
                <h5 class="text-dark">دسته بندی</h5>
                <ul class="list-unstyled text-small">
                    <?php
                    $db = new dbOperation();
                    $finalResult = $db->selectCategory();

                    $result = $finalResult[0];
                    $rowCount = $finalResult[1];

                    for ($i = 0; $i < $rowCount; $i++) {
                        echo '<li>';
                        echo '<a class="text-muted" href="Blog.php?page=1&category=' . $result[$i]['category'] . '">' . $result[$i]['category'] . '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5 class="text-dark">درباره</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">درباره خبرنامه</a></li>
                    <li><a class="text-muted" href="#">عضو شوید</a></li>
                    <li><a class="text-muted" href="#">حریم خصوصی</a></li>
                    <li><a class="text-muted" href="#">شرایط</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>