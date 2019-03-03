<?php 
$caminhoSharedModule = 'shared/shared.module.ts';
$caminhoSharedModuleNotificationService = 'shared/messages/notification.service.ts';
$caminhoSharedModuleNotificationCss= 'shared/messages/snackbar/snackbar.component.css';
$caminhoSharedModuleNotificationHtml= 'shared/messages/snackbar/snackbar.component.html';
$caminhoSharedModuleNotificationTs= 'shared/messages/snackbar/snackbar.component.ts';
$caminhoSharedModuleNotificationTs= 'shared/messages/snackbar/snackbar.component.ts';
$caminhoShared = $caminho.$caminhoSharedModule;

//verificar se existe arquivo shared

//verifica se determinadas pastas já existem no sistema
if (!file_exists($caminhoShared)) {
    //vamos criar tudo aqui. 
    require_once("./shared/sharedmodule.php");    
    //agora tenho que ir no app-module e importar o shared module.
}
if (!file_exists($caminho.$caminhoSharedModuleNotificationService)) {
    //vamos criar tudo aqui. 
    require_once("./shared/messages/notificationservicets.php");
}
if (!file_exists($caminho.$caminhoSharedModuleNotificationCss)) {
    //vamos criar tudo aqui. 
    require_once("./shared/messages/snackbar/snackbarcomponentcss.php");
}
if (!file_exists($caminho.$caminhoSharedModuleNotificationHtml)) {
    //vamos criar tudo aqui. 
    require_once("./shared/messages/snackbar/snackbarcomponenthtml.php");
}
if (!file_exists($caminho.$caminhoSharedModuleNotificationTs)) {
    //vamos criar tudo aqui. 
    require_once("./shared/messages/snackbar/snackbarcomponentts.php");
}
