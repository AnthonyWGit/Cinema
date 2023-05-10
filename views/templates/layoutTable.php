<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://localhost/Cinema/Cinema/views/templates/tableStyle.css" rel="stylesheet" />
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
            <?php require_once("header.php");?>
            <?= $content ?>
            <?php require_once("footer.php");?>
        </div>
    </body>
</html>