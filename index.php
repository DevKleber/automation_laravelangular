<!DOCTYPE html>
<html lang="pt">
<head>
<link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.css">
<link rel="shortcut icon" href="assets\images\icon.png" type="image" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Automação</title>
    <?php 
    require_once("import/css.php");
    require_once("import/js.php");
    ?>
</head>
    <body>
        <div id="snackbar"></div>
        <?php
        require_once("autoload.class.php");
        require_once("class/DB.php");
        require_once("import/modal.php"); 
        ?>  
        <div class="container">
            <?php require_once("controller.php") ?>  
        </div>
    </body>
</html>