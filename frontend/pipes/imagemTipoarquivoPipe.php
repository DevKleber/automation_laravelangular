<?php
$fileText = "
import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'imagemTipoArquivo'
})
export class ImagemTipoarquivoPipe implements PipeTransform {

  transform(value: any, args?: any): any {
    return this.convertMesToString(value);
  }
  convertMesToString(arquivo: string) {
    let extensao = this.getExtension(arquivo).toLowerCase();
    let tipo = ''
    switch (extensao) {
        case 'pdf': {
            tipo = 'assets/img/file/pdf.svg'
            break;
          }
          case 'txt': {
            tipo = 'assets/img/file/txt.svg'
            break;
          }
          case 'pptx': case 'ppt': case 'pps': {
            tipo = 'assets/img/file/ppt.svg'
            break;
          }
          case 'xls': case 'xlsx': {
            tipo = 'assets/img/file/xls.svg'
            break;
          }
          case \"doc\": case \"docx\": case \"dotx\": case \"dot\": {
            tipo = 'assets/img/file/docs.svg'
            break;
          }
          case \"jpeg\": case \"jpg\": case \"png\": case \"svg\": case \"gif\": case \"bmp\": case \"svg\": case \"svg\": case \"svg\": {
            tipo = 'assets/img/file/picture.svg'
            break;
          }
          default: {
            break;
          }
    }
    return tipo
  }
  getExtension(name) {
    return name.split('.').pop();
  }
}

";

if (file_force_contents($caminhoPipes.'/'.$filePipeImgTipo,$fileText)){
    $msg['success']['pipe'][] = $filePipeImgTipo;    
    @chmod($caminho.'pipes',0777);
    @chmod($caminhoPipes.'/'.$filePipeImgTipo,0777);
}else{
    $msg['success']["pipe"][] = 'ERROR|'.$filePipeImgTipo;
}