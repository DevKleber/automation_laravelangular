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
if (file_put_contents($caminhoModel,$modAdmin)) {
    $msg['success'][] = 'Arquivo '.$caminhoModel.'</b> criado com sucesso';    
    chmod($caminhoModel,0777);
} else {
    $msg['error'][] = 'Erro ao criar '.$caminhoModel;
}
