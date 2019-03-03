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
    
    
    require_once("shared/index.php");

    // criar component list table 
    require_once("frontend/componentHtml.php");
    // criar component 
    require_once("frontend/componentTs.php");
    // criar component inserir 
    // criar component alterar 
    // criar component detalhar
    // die;
    
    


    //chama o arquivo para criar o ANGULAR (FRONT-END)
    // if($_POST['checkboxRotaApi']){
    //     require_once("write.htaccess.php");
    //     require_once("write.menu.php");
    // }
    // require_once("frontend/view.php");
    // require_once("frontend/modules.php");
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