<?php
$colunasImplode = implode("",$colunas);

$layoutView = '

<?php
require_once(base_path("includes/modules/'.$nameMod.'.mod.php"));
$c = new '.lcfirst($nameMod).'();
require_once(base_path("includes/class/breadcrumbs.class.php"));
$bread = new Breadcrumbs();
$bread->load("'.$nameMod.'","Início");

?>
<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
<div class="page-section">
    <div class="container extra-size">
        <div class="row">
            <?php var_dump($data->'.$nameMod.');?>
        </div>
    </div>
</div>
';
//caminho onde vai ser criado o arquivo
$caminhoview = $caminho.'includes/views/';

//Criando arquivo
if(file_put_contents($caminhoview.$nameMod.'.php',$layoutView)){
    $msg['success'][] = 'Arquivo '.$caminhoview .'<b>'. $nameMod.'.php</b> criado com sucesso';
    chmod($caminhoview.$nameMod.'.php', 0777);
} else {
    $msg['error'][] = 'Erro ao criar '.$caminhoview .'<b>'. $nameMod.'.php</b>';
}
