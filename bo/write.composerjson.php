<?php
$checkExisteFiles = 'app/Http/Helpers.php';
$addfiles = '         "files": [
            "app/Http/Helpers.php"
        ],';
$file = ".htaccess";
$rota_existente = false;

// "autoload": {
//     "psr-4": {
//         "App\\": "app/"
//     },
//     "classmap": [
//         "database/seeds",
//         "database/factories"
//     ],
//     "files": [
//         "app/Http/Helpers.php"
//     ]
// },

// FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
$array_texto = file($caminhoComposer,FILE_IGNORE_NEW_LINES);
$url_comparacao = '"autoload": {';
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
    $explodeComposerFile = explode('"files"',$line);
    if(count($explodeComposerFile)>1){
        $rota_existente = true; 
    }
}

if($rota_existente){
    $msg['warning'][] = 'Já existe a regra <small><b>('.$addfiles.')</b></small> em '.$caminhoComposer;
}else{
    //Pegando regra atual para concatenar com nova regra
    $textoOriginal = $array_texto[$posicaoAddUrl];
    
    //Adicionando nova regra no local correto
    $array_texto[$posicaoAddUrl] =$textoOriginal."\n".$addfiles;
    if(file_put_contents($caminhoComposer,implode("\n",$array_texto))){
        $msg['success'][] = 'Url adicionada em '.$caminhoComposer .'criado com sucesso';
    }else{
        $msg['error'][] = 'Não foi possivel adicionar a url em '.$caminhoComposer ;
    }   
}
