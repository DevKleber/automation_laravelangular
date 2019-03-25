<?php

// $nameGetServices =$nameComponentTrocarUnderlinePorPrimieraMaiuscula;
// if($helpers->checkLastChar($nameComponentTrocarUnderlinePorPrimieraMaiuscula) != 's'){
//     $nameGetServices =$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'s';
// }
$nameRemoverUltimo = $helpers->removerUltimoCaracter($nameGetServices);

$nameRecebeService = lcfirst($nameGetServices);
$nameGetServices   = ucfirst($nameGetServices);
$componentName     = ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Component';

$variaveis = '';
$save .='save(form) {
    this.'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service.save(form)
  }';
if($uparImage){
  $variaveis .="img: any = 'assets/img/user/padrao.jpg';
  selectedFile: File;";
  
  $save      = "save(form) {
    this.uploadFile(form)
  }

  uploadFile(form) {
    const uploadData = new FormData();
    if (this.selectedFile) {
      this.loader = true;
      uploadData.append('fileimg', this.selectedFile, this.selectedFile.name);
      this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.save(uploadData)
        .subscribe(data => {
          form.fileimg = data.file

          this.loader = false;
          this.saveForm(form)
        },
        response => {
          this.loader = false;
            if (response.status === 401) {
              this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.notify(\"não foi possivel salvar\");
            } if (response.status === 0) {
              this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.notify(\"SERVIDOR OFFILINE\");
            }

          },
          () => {
          })
    } else {
      this.saveForm(form)
    }
  }

  saveForm(form) {
    this.loader = true;
    this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.save(form)
      .subscribe(data => {
        this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.notify(data.response);
        this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.goTo()
        this.loader = false;
      },
      
      response => {true
        this.loader = false;
          if (response.status === 401) {
            this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.notify(\"não foi possivel salvar\");
          } if (response.status === 0) {
            this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula)."Service.notify(\"SERVIDOR OFFILINE\");
          }

        },
        () => {
        })
  }
  name(nome) {
    return Date.now() + nome
  }
  getExtension(name) {
    return name.split('.').pop();
  }
  onFileChanged(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    switch (this.getExtension(event.target.files[0].name)) {
      case 'pdf': {
        this.img = 'assets/img/file/pdf.svg'
        break;
      }
      case 'txt': {
        this.img = 'assets/img/file/txt.svg'
        break;
      }
      case 'pptx': case 'ppt': case 'pps': {
        this.img = 'assets/img/file/ppt.svg'
        break;
      }
      case 'xls': case 'xlsx': {
        this.img = 'assets/img/file/xls.svg'
        break;
      }
      case \"doc\": case \"docx\": case \"dotx\": case \"dot\": {
        this.img = 'assets/img/file/docs.svg'
        break;
      }
      default: {
        this.img = tmppath;
        break;
      }
    }
    this.selectedFile = event.target.files[0];

  }";
}








$formInit = [];
foreach ($colunas as $key => $value) {
  $buscaImage = explode("img",$value);
  if(count($buscaImage)>1){
    $formInit[] ="fileimg: this.formBuilder.control('')";
  }else{
	$formInit[] ="$value: this.formBuilder.control('', [Validators.required])";
  }
}





$component = '
import { Component, OnInit } from \'@angular/core\';
import { FormBuilder, FormControl, FormGroup,Validators } from \'@angular/forms\';

import { NotificationService } from \'../../shared/messages/notification.service\';
import { '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).' } from \'./../'.$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'.model\'
import { '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service } from \'./../'.$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'.service\';

import { Observable } from \'rxjs\';

@Component({
  selector: \'app-incluir\',
  templateUrl: \'./incluir.component.html\',
  styleUrls: [\'./incluir.component.css\']
})
export class IncluirComponent implements OnInit {
  '.$nameRecebeService.': '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).';
  loader: boolean = true;
  form: FormGroup;
  '.$variaveis.'

  constructor(private '.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service: '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service, private formBuilder: FormBuilder, private notificationService: NotificationService) { }

  ngOnInit() {
    this.initializeFormEmpty();
  }
  
  initializeFormEmpty() {
    this.form = this.formBuilder.group({
      '.implode(",\n      ",$formInit).'
    })
  }
  '.$save.'
  
}

';


//caminho onde vai ser criado o arquivo
$caminhoTs = $caminhoComponent.'/incluir/incluir.component.ts';

if (file_force_contents($caminhoTs,$component)){
    $msg['success'][$pastaComponentView][$pastaComponentInsert][] = 'incluir.component.ts';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoTs,0777);
  }else{
    $msg['success'][$pastaComponentView][$pastaComponentInsert][] = 'ERROR|incluir.component.ts';    
}