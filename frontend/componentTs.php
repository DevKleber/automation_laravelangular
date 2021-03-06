<?php
$colunasHtml = $colunas;
unset($colunasHtml['id']);
$fillable = "'".implode("','",$colunasHtml)."'";

$c = ucfirst($componentName);
$option = '';
$td = '';
$columns = '';
foreach ($colunas as $key => $value) {
  $columns.="columns['".$value."'] = { name: '".$value."', show: true }
  ";
}

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
import { Helper } from \'../helper\';
import { BreadcrumbService } from \'../layout/breadcrumb/breadcrumb.service\';

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
  order: any = {}
  columns: any

  constructor(private '.lcfirst($nomeComponent).'Service: '.ucfirst($nomeComponent).'Service, private fb: FormBuilder, private notificationService: NotificationService, private helper: Helper, private breadcrumbService: BreadcrumbService) { }

  ngOnInit() {
    this.searchControl = this.fb.control(\'\')
    this.searchForm = this.fb.group({
      searchControl: this.searchControl
    })
    this.breadcrumbService.chosenPagina("'.ucfirst($nomeComponent).'")
    this.get'.$nameGetServices.'();
    this.order = this.helper.getColumnsByArray(clienteFornecedor[\'dados\'][0])
		this.getColumnsShow(clienteFornecedor[\'dados\'][0]);

  }
  getColumnsShow(ar) {

		let columns = {}
		'.$columns.'
		
		this.columns = columns;
	}

  get'.$nameGetServices.'() {
    this.'.lcfirst($nomeComponent).'Service.get'.$nameGetServices.'().subscribe('.$nameRemoverUltimo.' => {
      this.'.$nameRecebeService.' = '.$nameRemoverUltimo.'[\'dados\']
      this.loader = false
    });
  }

  inativar('.lcfirst($nameRemoverUltimo).') {

    if (confirm(\'Você tem certeza que deseja remover o (a)  '.$componentName.' \')) {
      this.loader = true
      this.'.lcfirst($nomeComponent).'Service.inativar('.lcfirst($nameRemoverUltimo).'.'.$pk.').subscribe((data) => {
        if (data[\'response\']) {
          '.lcfirst($nameRemoverUltimo).'.bo_ativo = 0;
          // this.'.$nameRecebeService.'.splice(this.'.$nameRecebeService.'.indexOf('.lcfirst($nameRemoverUltimo).'),1)
          this.notificationService.notify(`'.lcfirst($nameRemoverUltimo).' inativado`)
        }
        this.loader = false
      });
    }

  }

  
  update(form) {
    this.'.lcfirst($nomeComponent).'Service.update(form, form.id)
  }
  orderby(column) {
    this.'.$nameRecebeService.' = this.helper.orderby(column, this.'.$nameRecebeService.', this.order);
	}
	hideshowColumns(column) {
		this.columns[column].show = this.columns[column].show ? false : true
	}
}

';


//caminho onde vai ser criado o arquivo
$caminhoTs = $caminhoComponent.'/'.$nameComponent.'.component.ts';

if (file_force_contents($caminhoTs,$component)){
    $msg['success'][$pastaComponentView][] = $nameComponent.'.component.ts';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoTs,0777);
  }else{
    $msg['success'][$pastaComponentView][] = 'ERROR|'.$nameComponent.'.component.ts';    
}