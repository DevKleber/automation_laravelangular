
<?php

$componentModule = "import { NgModule } from '@angular/core'
import { SharedModule } from '../shared/shared.module'
import { RouterModule, Routes } from '@angular/router'
import { $componentName } from './$nameComponent.component';

const ROUTES: Routes = [
  { path: '', component: $componentName }
];
@NgModule({
  declarations: [
    $componentName,
  ],
  imports: [
    SharedModule,
    RouterModule.forChild(ROUTES)
  ]
})
export class ".ucfirst($nameGetServices)."Module { }";

$caminhoModule = $caminhoComponent.'/'.$nameComponent.'.module.ts';
if (file_force_contents($caminhoModule,$componentModule)){
    $msg['success'][] = 'Arquivo '.$caminhoModule.'</b> criado com sucesso';
    chmod($caminhoModule,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoModule;
}