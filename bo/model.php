<?php
$griFields = '';
$rowGridMutator = '';
$colunasModel = $colunas;
unset($colunasModel['id']);
$fillable = "'".implode("','",$colunasModel)."'";

$c = ucfirst($nameComponent);


$modAdmin = '<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class '.$c.' extends Model
{
    protected $table = "'.$table.'";
    protected $primaryKey   = "id";
    protected $fillable = ['.$fillable.']; 
} 
';
//caminho onde vai ser criado o arquivo
$caminhoModel = $caminhoModel.ucfirst($nameComponent).'.php';
//Criando arquivo
if (file_force_contents($caminhoModel,$modAdmin)) {
    $msg['laravel']['app'][] = $nameComponent.'.php';    
    @chmod($caminhoModel,0777);
} else {
    $msg['laravel']['app'][] = 'ERROR|'.$nameComponent.'.php';
}
