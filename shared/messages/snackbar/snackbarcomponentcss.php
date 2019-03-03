<?php

$notificationcss = ' 

div.snackbar-container{text-align: center!important}
.snackbar-container {
  /* transition: all 500ms ease; */
  /* transition-property: top, right, bottom, left, opacity; */
  font-family: Roboto, sans-serif;
  font-size: 14px;
  min-height: 14px;
  background-color: #070b0e;
  position: fixed;
  /* display: flex; */
  justify-content: space-between;
  /* align-items: center; */
  color: white;
  line-height: 22px;
  padding: 18px 24px;
  /* bottom: 0; */
  /* top: 0; */
  z-index: 9999;
  text-align: center!important;
}

.snackbar-container {
  
  text-align: center!important;
  text-transform: uppercase;
  cursor: pointer;
}

@media (min-width: 640px) {
  .snackbar-container {
    /* min-width: 288px;
    max-width: 568px;
    display: inline-flex;
    border-radius: 2px;
    margin: 15px;
    bottom: -100px;
    text-align: center!important; */
  }
}

@media (max-width: 640px) {
  .snackbar-container {
    /* left: 0;
    right: 0;
    text-align: center!important; */
  }
}

.snackbar-pos.bottom-center {
  top: auto !important;
  bottom: 0;
  left: 50%;
  transform: translate( -50%);
  text-align: center!important;
}

.snackbar-pos.bottom-left {
  top: auto !important;
  bottom: 0;
  left: 0;
  text-align: center!important;
}

.snackbar-pos.bottom-right {
  top: auto !important;
  bottom: 0;
  right: 0;
  text-align: center!important;
}

.snackbar-pos.top-left {
  bottom: auto !important;
  top: 0;
  left: 0;
  text-align: center!important;
}

.snackbar-pos.top-center {
  bottom: auto !important;
  top: 0;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center!important;
}

.snackbar-pos.top-right {
  bottom: auto !important;
  top: 0;
  right: 0;
  text-align: center!important;
}
';


if (file_force_contents($caminho.$caminhoSharedModuleNotificationCss,$notificationcss)){
    $msg['success'][] = 'Arquivo '.$caminho.$caminhoSharedModuleNotificationCss.'</b> criado com sucesso';    
    chmod($caminho.'shared',0777);
    chmod($caminho.$caminhoSharedModuleNotificationCss,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminho.$caminhoSharedModuleNotificationCss;
}