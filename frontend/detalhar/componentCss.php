<?php
$css = " ";

//caminho onde vai ser criado o arquivo
$caminhoInsertCss = $caminhoComponent.'/detalhar/detalhar.component.css';
if (file_force_contents($caminhoInsertCss,$css)){
    $msg['success'][$pastaComponentView][$pastaComponentDetalhar][] = 'detalhar.component.css';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoInsertCss,0777);
}else{
    $msg['success'][$pastaComponentView][$pastaComponentDetalhar][] = 'ERROR|detalhar.component.css';
}