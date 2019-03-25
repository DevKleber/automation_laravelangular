<?php

$notificationCss = ' 
.control-error{margin: 1px 0 0 0!important;}
';


if (file_force_contents($caminho.$caminhoMessageCss,$notificationCss)){
    $msg['success'][$pastaShared]['input'][] = 'input.component.css';    
    @chmod($caminho.'shared/input',0777);
    @chmod($caminho.$caminhoMessageCss,0777);
}else{
    $msg['success'][$pastaShared]['input'][] = 'ERROR|input.component.css';    
}