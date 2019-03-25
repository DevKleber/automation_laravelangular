<?php

$inputTs = "
import { Component, OnInit,Input,ContentChild,AfterContentInit } from '@angular/core';
import {NgModel,FormControlName} from '@angular/forms'
@Component({
  selector: 'app-input-container',
  templateUrl: './input.component.html',
  styleUrls: ['./input.component.css']
})
export class InputComponent implements OnInit, AfterContentInit {
  @Input() label: string
  @Input() errorMessage: string
  @Input() showTip : boolean = true
  input:any
  @ContentChild(NgModel) model:NgModel
  @ContentChild(FormControlName) control:FormControlName
  constructor() { }

  ngOnInit() {
  }
  ngAfterContentInit(){
    this.input = this.model || this.control
    if(this.input === undefined){
      throw new Error('Esse componente precisa ser usado com uma diretiva ngModel ou FormControlName')
    }
  }
  hasSuccess(): boolean{
    
    return this.input.valid && (this.input.dirty || this.input.touched)
  }
  hasError():boolean{
    
    return this.input.invalid && (this.input.dirty || this.input.touched)
  }

}
";


if (file_force_contents($caminho.$caminhoMessageTs,$inputTs)){
    $msg['success'][$pastaShared]['input'][] = 'input.component.ts';    
    @chmod($caminho.'shared/input',0777);
    @chmod($caminho.$caminhoMessageTs,0777);
  }else{
    $msg['success'][$pastaShared]['input'][] = 'ERROR|input.component.ts'; 
}