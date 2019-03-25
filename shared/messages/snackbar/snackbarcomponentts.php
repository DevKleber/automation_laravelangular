<?php

$notificationTs = " 
import { Component, OnInit } from '@angular/core';
import { trigger, state, style, transition, animate,keyframes } from '@angular/animations'
import { NotificationService } from '../notification.service'
import { Observable ,  timer } from 'rxjs'
import {tap,switchMap} from 'rxjs/operators'
import { Message } from '@angular/compiler/src/i18n/i18n_ast';

@Component({
  selector: 'app-snackbar',
  templateUrl: './snackbar.component.html',
  styleUrls: ['./snackbar.component.css'],
  animations: [
    trigger('snack-visibility', [
      state('hidden', style({
        opacity: 0,
        top: 0
      })),
      state('visible', style({
        opacity: 1,
        top: '0px'
      })),
      transition('hidden=>visible', animate('500ms 0s ease-in',keyframes([
        style({opacity:0,transform:'translateX(130px)',offset:0}),
        style({opacity:8,transform:'translateX(10px)',offset:0.8}),
        style({opacity:1,transform:'translateX(0px)',offset:1}),
      ]))),
      transition('visible=>hidden', animate('500ms 0s ease-out', keyframes([
        style({opacity:1,transform:'translateX(0px)',offset:0}),
        style({opacity:8,transform:'translateX(10px)',offset:0.2}),
        style({opacity:0,transform:'translateX(130px)',offset:1}),
      ])))
    ])
  ]
})
export class SnackbarComponent implements OnInit {
  message: string = 'Desculpe aparecer sem ser convidado'
  snackVisibility: string = 'hidden'
  constructor(private notificationService: NotificationService) { }

  ngOnInit() {
    this.notificationService.notifier
      .pipe(
        tap(message => {
          this.message = message
          this.snackVisibility = 'visible'
        }),
        switchMap(message => timer(4000))
      ).subscribe(timer => this.snackVisibility = 'hidden')
  }

}

";


if (file_force_contents($caminho.$caminhoSharedModuleNotificationTs,$notificationTs)){
    $msg['success'][$pastaShared]['messages']['snackbar'][] = 'snackbar.component.html';    
    @chmod($caminho.'shared',0777);
    @chmod($caminho.$caminhoSharedModuleNotificationTs,0777);
  }else{
    $msg['success'][$pastaShared]['messages']['snackbar'][] = 'ERROR|snackbar.component.html';    
}