<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<?php
    $path = 'assets/js';
    $diretorio = dir($path);
    
    while($arquivo = $diretorio -> read()){
        if(pathinfo($arquivo, PATHINFO_EXTENSION)=='js'){
            ?> <script src="<?=$path?>/<?=$arquivo?>"></script> <?php
        }
    }
    $diretorio -> close();
?>