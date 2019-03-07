<?php

$nameGetServices =$nameComponentTrocarUnderlinePorPrimieraMaiuscula;
if($helpers->checkLastChar($nameComponentTrocarUnderlinePorPrimieraMaiuscula) != 's'){
    $nameGetServices =$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'s';
}
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
      this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".save(uploadData)
        .subscribe(data => {
          form.fileimg = data.file

          this.loader = false;
          this.saveForm(form)
        },
        response => {
          this.loader = false;
            if (response.status === 401) {
              this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".notify(\"não foi possivel salvar\");
            } if (response.status === 0) {
              this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".notify(\"SERVIDOR OFFILINE\");
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
    this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".save(form)
      .subscribe(data => {
        this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".notify(data.response);
        this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".goTo()
        this.loader = false;
      },
      
      response => {true
        this.loader = false;
          if (response.status === 401) {
            this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".notify(\"não foi possivel salvar\");
          } if (response.status === 0) {
            this.".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".notify(\"SERVIDOR OFFILINE\");
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















$component = '
import { Component, OnInit } from \'@angular/core\';
import { FormBuilder, FormControl, FormGroup } from \'@angular/forms\';
import { NotificationService } from \'../shared/messages/notification.service\';
import { '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).' } from \'./'.$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'.model\'
import { '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service } from \'./'.$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'.service\';

import { Observable } from \'rxjs\';

@Component({
  selector: \'app-incluir\',
  templateUrl: \'./incluir.component.html\',
  styleUrls: [\'./incluir.component.css\']
})
export class '.$componentName.' implements OnInit {
  '.$nameRecebeService.': '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).';
  loader: boolean = true;
  '.$variaveis.'

  constructor(private '.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service: '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service, private fb: FormBuilder, private notificationService: NotificationService) { }

  ngOnInit() {
    this.initializeFormEmpty();
  }
  
  initializeFormEmpty() {
    this.form = this.formBuilder.group({
      title: this.formBuilder.control(\'\', [Validators.required]),
      subtitle: this.formBuilder.control(\'\', [Validators.required]),
      link: this.formBuilder.control(\'\', [Validators.required]),
      sort_order: this.formBuilder.control(\'\'),
      tipo: this.formBuilder.control(\'\'),
      fileimg: this.formBuilder.control(\'\')

    })
  }
  '.$save.'
  
}

';


//caminho onde vai ser criado o arquivo
$caminhoTs = $caminhoComponent.'/incluir/incluir.componenet.ts';

if (file_force_contents($caminhoTs,$component)){
    $msg['success'][] = 'Arquivo '.$caminhoTs.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoTs,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoTs;
}