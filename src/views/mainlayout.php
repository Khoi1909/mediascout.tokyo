<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>MediaScout</title>
    <style>
        div{padding:20px}
        #header, #footer{background-color:green;}
    </style>
</head>
<body>
    <div id="header"></div>
    <div id="content">
        <?php require_once "./src/views/pages/".$data["Page"].".php" ?>
    </div>
    <div id="footer"></div>
</body>
</html>