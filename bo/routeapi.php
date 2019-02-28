<?php
$nameController = ucfirst($nameComponent).'Controller';

$rota_existente = false;
$rotanew = 'Route::resource(\''.$nomeRotaBE.'\',\''.$nameController.'\');';
$rotaProtegidaPorToken = false;
if(!empty($checkboxRotaFeProtegidaToken)){
    $rotanew = '    Route::resource(\''.$nomeRotaBE.'\',\''.$nameController.'\');';
    $rotaProtegidaPorToken = true;
}

// FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
$array_texto = file($caminhoRouteApi,FILE_IGNORE_NEW_LINES);
$url_comparacao = 'jwt.auth';
//percorrendo arquivo
$i =0;
foreach ($array_texto as $line_num => $line) {
    $i++;
    
    $explodeComposer = explode($url_comparacao,$line);
    if(count($explodeComposer)>1){
        $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
    }
    if($line == $url_comparacao){
        $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
    }
    //Vericando se a URL nova já existe no arquivo .htaccess
    $explodeComposerFile = explode($nomeRotaBE,$line);
    if(count($explodeComposerFile)>1){
        $rota_existente = true; 
    }
}

if($rota_existente){
    $msg['warning'][] = 'Já existe a regra <small><b>('.$rotanew.')</b></small> em '.$caminhoRouteApi;
}else{
    //Pegando regra atual para concatenar com nova regra
    $textoOriginal = $array_texto[$posicaoAddUrl];
    
    $array_texto[$posicaoAddUrl] =$rotanew."\n".$textoOriginal;
    if($rotaProtegidaPorToken){
        $array_texto[$posicaoAddUrl] =$textoOriginal."\n".$rotanew;
    }
    //Adicionando nova regra no local correto
    if(file_put_contents($caminhoRouteApi,implode("\n",$array_texto))){
        $msg['success'][] = 'Url adicionada em '.$caminhoRouteApi .'criado com sucesso';
    }else{
        $msg['error'][] = 'Não foi possivel adicionar a url em '.$caminhoRouteApi ;
    }   
}
