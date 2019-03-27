<?php
$fileText = "
import { Pipe, PipeTransform } from '@angular/core';
import { DomSanitizer} from '@angular/platform-browser';

@Pipe({
  name: 'BooleanMessage'
})
export class BooleanMessagePipe implements PipeTransform {
  constructor(private sanitizer:DomSanitizer){}
  transform(value: any, args?: any): any {
	return this.sanitizer.bypassSecurityTrustHtml(this.tratarBo(value, args));
  }
  tratarBo(value: string, args: string) {
    let texto = '';
    switch (args) {
      case 'simnao': {
        texto = \"SIM\"
        if (value == \"0\") {
          texto = \"NÃO\";
        }
        break;
      }
      case 'bo_ativo': {
        texto = \"ATIVO\"
        if (value == \"0\") {
          texto = \"INATIVO\";
        }
        break;
      }
      case 'bo_ativo_withbg': {
        texto = \"<div class='label label-table label-success'>Ativo</div>\"
        if (value == \"0\") {
          texto = \"<div class='label label-table label-danger'>Inativo</div>\";
        }
        break;
      }
      case 'pagamento': {
        texto = \"PAGO\"
        if (value == \"0\") {
          texto = \"ABERTO\";
        }
        break;
      }
      case 'aguardando': {
        if (value == \"0\") {
          texto = \"Aguardando Pagamento\"
        }
        break;
      }
      case 'frequencia-cor': {
        texto = \"\"
        if (value == \"p\") {
          texto = \"green\";
        }
        if (value == \"f\") {
          texto = \"red\";
        }
        if (value == \"j\") {
          texto = \"\";
        }
        if (value == \"\") {
          texto = \"\";
        }

        if(value == \"+\"){
          texto = \"green\";
        }
        if(value == \"-\"){
          texto = \"#ff0000\";
        }
        if(parseInt(value) < 0){
          texto = \"#ff0000\";
        }
        break;
      }
      default: {
        break;
      }
    }
    return texto;
  }

}

";

if (file_force_contents($caminhoPipes.'/'.$fileBooleanMessage,$fileText)){
    $msg['success']['pipe'][] = $fileBooleanMessage;    
    @chmod($caminho.'pipes',0777);
    @chmod($caminhoPipes.'/'.$fileBooleanMessage,0777);
}else{
    $msg['success']["pipe"][] = 'ERROR|'.$fileBooleanMessage;
}