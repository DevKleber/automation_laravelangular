<?php
$module = "import { NgModule } from '@angular/core'
import { SharedModule } from '../../shared/shared.module'
import { RouterModule, Routes } from '@angular/router'
import { AlterarComponent } from './alterar.component';

const ROUTES: Routes = [
  { path: '', component: AlterarComponent }
];
@NgModule({
  declarations: [
    AlterarComponent
  ],
  imports: [
    SharedModule,
    RouterModule.forChild(ROUTES)
  ]
})
export class AlterarModule { }";

//caminho onde vai ser criado o arquivo
$caminhoInsertModule = $caminhoComponent.'/alterar/alterar.module.ts';
if (file_force_contents($caminhoInsertModule,$module)){
    $msg['success'][$pastaComponentView][$pastaComponentAlterar][] = 'alterar.module.ts';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoInsertModule,0777);
  }else{
    $msg['success'][$pastaComponentView][$pastaComponentAlterar][] = 'ERROR|alterar.module.ts'; 
}