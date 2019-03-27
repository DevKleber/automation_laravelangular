<?php
$model = [];

$typeDb      = array("date","int(11)", "int(4)", "int(3)","text","timestamp","tinyint(4)","tinyint(2)","tinyint(1)","tinyint","tinynumber(4)","tinynumber(2)","tinynumber(1)","tinynumber","time","decimal(10,2)");
$typeAngular = array("string","number", "number", "number","string","string","boolean","boolean","boolean","boolean","boolean","boolean","boolean","boolean","string","number");


foreach ($infoTable as $key => $value) {
    if($value->Field!="updated_at" and $value->Field != "created_at" ){	
    $model[]="    public ".$value->Field.": ".str_replace($typeDb, $typeAngular, $value->Type);
    }
}
$componentModel = 'export class '.$nomeComponent.'{
    constructor(
    '.implode(",\n    ",$model).'
    ){}
}';

$caminhoModel = $caminhoComponent.'/'.$nameComponent.'.model.ts';
if (file_force_contents($caminhoModel,$componentModel)){
    $msg['success'][$pastaComponentView][] = $nameComponent.'.model.ts';
    @chmod($caminhoModel,0777);
}else{
    $msg['success'][$pastaComponentView][] = 'ERROR|'.$nameComponent.'.model.ts';
}