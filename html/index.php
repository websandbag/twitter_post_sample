<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>完了ページ</title>
    </head>
    <body>
        <h1>トップページ</h1>
        <?php
            if(isset($_SESSION['user_info'])
                && $_SESSION['user_info'] != ""):
        ?>
        <a href="autopost.php">自動投稿</p>
        <?php
            else:
        ?>
        <a href="login.php">ログイン</p>
        <?php
            endif;
        ?>
    </body>
</html>
