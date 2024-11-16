<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Mediascout</title>
    <link rel="icon" href="/public/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../public/styles/header.css">
</head>
<?php include_once './src/views/header.php'; ?>
<body>
    <div id="content">
        <?php
        require_once "./src/views/pages/".$data["Page"].".php";
         ?>
    </div>
</body>
<?php require_once "./src/views/footer.php"; ?>
</html>
