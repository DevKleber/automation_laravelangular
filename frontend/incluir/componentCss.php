<?php
$css = " ";

//caminho onde vai ser criado o arquivo
$caminhoInsertCss = $caminhoComponent.'/incluir/incluir.component.css';
if (file_force_contents($caminhoInsertCss,$css)){
    $msg['success'][$pastaComponentView][$pastaComponentInsert][] = 'incluir.component.css';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoInsertCss,0777);
}else{
    $msg['success'][$pastaComponentView][$pastaComponentInsert][] = 'ERROR|incluir.component.css';    
}