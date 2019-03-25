<?php

$componentCss = ' ';

$caminhoCss = $caminhoComponent.'/'.$nameComponent.'.component.css';
if (file_force_contents($caminhoCss,$componentCss)){
    $msg['success'][$pastaComponentView][] = $nameComponent.'.component.css';
    @chmod($caminhoCss,0777);
}else{
    $msg['success'][$pastaComponentView][] = 'ERROR|'.$nameComponent.'.component.css';
}