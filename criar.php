<?php
// Turn off error reporting
error_reporting(0);
$conf_db = new Conf_db();
$helpers = new Helpers();

$table               = $_POST['table'];
$nameComponent       = $_POST['nameComponent'];
$namerotaangular     = $_POST['namerotaangular'];
$criar_fo            = $_POST['criar_fo'];
$caminho             = $_POST['caminho'];
$checkboxUrlAmigavel = $_POST['checkboxUrlAmigavel'];
$urlamigavel         = $_POST['urlamigavel'];

//backend
$checkboxRotaApi              = $_POST['checkboxRotaApi'];
$criar_bo                     = $_POST['criar_bo'];
$nomeRotaBE                   = $_POST['rotabe'];
$checkboxRotaFeProtegidaToken = $_POST['checkboxRotaFeProtegidaToken'];
$caminhoBackEnd               = $_POST['caminhoBackEnd'];
$filtrarPorToken              = $_POST['filtrarPorToken'];
$nameidtoken                  = $_POST['nameidtoken'];

$caminhoHttp = 'Http/';


$caminhoRaizBanckend = str_replace("/app\/",'',$caminhoBackEnd);
$caminhoRaizBanckend = str_replace("/app",'',$caminhoBackEnd);
$htaccess      = $_POST['confihtacces'];

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



    // Mensagens de erros
    if( isset($_POST['criar_fo']) || isset($_POST['criar_bo'])){
        new Mensagem($msg);
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
    
    
    // require_once("app/api.php");
    // require_once("app/errorhandler.php");
    // require_once("app/routes.php");

    require_once("shared/index.php");
    require_once("frontend/componentHtml.php");
    require_once("frontend/componentTs.php");
    require_once("frontend/componentCss.php");
    require_once("frontend/componentService.php");
    require_once("frontend/componentModel.php");
    require_once("frontend/componentModule.php");
    // criar component inserir 
    require_once("frontend/incluir/index_incluir.php");
    
    // criar component alterar 
    require_once("frontend/alterar/index_alterar.php");
    // criar component detalhar
    // require_once("frontend/incluir/index_incluir.php");
    // die;
    
    
}   

// Mensagens de erros
if( isset($_POST['criar_fo']) || isset($_POST['criar_bo'])){
   new Mensagem($msg);
}

function file_force_contents($filename, $data, $flags = 0){
    if(!is_dir(dirname($filename)))
        mkdir(dirname($filename).'/', 0777, TRUE);
    return file_put_contents($filename, $data,$flags);
}