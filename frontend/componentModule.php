
<?php

$componentModule = "import { NgModule } from '@angular/core'
import { SharedModule } from '../shared/shared.module'
import { RouterModule, Routes } from '@angular/router'
import { ".$nomeComponent."Component } from './$nameComponent.component';

const ROUTES: Routes = [
  { path: '', component: ".$nomeComponent."Component }
];
@NgModule({
  declarations: [
    ".$nomeComponent."Component,
  ],
  imports: [
    SharedModule,
    RouterModule.forChild(ROUTES)
  ]
})
export class ".ucfirst($nomeComponent)."Module { }";

$caminhoModule = $caminhoComponent.'/'.$nameComponent.'.module.ts';
if (file_force_contents($caminhoModule,$componentModule)){
    $msg['success'][] = 'Arquivo '.$caminhoModule.'</b> criado com sucesso';
    chmod($caminhoModule,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoModule;
}