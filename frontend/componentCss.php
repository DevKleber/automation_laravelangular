<?php

$componentCss = ' ';

$caminhoCss = $caminhoComponent.'/'.$nameComponent.'.component.css';
if (file_force_contents($caminhoCss,$componentCss)){
    $msg['success'][] = 'Arquivo '.$caminhoCss.'</b> criado com sucesso';
    chmod($caminhoCss,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoCss;
}