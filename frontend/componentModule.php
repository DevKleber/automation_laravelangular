
<?php

$componentModule = "import { NgModule } from '@angular/core';
import { SharedModule } from '../shared/shared.module';
import { RouterModule, Routes } from '@angular/router';
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
    $msg['success'][$pastaComponentView][] = $nameComponent.'.module.ts';
    @chmod($caminhoModule,0777);
  }else{
    $msg['success'][$pastaComponentView][] = 'ERROR|'.$nameComponent.'.module.ts';
}