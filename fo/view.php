<?php
$colunasImplode = implode("",$colunas);

$layoutView = '

<?php
require_once(base_path("includes/modules/'.$nameComponent.'.mod.php"));
$c = new '.lcfirst($nameComponent).'();
require_once(base_path("includes/class/breadcrumbs.class.php"));
$bread = new Breadcrumbs();
$bread->load("'.$nameComponent.'","Início");

?>
<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
<div class="page-section">
    <div class="container extra-size">
        <div class="row">
            <?php var_dump($data->'.$nameComponent.');?>
        </div>
    </div>
</div>
';
//caminho onde vai ser criado o arquivo
$caminhoview = $caminho.'includes/views/';

//Criando arquivo
if(file_put_contents($caminhoview.$nameComponent.'.php',$layoutView)){
    $msg['success'][] = 'Arquivo '.$caminhoview .'<b>'. $nameComponent.'.php</b> criado com sucesso';
    chmod($caminhoview.$nameComponent.'.php', 0777);
} else {
    $msg['error'][] = 'Erro ao criar '.$caminhoview .'<b>'. $nameComponent.'.php</b>';
}
