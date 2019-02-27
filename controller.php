<?php 
$pag = isset($_GET['pag'])?$_GET['pag']:'';
switch ($pag) {
    case 'home':
        require_once("home.php");
        break;
    case 'criar':
        require_once("criar.php");
        break;
        
    default:
        require_once("home.php");
        break;
}