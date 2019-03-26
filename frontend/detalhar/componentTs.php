<?php

$nameRemoverUltimo = $helpers->removerUltimoCaracter($nameGetServices);

$nameRecebeService = lcfirst($nameGetServices);
// $nameGetServices   = ucfirst($nameGetServices);


$variaveis = '';
$ifgetImg = "";

$imports = "";
if($uparImage){
  $imports = "import { API_PATH_IMG } from './../../app.api';";
  $ifgetImg = "if(".lcfirst($nomeComponent).".img){
        this.img = `\${API_PATH_IMG}/".$nameComponent."/\${".lcfirst($nomeComponent).".img}`
      }";
  $variaveis .="img: any = 'assets/img/user/padrao.jpg';
  selectedFile: File;";
  
}




$component = '
import { Component, OnInit } from \'@angular/core\';
import { FormBuilder, FormControl, FormGroup,Validators } from \'@angular/forms\';
import { ActivatedRoute } from \'@angular/router\';
import { NotificationService } from \'../../shared/messages/notification.service\';
import { '.ucfirst($nomeComponent).' } from \'./../'.$nameComponent.'.model\'
import { '.ucfirst($nomeComponent).'Service } from \'./../'.$nameComponent.'.service\';
'.$imports.'
import { Observable } from \'rxjs\';

@Component({
  selector: \'app-detalhar\',
  templateUrl: \'./detalhar.component.html\',
  styleUrls: [\'./detalhar.component.css\']
})
export class DetalharComponent implements OnInit {
  '.lcfirst($nomeComponent).': '.ucfirst($nomeComponent).';
  loader: boolean = true;
  form: FormGroup;
  '.$variaveis.'

  constructor(private '.lcfirst($nomeComponent).'Service: '.ucfirst($nomeComponent).'Service, private formBuilder: FormBuilder, private notificationService: NotificationService, private router: ActivatedRoute) { }

  ngOnInit() {
    this.get'.$nomeComponent.'();
  }
  get'.$nomeComponent.'() {
    this.'.lcfirst($nomeComponent).'Service.get'.lcfirst($nomeComponent).'ById(this.router.snapshot.params[\'id\']).subscribe('.lcfirst($nomeComponent).' => {
      this.'.lcfirst($nomeComponent).' = '.lcfirst($nomeComponent).'
      '.$ifgetImg.'
      this.loader = false
    });
  }  
}

';


//caminho onde vai ser criado o arquivo
$caminhoTs = $caminhoComponent.'/detalhar/detalhar.component.ts';

if (file_force_contents($caminhoTs,$component)){
    $msg['success'][$pastaComponentView][$pastaComponentDetalhar][] = 'detalhar.component.ts';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoTs,0777);
  }else{
    $msg['success'][$pastaComponentView][$pastaComponentDetalhar][] = 'ERROR|detalhar.component.ts';    
}