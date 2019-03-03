<?php

$notificationService = ' 
import { EventEmitter } from "@angular/core";

export class NotificationService{
    notifier = new EventEmitter<string>()

    notify(message:string){
        this.notifier.emit(message)
    }
}
';

$caminhoHtml = $caminhoComponent.'/'.$nameComponent.'.component.html';
if (file_force_contents($caminho.$caminhoSharedModuleNotificationService,$notificationService)){
    $msg['success'][] = 'Arquivo '.$caminho.$caminhoSharedModuleNotificationService.'</b> criado com sucesso';    
    chmod($caminho.'shared',0777);
    chmod($caminho.$caminhoSharedModuleNotificationService,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminho.$caminhoSharedModuleNotificationService;
}