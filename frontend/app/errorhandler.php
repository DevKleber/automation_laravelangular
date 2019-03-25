<?php
$errorHandler = "import { ErrorHandler, Injectable, Injector, NgZone,EventEmitter } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http'
import { Observable, timer } from 'rxjs'

import { NotificationService } from './shared/messages/notification.service'
import { Message } from '@angular/compiler/src/i18n/i18n_ast';
import { Router } from '@angular/router';


@Injectable()
export class ApplicationErrorHandler extends ErrorHandler {

  constructor(private ns: NotificationService, private injector: Injector, private zone: NgZone) {
    super()
  }

  handleError(errorResponse: HttpErrorResponse | any) {
    
    if (errorResponse instanceof HttpErrorResponse) {
      // const message = errorResponse.error.message
      const error = (typeof errorResponse.error !== 'object') ? JSON.parse(errorResponse.error): errorResponse.error;
      this.zone.run(() => {
        switch (errorResponse.status) {
          case 400:
            if(error.error === 'token_expired' ||error.error === 'token_invalid' || error.error === 'A token is required' || error.error === 'token_not_provider'){
              this.ns.notify(\"token expirado\");
            }else{
              
            }
            break;
          case 401:
            if(error.error === 'token_has_been_blacklisted'){
              this.ns.notify(\"token na lista negra\");
              this.goToLogin();
            }
            break;
          case 403:
            console.log(\"error 403\")
            this.ns.notify(error || 'Não autorizado.')
            break;
          case 404:
            console.log(\"error 404\")
            this.ns.notify(error || 'Recurso não encontrado. Verifique o console para mais detalhes')
            break
          case 408:
            this.ns.notify(\"tempo fim\")
            break;


        }
      })

    }
    super.handleError(errorResponse)
  }
  goToLogin(path?){
    const router = this.injector.get(Router);
    router.navigate([`/\${path}`]);
  }
}";
//caminho onde vai ser criado o arquivo
$apperrorhandler = $caminho.'app.error-handler.ts';
if (file_force_contents($apperrorhandler,$errorHandler)){
    $msg['success'][$pastaApi][] = 'app.error-handler.ts';    
    @chmod($caminho,0777);
    @chmod($apperrorhandler,0777);
    //importanto em app.module.ts
    require_once("frontend/module/appmodule.php");
}else{
    $msg['success'][$pastaApi][] = 'ERROR|app.error-handler.ts';
}