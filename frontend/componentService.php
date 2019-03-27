<?php
$uparImage = false;
foreach ($colunas as $key => $value) {
  $buscaImage = explode("img",$value);
  if(count($buscaImage)>1){
      $uparImage = true;
  }
}
$insert = "save(form) {
    return this.http.post<any>(`\${API}/".$namerotaangular."`, form)
    .subscribe((data) => {
        if (data['dados']) {
          this.notify('Registro Inserido Com Sucesso!');
          this.router.navigate(['/".$namerotaangular."'])
        }
        console.log(data);
      }, (error) => {
        this.notify(`Error: \${error}`);
      });
    }
";
$update = "update(form,id) {
    return this.http.put(`\${API}/".$namerotaangular."/\${id}`, form)
    .subscribe((data) => {
      if (data['response']) {
        this.notify('Registro Alterado Com Sucesso!');
        this.router.navigate(['/".$namerotaangular."'])
      }
      console.log(data);
    }, (error) => {
      this.notify(`Error: \${error}`);
    });
  }";

  $inativar = "inativar(id: string) {
    return this.http.delete(`\${API}/".$namerotaangular."/\${id}`)

  }";

if($uparImage){
  
  $insert = "save(form) {
    return this.http.post<any>(`\${API}/".$namerotaangular."`, form)
    .pipe(
      tap(user => {
  
      })
    )
  }";

  $update = "update(form,id) {
    return this.http.put(`\${API}/".$namerotaangular."/\${id}`, form)
    .pipe(
      tap(user => {
  
      })
    )
  }";
  $inativar = "inativar(id: string) {
    return this.http.delete(`\${API}/".$namerotaangular."/\${id}`)

  }";
}

$componentService = "import { Injectable } from '@angular/core'
import { Observable } from 'rxjs'
import { tap, filter } from 'rxjs/operators'
import { HttpClient } from '@angular/common/http'
import { Router, NavigationEnd } from '@angular/router'

import { $nomeComponent } from './".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".model'


import { NotificationService } from '../shared/messages/notification.service';
import { API } from '../app.api'

@Injectable({
  providedIn: 'root'
})

export class ".$nomeComponent."Service {

  constructor(
    private http: HttpClient,
    private notificationService: NotificationService,
    private router: Router
  ) { }

  get".$nameGetServices."(search?: string): Observable<".ucfirst($nomeComponent)."[]> {

    return this.http.get<".ucfirst($nomeComponent)."[]>(`\${API}/".$namerotaangular."`)
  }


  get".lcfirst($nomeComponent)."ById(id: string): Observable<".ucfirst($nomeComponent)."> {
    return this.http.get<".ucfirst($nomeComponent).">(`\${API}/".$namerotaangular."/\${id}`)

  }

  ".$insert."
  ".$update."
  ".$inativar."

  notify(msg) {
    this.notificationService.notify(msg);
  }
  goTo(path: string = 'depoimento') {
    this.router.navigate([`/\${path}`])
  }
}
";

$caminhoService = $caminhoComponent.'/'.$nameComponent.'.service.ts';
if (file_force_contents($caminhoService,$componentService)){
    $msg['success'][$pastaComponentView][] = $nameComponent.'.service.ts';
    @chmod($caminhoService,0777);
  }else{
    $msg['success'][$pastaComponentView][] = 'ERROR|'.$nameComponent.'.service.ts';
}