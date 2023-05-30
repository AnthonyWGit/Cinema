<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="views/templates/common.css" rel="stylesheet" />
        <link href="views/templates/tableStyle.css" rel="stylesheet" />
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
                <?php require_once("header.php");?>            
            <div class="wrapperInside">
                <?= $content ?>
                <?php require_once("sidebar.php")?>
                <?php require_once("footer.php");?>
            </div>                           
        </div>
    </body>
    <script src="public\js\dlModeSwitch.js"></script>
    <script src="public\js\dlModeSwitchTable.js"></script>
    <script src="public\js\dlPerform.js"></script>
</html>