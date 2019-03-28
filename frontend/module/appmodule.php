<!-- providers: [{provide: ErrorHandler,useClass:ApplicationErrorHandler}], -->
<?php 
$appModule = $caminho."app.module.ts";

$providersDeclarado = false;
$array_texto = file($appModule,FILE_IGNORE_NEW_LINES);



//verificar se tem providers declarado.
$comparacao = 'providers: [{';
$i =0;
foreach ($array_texto as $line_num => $line) {
    $i++;
    //Vericando se a URL nova já existe no arquivo .htaccess
    $explodeComparacao = explode($comparacao,$line);
    if(count($explodeComparacao)>1){
        $providersDeclarado = true; 
        break;
    }
}
// fim verificar quantos providers declarado.

if(!$providersDeclarado){

    $declarado = false;
    $new = '  //providers: [{provide: ErrorHandler,useClass:ApplicationErrorHandler}],';
    $encontrarPosicionar = 'providers: [';
    $comparacao = 'ErrorHandler';    
    $i =0;
    foreach ($array_texto as $line_num => $line) {
        $i++;
        
        $explodeComposer = explode($encontrarPosicionar,$line);
        if(count($explodeComposer)>1){
            $posicaoAddUrl = $line_num;
        }
        $explodeComparacao = explode($comparacao,$line);
        if(count($explodeComparacao)>1){
            $declarado = true; 
            break;
        }
    }
    
    if($declarado){
        $msg['warning'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em app.module.ts .info ';
    }else{
        $textoOriginal = $array_texto[$posicaoAddUrl];
        
        $array_texto[$posicaoAddUrl] =$new;
        if(file_force_contents($appModule,implode("\n",$array_texto))){
            $msg['success']['app'][] = 'app.module.ts';
            $declarado = false;
            $new = "//import { ApplicationErrorHandler } from './app.error-handler';
import { ErrorHandler } from '@angular/core';";
            $array_texto = file($appModule,FILE_IGNORE_NEW_LINES);
            $encontrarPosicionar = '@NgModule({';
            $comparacao = 'app.error-handler';
            //percorrendo arquivo
            $i =0;
            foreach ($array_texto as $line_num => $line) {
                $i++;
                
                $explodeComposer = explode($encontrarPosicionar,$line);
                if(count($explodeComposer)>1){
                    $posicaoAddUrl = $line_num;
                }
                $explodeComparacao = explode($comparacao,$line);
                if(count($explodeComparacao)>1){
                    $declarado = true; 
                    break;
                }
            }

            if($declarado){
                $msg['warning'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em app.module.ts .info ';
            }else{
                $textoOriginal = $array_texto[$posicaoAddUrl];
                
                $array_texto[$posicaoAddUrl] =$new."\n".$textoOriginal;
                if(file_force_contents($appModule,implode("\n",$array_texto))){
                    $msg['success']['app'][] = 'app.module.ts';
                }else{
                    $msg['success']['app'][] = 'ERROR|app.module.ts';
                }   
            }
        }else{
            $msg['success']['app'][] = 'ERROR|app.module.ts';
        }
    }
}

$new = "import { HttpClientModule } from '@angular/common/http';";
$http = verificarSeRegraExiste($new,'@NgModule({',"HttpClientModule",$appModule);
if($http!='alert'){
    $new = '    HttpClientModule,';
    $http = verificarSeRegraExiste($new,'imports',"**forcandoabarra**",$appModule,2);
}