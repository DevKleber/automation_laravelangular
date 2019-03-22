<?php
$colunasHtml = $colunas;
unset($colunasHtml['id']);
$fillable = "'".implode("','",$colunasHtml)."'";

$c = ucfirst($componentName);
$option = '';
$td = '';


$nameRemoverUltimo = $helpers->removerUltimoCaracter($nameGetServices);
foreach ($colunasHtml as $key => $value) {
}
$nameRecebeService = lcfirst($nameGetServices);

$componentName = ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Component';
$component = '
import { Component, OnInit } from \'@angular/core\';
import { FormBuilder, FormControl, FormGroup } from \'@angular/forms\';
import { NotificationService } from \'../shared/messages/notification.service\';
import { '.ucfirst($nomeComponent).' } from \'./'.$nameComponent.'.model\'
import { '.ucfirst($nomeComponent).'Service } from \'./'.$nameComponent.'.service\';

import { Observable } from \'rxjs\';

@Component({
  selector: \'app-'.lcfirst($nameComponent).'\',
  templateUrl: \'./'.lcfirst($nameComponent).'.component.html\',
  styleUrls: [\'./'.lcfirst($nameComponent).'.component.css\']
})
export class '.$nomeComponent.'Component implements OnInit {
  '.$nameRecebeService.': '.ucfirst($nomeComponent).'[];
  searchForm: FormGroup
  searchControl: FormControl
  loader: boolean = true;
  page: number = 1;
  itensPorPagina = 10;

  constructor(private '.lcfirst($nomeComponent).'Service: '.ucfirst($nomeComponent).'Service, private fb: FormBuilder, private notificationService: NotificationService) { }

  ngOnInit() {
    this.searchControl = this.fb.control(\'\')
    this.searchForm = this.fb.group({
      searchControl: this.searchControl
    })

    this.get'.$nameGetServices.'();

  }

  get'.$nameGetServices.'() {
    this.'.lcfirst($nomeComponent).'Service.get'.$nameGetServices.'().subscribe('.$nameRemoverUltimo.' => {
      this.'.$nameRecebeService.' = '.$nameRemoverUltimo.'[\'dados\']
      this.loader = false
    });
  }

  InativarDepoimento('.$nameRemoverUltimo.') {

    if (confirm(\'Você tem certeza que deseja remover o (a)  '.$componentName.' \')) {
      this.loader = true
      this.'.lcfirst($nomeComponent).'Service.inativar('.$nameRemoverUltimo.'.id).subscribe((data) => {
        if (data[\'dados\']) {
          '.$nameRemoverUltimo.'.bo_ativo = false;
          // this.'.$nameRecebeService.'.splice(this.'.$nameRecebeService.'.indexOf('.$nameRemoverUltimo.'),1)
          this.notificationService.notify(`'.$nameRemoverUltimo.' inativado`)
        }
        this.loader = false
      });
    }

  }

  
  update(form) {
    this.'.lcfirst($nomeComponent).'Service.update(form, form.id)
  }
}

';


//caminho onde vai ser criado o arquivo
$caminhoTs = $caminhoComponent.'/'.$nameComponent.'.component.ts';

if (file_force_contents($caminhoTs,$component)){
    $msg['success'][] = 'Arquivo '.$caminhoTs.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoTs,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoTs;
}