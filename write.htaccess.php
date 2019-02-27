<?php
$htaccess = $htaccess;//Configuração informada na HOME
$file = ".htaccess";
$rota_existente = false;

// FILE_IGNORE_NEW_LINES Não acrescentar a quebra de linha no final de cada elemento do array
$array_texto = file($caminho.$file,FILE_IGNORE_NEW_LINES);
$url_comparacao = "RewriteCond %{REQUEST_FILENAME} !-f";
//percorrendo arquivo
foreach ($array_texto as $line_num => $line) {

    if($line == $url_comparacao){
        $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
    }
    //Vericando se a URL nova já existe no arquivo .htaccess
    if($line == $htaccess){
        $rota_existente = true; 
    }
}

if($rota_existente){
    $msg['warning'][] = 'Já existe a regra <small><b>('.$htaccess.')</b></small> em '.$caminho .'<b>'. $file.' </b>';
}else{
    //Pegando regra atual para concatenar com nova regra
    $textoOriginal = $array_texto[$posicaoAddUrl];
    
    //Adicionando nova regra no local correto
    $array_texto[$posicaoAddUrl] =$htaccess."\n".$textoOriginal;
    if(file_put_contents($caminho.$file,implode("\n",$array_texto))){
        $msg['success'][] = 'Url adicionada em '.$caminho .'<b>'. $file.' </b>criado com sucesso';
    }else{
        $msg['error'][] = 'Não foi possivel adicionar a url em '.$caminho .'<b>'. $file.'</b>';
    }   
}
