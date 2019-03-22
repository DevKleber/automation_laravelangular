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
    $new = '  providers: [{provide: ErrorHandler,useClass:ApplicationErrorHandler}],';
    // FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
    $encontrarPosicionar = 'providers: [';
    $comparacao = 'ErrorHandler';
    
    
    //percorrendo arquivo
    $i =0;
    foreach ($array_texto as $line_num => $line) {
        $i++;
        
        $explodeComposer = explode($encontrarPosicionar,$line);
        if(count($explodeComposer)>1){
            $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
        }
        //Vericando se a URL nova já existe no arquivo .htaccess
        $explodeComparacao = explode($comparacao,$line);
        if(count($explodeComparacao)>1){
            $declarado = true; 
            break;
        }
    }
    
    if($declarado){
        $msg['warning'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em '.$appModule;
    }else{
        //Pegando regra atual para concatenar com nova regra
        $textoOriginal = $array_texto[$posicaoAddUrl];
        
        $array_texto[$posicaoAddUrl] =$new;
        //Adicionando nova regra no local correto
        if(file_put_contents($appModule,implode("\n",$array_texto))){
            $msg['success'][] = 'Importação do shared modulo '.$appModule.' criado com sucesso';

            //adicionando os imports do error
            $declarado = false;
            $new = "import { ApplicationErrorHandler } from './app.error-handler';
import { ErrorHandler } from '@angular/core';";

            // FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
            $array_texto = file($appModule,FILE_IGNORE_NEW_LINES);
            $encontrarPosicionar = '@NgModule({';
            $comparacao = 'app.error-handler';
            //percorrendo arquivo
            $i =0;
            foreach ($array_texto as $line_num => $line) {
                $i++;
                
                $explodeComposer = explode($encontrarPosicionar,$line);
                if(count($explodeComposer)>1){
                    $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
                }
                //Vericando se a URL nova já existe no arquivo .htaccess
                $explodeComparacao = explode($comparacao,$line);
                if(count($explodeComparacao)>1){
                    $declarado = true; 
                    break;
                }
            }

            if($declarado){
                $msg['warning'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em '.$appModule;
            }else{
                //Pegando regra atual para concatenar com nova regra
                $textoOriginal = $array_texto[$posicaoAddUrl];
                
                $array_texto[$posicaoAddUrl] =$new."\n".$textoOriginal;
                //Adicionando nova regra no local correto
                if(file_put_contents($appModule,implode("\n",$array_texto))){
                    $msg['success'][] = 'Importação do shared modulo '.$appModule .'criado com sucesso';
                }else{
                    $msg['error'][] = 'Não foi possivel adicionar a importação do shared module em '.$appModule ;
                }   
            }
            //adicionando os imports do error


        }else{
            $msg['error'][] = 'Não foi possivel adicionar a importação do shared module em '.$appModule;
        }  
    }
}

