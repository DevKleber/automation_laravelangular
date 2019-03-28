<?php
$caminhoAssetsCss = $caminhoRaizFrontEnd.'/assets/css/';
$arquivoCheckbox = "checkbox.css";
//verifica se determinadas pastas já existem no sistema
if (!file_exists($caminhoAssetsCss.$arquivoCheckbox)) {
}
require_once("./frontend/src/checkboxcss.php");