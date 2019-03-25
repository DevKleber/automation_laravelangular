<?php 
$fileEnv []= $caminhoRaizFrontEnd."/environments/environment.prod.ts";
$fileEnv []= $caminhoRaizFrontEnd."/environments/environment.ts";
foreach ($fileEnv as $key => $value) {
    $declarado = false;
    $new = '  ,api: "http://127.0.0.1:8000/api"';
    // FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
    $array_texto = file($value,FILE_IGNORE_NEW_LINES);
    $encontrarPosicionar = '};';
    $comparacao = 'api:';
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
    $ex = explode("/",$value);
    $file = array_pop($ex);
    if($declarado){
        $msg['warning']['app'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em '.$file .' .info ';
    }else{
        //Pegando regra atual para concatenar com nova regra
        $textoOriginal = $array_texto[$posicaoAddUrl];
        
        $array_texto[$posicaoAddUrl] =$new."\n".$textoOriginal;
        //Adicionando nova regra no local correto
        if(file_force_contents($value,implode("\n",$array_texto))){
            
            $msg['success']['app'][] = $file;
        }else{
            $msg['success']['app'][] = $file;
        }  
    }
}