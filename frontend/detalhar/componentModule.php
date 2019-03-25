<?php
$module = "import { NgModule } from '@angular/core'
import { SharedModule } from '../../shared/shared.module'
import { RouterModule, Routes } from '@angular/router'
import { DetalharComponent } from './detalhar.component';

const ROUTES: Routes = [
  { path: '', component: DetalharComponent }
];
@NgModule({
  declarations: [
    DetalharComponent
  ],
  imports: [
    SharedModule,
    RouterModule.forChild(ROUTES)
  ]
})
export class detalharModule { }";

//caminho onde vai ser criado o arquivo
$caminhoInsertModule = $caminhoComponent.'/detalhar/detalhar.module.ts';
if (file_force_contents($caminhoInsertModule,$module)){
    $msg['success'][] = 'Arquivo '.$caminhoInsertModule.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoInsertModule,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoInsertModule;
}