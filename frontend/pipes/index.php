<?php 
$caminhoPipes = $caminho.$pastaPipes;
$caminhoSharedModuleByPipes = $caminho.'shared/shared.module.ts';
$filePipeSafeHtml = 'safe-html.pipe.ts';
$filePipeImgTipo  = 'imagem-tipoarquivo.pipe.ts';
$fileBooleanMessage  = 'boolean-message.pipe.ts';


//verifica se determinadas pastas já existem no sistema
if (!file_exists($caminhoPipes.'/'.$filePipeSafeHtml)) {
    require_once("./frontend/pipes/safeHtml.php");
}
if (!file_exists($caminhoPipes.'/'.$filePipeImgTipo)) {
    require_once("./frontend/pipes/imagemTipoarquivoPipe.php");
}
if (!file_exists($caminhoPipes.'/'.$fileBooleanMessage)) {
    require_once("./frontend/pipes/boolean-message.pipe.php");
}

// importando pipes no shared module
$new = "import { ImagemTipoarquivoPipe } from '../pipes/imagem-tipoarquivo.pipe';";
$retImport = verificarSeRegraExiste($new,"@NgModule({","imagem-tipoarquivo.pipe",$caminhoSharedModuleByPipes);
if($retImport!="alert"){
    $new = "        ImagemTipoarquivoPipe,";
    $ret = verificarSeRegraExiste($new,"declarations","ImagemTipoarquivoPipe,",$caminhoSharedModuleByPipes,2);
    $ret = verificarSeRegraExiste($new,"exports","**forcandoabarra**",$caminhoSharedModuleByPipes,2);
}
$new = "import { SafeHtml } from '../pipes/safe-html.pipe';";
$retImport = verificarSeRegraExiste($new,"@NgModule({","safe-html.pipe",$caminhoSharedModuleByPipes);
if($retImport!="alert"){
    $new = "        SafeHtml,";
    $ret = verificarSeRegraExiste($new,"declarations","SafeHtml,",$caminhoSharedModuleByPipes,2);
    $ret = verificarSeRegraExiste($new,"exports","**forcandoabarra**",$caminhoSharedModuleByPipes,2);
}
$new = "import { BooleanMessagePipe } from '../pipes/boolean-message.pipe';";
$retImport = verificarSeRegraExiste($new,"@NgModule({","boolean-message.pipe",$caminhoSharedModuleByPipes);
if($retImport!="alert"){
    $new = "        BooleanMessagePipe,";
    $ret = verificarSeRegraExiste($new,"declarations","BooleanMessagePipe,",$caminhoSharedModuleByPipes,2);
    $ret = verificarSeRegraExiste($new,"exports","**forcandoabarra**",$caminhoSharedModuleByPipes,2);
}
$addCss = '
.uploadArquivo {
    width: 250px;
    height: 200px;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background-position: center;
}';
$ret = verificarSeRegraExiste($addCss,"regra-ultimalinha",".uploadArquivo",$caminhoRaizFrontEnd.'/styles.css');
if($ret!='alert')$msg['success']['src'][] = 'styles.css';

$arquivo_destino = $caminhoRaizFrontEnd."/assets/img/user/padrao.jpg";
if (!file_exists($arquivo_destino)) {
    $arquivo_origem = "./assets/images/padrao.jpg";
    if (!is_dir($caminhoRaizFrontEnd."/assets/img/user")) {
        mkdir($caminhoRaizFrontEnd."/assets/img/user",0700);
    }

    if (copy($arquivo_origem, $arquivo_destino)){
        $msg['success']['assets']['img']['user'][] = 'padrao.jpg';
    }
    else{
        $msg['success']['assets']['img']['user'][] = 'ERROR|padrao.jpg';
    }
}