<?php
$uparImage = false;
foreach ($colunas as $key => $value) {
  $buscaImage = explode("img",$value);
  if(count($buscaImage)>1){
      $uparImage = true;
  }
}
$insert = "save(form): Observable<any> {
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
  }
";
$update = "update(form,id) {
    return this.http.put(`\${API}/".$namerotaangular."/\${id}\`, form)
    .subscribe((data) => {
      if (data['dados']) {
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
    .subscribe((data) => {
      if (data['dados']) {
        this.notify('Registro Inativado Com Sucesso!');
        this.router.navigate(['/".$namerotaangular."'])
      }
      console.log(data);
    }, (error) => {
      this.notify(`Error: \${error}`);
    });
  }";

if($uparImage){
  
  $insert = "save(form): Observable<any> {
    return this.http.post<any>(`\${API}/".$namerotaangular."`, form)
    .pipe(
      tap(user => {
  
      })
    )
  }";

  $update = "update(form,id) {
    return this.http.put(`\${API}/".$namerotaangular."/\${id}\`, form)
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

import { ".ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)." } from './".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".model'


import { NotificationService } from '../shared/messages/notification.service';
import { API } from '../app.api'

@Injectable({
  providedIn: 'root'
})

export class DepoimentoService {

  constructor(
    private http: HttpClient,
    private notificationService: NotificationService,
    private router: Router
  ) { }

  get".$nameGetServices."(search?: string): Observable<".ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."[]> {

    return this.http.get<".ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."[]>(`\${API}/".$namerotaangular."`)
  }


  depoimentoById(id: string): Observable<".ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."> {
    return this.http.get<".ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).">(`\${API}/".$namerotaangular."/\${id}`)

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
    $msg['success'][] = 'Arquivo '.$caminhoService.'</b> criado com sucesso';
    chmod($caminhoService,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoService;
}