<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>MediaScout</title>
    <link rel="icon" href="./icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/public/styles/MainLayout.css">
    <link rel="stylesheet" href="/public/styles/styles.css">
</head>
<body>
    <div id="content">
        <?php
        include 'navbar.php';
        require_once "./src/views/pages/".$data["Page"].".php";
//        include 'leftSide.php';
//        include 'rightside.php';
         ?>
    </div>
</body>
</html>
<?php include 'footer.php';
