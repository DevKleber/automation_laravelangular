<?php
// Turn off error reporting
error_reporting(0);
$conf_db = new Conf_db();

$table    = $_POST['table'];
$nameMod  = $_POST['nameMod'];
$htaccess = $_POST['confihtacces'];
$pk       = $conf_db->getPk($table);
$colunas  = $conf_db->getColumns($table);
$caminho  = $_POST['caminho'];
$msg      = [];

//Adiciona um bara no final do caminho caso não existir
if(substr($caminho,strlen($caminho)-1,1) != '/' ){
    $caminho .='/';
}

if(isset($_POST['criar_bo'])){
    
    //verifica se determinadas pastas já existem no sistema
    if (!file_exists($caminho.'admin/includes/views/'.$nameMod)) {
         mkdir($caminho.'admin/includes/views/'.$nameMod, 0777, true);
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
if(isset($_POST['criar_fo'])){

    //chama o arquivo para criar o ANGULAR (FRONT-END)
    if($_POST['checkboxUrlAmigavel']){
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