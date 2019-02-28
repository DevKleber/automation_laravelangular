<?php
$addmenu = "    ,array(
        'icon'  => 'icon-cog',
        'link'  => 'index.php?mod=$nameComponent',
        'label' => '".ucfirst($nameComponent)."'
    )";
$file = "menu.php";//Nome da arquivo
$menu_existente = false;//condição de criacão
$caminhoMenu = $caminho."admin/includes/views/";//Caminho do arquivo $file

//Essa função lista todas as linhas do arquivo $file e coloca em um array
$array_texto = file($caminhoMenu.$file,FILE_IGNORE_NEW_LINES);
$array_comparacao = ");";//Base de localização dentro do arquivo $file
$array_mod = "'link'=>'index.php?mod=$nameComponent',";//Array de comparação de existência

//Lista todas as linhas do arquivo $file
foreach ($array_texto as $line_num => $line) {
    //retira os espaços entre as estrings para poder fazer uma comparação dinâmica
    $lineSemEspaco = str_replace(" ", "",$line);
    if ($lineSemEspaco == $array_mod) {
        $msg['warning'][] = 'Não foi possivel criar o menu, pois o mesmo já existe em: '.$caminhoMenu .'<b>'. $file.'</b>';
        $menu_existente = true;
        break;
    //Encontra o ultimo conjunto de caracter do array de menu    
    }else if($lineSemEspaco == $array_comparacao){
        $posicaoAddMenu = $line_num;
        break;
    }   
}
// Se não existir um menu com o link iqual dentro do arquivo $file ele cria uma nova opção
if(!$menu_existente){
    $textoOriginal = $array_texto[$posicaoAddMenu];
    //Montando novamente o arquivo $file com a nova opção
    $array_texto[$posicaoAddMenu] =$addmenu."\n".$textoOriginal;
 
    //Criando e sobrescrevendo o arquivo antigo
    if(file_put_contents($caminhoMenu.$file,implode("\n",$array_texto))){
        $msg['success'][] = 'Menu adicionada em '.$caminhoMenu .'<b>'. $file.' </b>';
    }else{
        echo "não deu certo";
        $msg['error'][] = 'Não foi possivel adicionar o menu '.$caminhoMenu .'<b>'. $file.'</b>';
    }   
}