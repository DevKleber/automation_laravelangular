<?php

$declarado = false;
$new = "import { SharedModule } from './shared/shared.module';";

// FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
$array_texto = file($caminho.$caminhoAppModule,FILE_IGNORE_NEW_LINES);
$encontrarPosicionar = '@NgModule({';
$comparacao = 'SharedModule';
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
    $msg['warning']['app'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em app.module.ts .info ';
}else{
    //Pegando regra atual para concatenar com nova regra
    $textoOriginal = $array_texto[$posicaoAddUrl];
    
    $array_texto[$posicaoAddUrl] =$new."\n".$textoOriginal;
    //Adicionando nova regra no local correto
    if(file_force_contents($caminho.$caminhoAppModule,implode("\n",$array_texto))){
        $msg['success']['app'][] = 'app.module.ts';
    }else{
        $msg['success']['app'][] = 'app.module.ts' ;
    }   

    // -------------------------------------------------------------------------
    // fazendo o imports agora 
    
    

    $declarado = false;
    $new = "    SharedModule.forRoot(),";

    // FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
    $array_texto = file($caminho.$caminhoAppModule,FILE_IGNORE_NEW_LINES);
    $encontrarPosicionar = 'imports: [';
    $comparacao = 'SharedModule.forRoot(),';
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
        $msg['warning']['app'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em app.module.ts .info ';
    }else{
        //Pegando regra atual para concatenar com nova regra
        $textoOriginal = $array_texto[$posicaoAddUrl];
        
        $array_texto[$posicaoAddUrl] =$textoOriginal."\n".$new;
        //Adicionando nova regra no local correto
        if(file_force_contents($caminho.$caminhoAppModule,implode("\n",$array_texto))){
            // $msg['success'][] = 'Importação do shared modulo '.$caminho.$caminhoAppModule .'criado com sucesso';
        }else{
            $msg['success']['app'][] = 'ERROR|app.module.ts' ;
        }   


        
    }


    
}
