<?php

$notificationHtml = ' 
<div class="snackbar-container snackbar-pos bottom-center"  [@snack-visibility]="snackVisibility" >
  {{message}} 
  <!-- <button class="action" ></button> -->
</div>

';


if (file_force_contents($caminho.$caminhoSharedModuleNotificationHtml,$notificationHtml)){
    $msg['success'][] = 'Arquivo '.$caminho.$caminhoSharedModuleNotificationHtml.'</b> criado com sucesso';    
    chmod($caminho.'shared',0777);
    chmod($caminho.$caminhoSharedModuleNotificationHtml,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminho.$caminhoSharedModuleNotificationHtml;
}