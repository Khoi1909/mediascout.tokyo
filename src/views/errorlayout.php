<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>MediaScout</title>
    <link rel="icon" href="../../public/icon.ico" type="image/x-icon">
    <style>
        div{padding:40px}
        #header, #footer{background-color:black;}
    </style>
</head>
<body>
<div id="header"></div>
<div id="content">
    <?php require_once "./src/views/pages/error/".$data["Page"].".php" ?>
</div>
<div id="footer"></div>
</body>
</html>