<?php
$sharedmodule = "
import { NgModule, ModuleWithProviders } from '@angular/core';
import { CommonModule } from '@angular/common'
import { FormsModule, ReactiveFormsModule } from '@angular/forms'

import { InputComponent } from './input/input.component'

import { SnackbarComponent } from './messages/snackbar/snackbar.component'

import {HTTP_INTERCEPTORS} from '@angular/common/http'

import { NotificationService } from './messages/notification.service'

// pipes
import { SafeHtml } from '../pipes/safe-html.pipe';
import { ImagemTipoarquivoPipe } from '../pipes/imagem-tipoarquivo.pipe';


@NgModule({
    declarations: [
        InputComponent,
        SnackbarComponent,
        SafeHtml,
        ImagemTipoarquivoPipe
    ],
    
    imports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule
    ],
    exports: [
        InputComponent,
        CommonModule,
        FormsModule,
        ReactiveFormsModule,
        SnackbarComponent,
        SafeHtml,
        ImagemTipoarquivoPipe
    ]
})
export class SharedModule {
    static forRoot(): ModuleWithProviders {
        return {
            ngModule: SharedModule,
            providers:[
                NotificationService
            ]
        }
    }
}
";
$caminhoHtml = $caminhoComponent.'/'.$nameComponent.'.component.html';
if (!is_dir($caminho.'shared')) {
    mkdir($caminho.'shared',0700);
}

if (file_force_contents($caminho.$caminhoSharedModule,$sharedmodule)){
    $msg['success'][$pastaShared][] = 'shared.module.ts';    
    @chmod($caminho.'shared',0700);
    @chmod($caminho.$caminhoSharedModule,0700);
}else{
    $msg['success']["$pastaShared"][] = 'ERROR|shared.module.ts';
}