<?php
// Turn off error reporting
error_reporting(0);
$conf_db = new Conf_db();

$table               = $_POST['table'];
$nameComponent       = $_POST['nameComponent'];
$nameRota       = $_POST['nameRota'];
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
if(substr($caminhoBackEnd,strlen($caminhoBackEnd)-1,1) != '/' ){
    $caminhoBackEnd .='/';
}

if(isset($criar_bo)){
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

    die;
    if (!file_exists($caminho.'admin/includes/views/'.$nameComponent)) {
         mkdir($caminho.'admin/includes/views/'.$nameComponent, 0777, true);
         chmod($caminho.'admin/includes/modules', 0777, true);
        //Da permissão em pastas/sub-pastas e arquivos dentro de /admin
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($caminho.'admin/includes/views/'));
        
        $remove = array("/.");
        foreach($iterator as $item) {
            $item = str_replace($remove,'',$item);
            $last = substr($item, -1);
            if($last == '.'){
                $item = substr($item, 0, -1);
            }
            chmod($item, 0777);
        }
    }
    
    //chama o arquivo para criar o LARAVEL (BACK-END)
    require_once("bo/modules.php");
    require_once("bo/view_adicionar.php");
    require_once("bo/view_listar.php");   
}
die;
if(isset($_POST['criar_fo'])){

    //chama o arquivo para criar o ANGULAR (FRONT-END)
    if($_POST['checkboxRotaApi']){
        require_once("write.htaccess.php");
        require_once("write.menu.php");
    }
    require_once("fo/view.php");
    require_once("fo/modules.php");
}   

// Mensagens de erros
if( isset($_POST['criar_fo']) || isset($_POST['criar_bo'])){
   new Mensagem($msg);
}