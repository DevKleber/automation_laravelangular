<?php

$notificationHtml = ' 
<div class="form-group " [class.has-success]="hasSuccess()" [class.has-warning]="hasError()">
  <ng-content></ng-content>
    <label class="control-label control-error" for="inputSuccess">
      <span *ngIf="showTip && hasSuccess()"><i class="fa fa-check"></i>Ok</span>
      <span *ngIf="showTip && hasError()"><i class="fa fa-remove"></i> {{errorMessage}}</span>
    </label>
</div>
';


if (file_force_contents($caminho.$caminhoMessageHtml,$notificationHtml)){
    $msg['success'][] = 'Arquivo '.$caminho.$caminhoMessageHtml.'</b> criado com sucesso';    
    chmod($caminho.'shared/input',0777);
    chmod($caminho.$caminhoMessageHtml,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminho.$caminhoMessageHtml;
}