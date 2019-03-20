<?php
$css = " ";

//caminho onde vai ser criado o arquivo
$caminhoInsertCss = $caminhoComponent.'/alterar/alterar.component.css';
if (file_force_contents($caminhoInsertCss,$css)){
    $msg['success'][] = 'Arquivo '.$caminhoInsertCss.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoInsertCss,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoInsertCss;
}