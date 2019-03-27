<?php
$fileText = "
import { Pipe } from '@angular/core';
import {DomSanitizer, SafeStyle, SafeScript, SafeUrl, SafeResourceUrl} from '@angular/platform-browser';
@Pipe({name: 'safeHtml'})
export class SafeHtml {
    constructor(protected _sanitizer: DomSanitizer) {

	}

	public transform(value: string, type: string): SafeHtml | SafeStyle | SafeScript | SafeUrl | SafeResourceUrl {
		switch (type) {
			case 'html':
				return this._sanitizer.bypassSecurityTrustHtml(value);
			case 'style':
				return this._sanitizer.bypassSecurityTrustStyle(value);
			case 'script':
				return this._sanitizer.bypassSecurityTrustScript(value);
			case 'url':
				return this._sanitizer.bypassSecurityTrustUrl(value);
			case 'resourceUrl':
				return this._sanitizer.bypassSecurityTrustResourceUrl(value);
			default:
				throw new Error(`Unable to bypass security for invalid type: ${type}`);
		}
	}
  
}
";

if (file_force_contents($caminhoPipes.'/'.$filePipeSafeHtml,$fileText)){
    $msg['success']['pipe'][] = $filePipeSafeHtml;    
    @chmod($caminho.'pipes',0777);
    @chmod($caminhoPipes.'/'.$filePipeSafeHtml,0777);
}else{
    $msg['success']["pipe"][] = 'ERROR|'.$filePipeSafeHtml;
}