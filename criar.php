<?php
// Turn off error reporting
error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$conf_db = new Conf_db();
$helpers = new Helpers();

@$table                          = $_POST['table'];
@$nameComponent                  = $_POST['nameComponent'];
@$nomeComponent                  = $helpers->nomeComponent($nameComponent);
@$namerotaangular                = $_POST['namerotaangular'];
@$criar_fo                       = $_POST['criar_fo'];
@$caminho                        = $_POST['caminho'];
@$checkboxUrlAmigavel            = $_POST['checkboxUrlAmigavel'];
@$urlamigavel                    = $_POST['urlamigavel'];
@$checkboxRotaApiProtegidaToken  = $_POST['checkboxRotaApiProtegidaToken'];
@$inserir                        = $_POST['inserir'];
@$alterar                        = $_POST['alterar'];
@$detalhar                       = $_POST['detalhar'];

//backend
@$checkboxRotaApi              = $_POST['checkboxRotaApi'];
@$criar_bo                     = $_POST['criar_bo'];
@$nomeRotaBE                   = $_POST['rotabe'];
@$checkboxRotaFeProtegidaToken = $_POST['checkboxRotaFeProtegidaToken'];
@$caminhoBackEnd               = $_POST['caminhoBackEnd'];
@$filtrarPorToken              = $_POST['filtrarPorToken'];
@$nameidtoken                  = $_POST['nameidtoken'];

$caminhoHttp = 'Http/';

//configs front e back
$nameGetServices =$nomeComponent;
if($helpers->checkLastChar($nomeComponent) != 's'){
    $nameGetServices =$nomeComponent.'s';
}


$caminhoRaizBanckend = str_replace("/app\/",'',$caminhoBackEnd);
$caminhoRaizBanckend = str_replace("/app",'',$caminhoBackEnd);

$caminhoRaizFrontEnd = str_replace("/app\/",'',$caminho);
$caminhoRaizFrontEnd = str_replace("/app",'',$caminho);
@$htaccess      = $_POST['confihtacces'];

$pk        = $conf_db->getPk($table);
$colunas   = $conf_db->getColumns($table);
$infoTable = $conf_db->getInfoTable($table);
$msg       = [];

$event = '$event';


//Adiciona uma bara no final do caminho caso não existir

if(isset($criar_bo)){
    if(substr($caminhoBackEnd,strlen($caminhoBackEnd)-1,1) != '/' ){
        $caminhoBackEnd .='/';
    }
    $caminhoHelpers = $caminhoBackEnd.$caminhoHttp.'Helpers.php';
    //verificar se existe arquivo helpers

    //verifica se determinadas pastas já existem no sistema
    if (!file_exists($caminhoHelpers)) {
        //vamos criar o arquivo Helpers.php
        require_once("bo/helpers.php");
        $caminhoComposer = $caminhoRaizBanckend.'/composer.json';
        require_once("bo/write.composerjson.php");
    }
    //vamos criar o model
    $caminhoModel = $caminhoBackEnd;
    require_once("bo/model.php");
    
    //vamos criar o controller
    $caminhoController = $caminhoBackEnd.$caminhoHttp.'Controllers/';
    require_once("bo/controller.php");
    if(!empty($checkboxRotaApi)){
        $caminhoRouteApi = $caminhoRaizBanckend."/routes".'/api.php';
        require_once("bo/routeapi.php");
    }



    
}
// die;
if(isset($_POST['criar_fo'])){
    if(substr($caminho,strlen($caminho)-1,1) != '/' ){
        $caminho .='/';
    }
    

    $caminhoComponent =$caminho.$nameComponent;
    $nameComponentQuebrar = explode('_',$nameComponent);
    $nameComponentTrocarUnderlinePorPrimieraMaiuscula = '';
    if(count($nameComponentQuebrar)>1){
        $contador=0;
        foreach ($nameComponentQuebrar as $key => $value) {
            $contador++;
            if($contador == 1){
                $nameComponentTrocarUnderlinePorPrimieraMaiuscula .=$value;
            }else{
                $nameComponentTrocarUnderlinePorPrimieraMaiuscula .=ucfirst($value);
            }
        }
    }else{
        $nameComponentTrocarUnderlinePorPrimieraMaiuscula =$nameComponent;
    }
    
    $pastaApi = 'app';
    require_once("frontend/app/api.php");
    require_once("frontend/app/errorhandler.php");
    require_once("frontend/app/routes.php");
    $pastaShared = "shared";
    require_once("shared/index.php");
    $pastaPipes = "pipes";
    require_once("frontend/pipes/index.php");
    require_once("frontend/src/index.php");
    $pastaComponentView = $nameComponent;
    require_once("frontend/componentHtml.php");
    require_once("frontend/componentTs.php");
    require_once("frontend/componentCss.php");
    require_once("frontend/componentService.php");
    require_once("frontend/componentModel.php");
    require_once("frontend/componentModule.php");
    if(!empty($inserir)){
        $pastaComponentInsert = 'incluir';
        require_once("frontend/incluir/index_incluir.php");
    }    
    if(!empty($alterar)){
        $pastaComponentAlterar = 'alterar';
        require_once("frontend/alterar/index_alterar.php");
    }
    if(!empty($detalhar)){
        $pastaComponentDetalhar = 'detalhar';
        require_once("frontend/detalhar/index.php");
    }
    
    
}   

