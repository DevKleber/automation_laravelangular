<?php
$griFields = '';
$rowGridMutator = '';
foreach ($colunas as $key => $c) {
    if ($c !== $pk){
    $griFields .= "array(
            'name'  => '$c',
            'label' => '$c'
        ),";
    }
    $rowGridMutator .='
    if ($row["'.$c.'"]) {
        $row["'.$c.'"] = $row["'.$c.'"];
    }';

}
$c = ucfirst($nameMod);

$cifrao='$';
$aspasDuplas = '"';

$modAdmin = "<?php

require_once 'base.mod.php';
class ".$c." extends Base
{
    public $cifrao"."modName = '$nameMod';
    public $cifrao"."modTitle = '$nameMod';
    public $cifrao"."entity = '$table';
    public $cifrao"."sortable = true;
    public $cifrao"."langLayout = true;
    public $cifrao"."icon = 'fa fa-th-large';

    public static $cifrao"."tipos;

    public function __construct()
    {

        $cifrao"."this->viewPath = '$nameMod';
        $cifrao"."this->view     = $cifrao"."this->viewPath . '/listar';

        
        $cifrao"."this->gridFields = array(
            
        $griFields

        );
        $cifrao"."this->search_fields = array(
            'titulo'
        );

        parent::__construct();
    }
    public function rowGridMutator($cifrao"."row)
    {
        $rowGridMutator
        return parent::rowGridMutator($cifrao"."row);
    }
    
    
    public function insert_to_db($cifrao"."redirect = true)
    {
        parent::insert_to_db($cifrao"."redirect);
    }

    public static function getAll($cifrao"."where = 'is_active = 1')
    {
        return get_sql('SELECT * FROM $table ' . ($cifrao"."where ? ' WHERE ' . $cifrao"."where : ''), 'array');
    }

    public static function getById($cifrao"."id)
    {
        return current(get_sql($aspasDuplas SELECT * FROM $table WHERE id = '$aspasDuplas. $cifrao"."id . $aspasDuplas'$aspasDuplas , 'array'));
    }

}   
";
//caminho onde vai ser criado o arquivo
$caminhoboModules = $caminho.'admin/includes/modules/';
//Criando arquivo
if (file_put_contents($caminhoboModules . $nameMod.'.mod.php',$modAdmin)) {
    $msg['success'][] = 'Arquivo '.$caminhoboModules .'<b>'. $nameMod.'.mod.php</b> criado com sucesso';    
    chmod($caminhoboModules.$nameMod.'.mod.php',0777);
} else {
    $msg['error'][] = 'Erro ao criar '.$caminhoboModules .'<b>'. $nameMod.'.mod.php </b>';
}
