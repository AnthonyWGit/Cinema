<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://localhost/Cinema/Cinema/views/templates/globalStyle.css" rel="stylesheet" />
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