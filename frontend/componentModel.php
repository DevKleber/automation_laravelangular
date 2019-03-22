<?php
$model = [];

$typeDb      = array("date","int(11)", "int(4)", "int(3)","text","timestamp","tinyint(4)","tinyint(2)","tinyint(1)","tinyint","tinynumber(4)","tinynumber(2)","tinynumber(1)","tinynumber","time");
$typeAngular = array("string","number", "number", "number","string","string","boolean","boolean","boolean","boolean","boolean","boolean","boolean","boolean","string");


foreach ($infoTable as $key => $value) {
    $model[]="    public ".$value->Field.": ".str_replace($typeDb, $typeAngular, $value->Type);
}
$componentModel = 'export class '.$nomeComponent.'{
    constructor(
    '.implode(",\n    ",$model).'
    ){}
}';

$caminhoModel = $caminhoComponent.'/'.$nameComponent.'.model.ts';
if (file_force_contents($caminhoModel,$componentModel)){
    $msg['success'][] = 'Arquivo '.$caminhoModel.'</b> criado com sucesso';
    chmod($caminhoModel,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoModel;
}