// Mensagens de erros
if( isset($_POST['criar_fo']) || isset($_POST['criar_bo'])){
   new Mensagem($msg);
}

// function file_force_contents($filename, $data, $flags = 0){
//     if(!is_dir(dirname($filename)))
//         mkdir(dirname($filename).'/', 0777, TRUE);
//     return file_force_contents($filename, $data,$flags);
// }

function file_force_contents($dir, $contents){
    $parts = explode('/', $dir);
    $file = array_pop($parts);
    $dir = '';
    foreach($parts as $part)
        if(!is_dir($dir .= "/$part")) mkdir($dir,0777);
    return file_put_contents("$dir/$file", $contents);
}

function verificarSeRegraExiste($new,$encontrarPosicionar,$comparacao,$arquivo,$posicaosalvar=1,$achareparar = false){
    $declarado = false;
    $new = $new;
    $pastaApi ='app';
    $posicaoAddUrl = null;

    $array_texto = file($arquivo,FILE_IGNORE_NEW_LINES);
    $encontrarPosicionar = $encontrarPosicionar;
    $comparacao = $comparacao;
    //percorrendo arquivo
    $i =0;
    foreach ($array_texto as $line_num => $line) {
        $i++;
        
        $explodeComposer = explode($encontrarPosicionar,$line);
        if(count($explodeComposer)>1){
            $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
        }
        if($encontrarPosicionar == 'regra-0'){
            $posicaoAddUrl = 0;
        }
        if($encontrarPosicionar == 'regra-ultimalinha'){
            $posicaoAddUrl = count($array_texto);
        }
        if($posicaoAddUrl!=null){
            if($achareparar){
                break;
            }
        }

        //Vericando se a URL nova já existe no arquivo .htaccess
        $explodeComparacao = explode($comparacao,$line);
        if(count($explodeComparacao)>1){
            $declarado = true; 
            break;
        }
    }

    if($declarado){
        return 'alert';
        // return'Já existe a regra <small><b>('.$new.')</b></small> em app.routes.ts';
    }else{
        //Pegando regra atual para concatenar com nova regra
        $textoOriginal = $array_texto[$posicaoAddUrl];
        if($posicaosalvar == 1){
            $array_texto[$posicaoAddUrl] =$new."\n".$textoOriginal;
        }else{
            $array_texto[$posicaoAddUrl] =$textoOriginal."\n".$new;
        }
        //Adicionando nova regra no local correto
        if(file_force_contents($arquivo,implode("\n",$array_texto))){
            return $new .' <br />Adicionado routes.ts';
        }else{
            return false;
        }   
    }
}