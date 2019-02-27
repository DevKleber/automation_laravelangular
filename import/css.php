<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

<?php
    $path = 'assets/css';
    $diretorio = dir($path);
    
    while($arquivo = $diretorio -> read()){
        if(pathinfo($arquivo, PATHINFO_EXTENSION)=='css'){
               ?> <link rel="stylesheet" href="<?=$path?>/<?=$arquivo?>"> <?php
        }
    }
    $diretorio -> close();
    
?>