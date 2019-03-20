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
$formInitEmpty = [];
foreach ($colunas as $key => $value) {
  $buscaImage = explode("img",$value);
  if(count($buscaImage)>1){
    $formInitEmpty[] ="fileimg: this.formBuilder.control('')";
    $formInit[] ="fileimg: this.formBuilder.control('')";
  }else{
	$formInitEmpty[] ="$value: this.formBuilder.control('', [Validators.required])";
	$formInit[] ="$value: this.formBuilder.control(".lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).".$value, [Validators.required])";
  }
}



$component = '
import { Component, OnInit } from \'@angular/core\';
import { FormBuilder, FormControl, FormGroup,Validators } from \'@angular/forms\';
import { ActivatedRoute } from \'@angular/router\';
import { NotificationService } from \'../shared/messages/notification.service\';
import { '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).' } from \'./'.$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'.model\'
import { '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service } from \'./'.$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'.service\';
import { API_PATH_IMG } from \'./../../app.api\';
import { Observable } from \'rxjs\';

@Component({
  selector: \'app-alterar\',
  templateUrl: \'./alterar.component.html\',
  styleUrls: [\'./alterar.component.css\']
})
export class '.$componentName.' implements OnInit {
  '.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).': '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).';
  loader: boolean = true;
  form: FormGroup;
  '.$variaveis.'

  constructor(private '.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service: '.ucfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service, private formBuilder: FormBuilder, private notificationService: NotificationService, private router: ActivatedRoute) { }

  ngOnInit() {
    this.initializeFormEmpty();
    this.getProduto();
  }
  getProduto() {
    this.'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'Service.get'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'ById(this.router.snapshot.params[\'id\']).subscribe('.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).' => {
      this.'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).' = '.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'
      if('.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'.img){
        this.img = `${API_PATH_IMG}/'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'/${'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).'.img}`
      }
      this.initializeForm(this.'.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).')
      this.loader = false
    });
  }
  initializeForm('.lcfirst($nameComponentTrocarUnderlinePorPrimieraMaiuscula).') {
    this.form = this.formBuilder.group({
      '.implode(",\n      ",$formInit).'
    })
  }
  initializeFormEmpty() {
    this.form = this.formBuilder.group({
      '.implode(",\n      ",$formInitEmpty).'
    })
  }
  '.$save.'
  
}

';


//caminho onde vai ser criado o arquivo
$caminhoTs = $caminhoComponent.'/alterar/alterar.componenet.ts';

if (file_force_contents($caminhoTs,$component)){
    $msg['success'][] = 'Arquivo '.$caminhoTs.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoTs,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoTs;
}