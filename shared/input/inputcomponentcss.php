<?php

$notificationCss = ' 
.control-error{margin: 1px 0 0 0!important;}
';


if (file_force_contents($caminho.$caminhoMessageCss,$caminhoMessageCss)){
    $msg['success'][] = 'Arquivo '.$caminho.$caminhoMessageCss.'</b> criado com sucesso';    
    chmod($caminho.'shared/input',0777);
    chmod($caminho.$caminhoMessageCss,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminho.$caminhoMessageCss;
}