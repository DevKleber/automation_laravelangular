<?php
$css = " ";

//caminho onde vai ser criado o arquivo
$caminhoInsertCss = $caminhoComponent.'/alterar/alterar.component.css';
if (file_force_contents($caminhoInsertCss,$css)){
    $msg['success'][$pastaComponentView][$pastaComponentAlterar][] = 'alterar.component.css';
    @chmod($caminhoComponent,0777);
    @chmod($caminhoInsertCss,0777);
}else{
    $msg['success'][$pastaComponentView][$pastaComponentAlterar][] = 'ERROR|alterar.component.css';
}