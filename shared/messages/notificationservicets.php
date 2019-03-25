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
if (!is_dir($caminho.'shared/messages')) {
    mkdir($caminho.'shared/messages',0700);
}
if (file_force_contents($caminho.$caminhoSharedModuleNotificationService,$notificationService)){
    $msg['success'][$pastaShared]['messages'][] = 'notification.service.ts';    
    @chmod($caminho.'shared',0777);
    @chmod($caminho.$caminhoSharedModuleNotificationService,0777);
}else{
    $msg['success'][$pastaShared]['messages'][] = 'ERROR|notification.service.ts';    
}