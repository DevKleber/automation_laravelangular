<?php
$viewListar = '';
$c = ucfirst($nameComponent);
$viewListar .=' <?php
$ctrl = new '.$c.'();
include(base_path("includes/views/base/listar.php"));';
//caminho onde vai ser criado o arquivo
$caminhobolistar = $caminho.'admin/includes/views/'.$nameComponent.'/';
//Criando arquivo
if(file_put_contents($caminhobolistar . "listar.php",$viewListar)){
    chmod($caminhobolistar.'listar.php',0777);
    $msg['success'][] = 'Arquivo '.$caminhobolistar . '<b>listar.php</b> criado com sucesso';
} else {
    $msg['error'][] = 'Erro ao criar '.$caminhobolistar . "<b>listar.php</b>";
}

