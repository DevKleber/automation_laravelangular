<?php

$cifrao = "$";
$gridmodulo ='';
$gridmodulo2 = '';
$c = ucfirst($nameMod);

$gridmodulo .= "<?php

class ".$c."
{
    var $cifrao"."modName = '$nameMod';

    public function __construct()
    {
        $cifrao"."this->$nameMod = $cifrao"."this->get$c();
        
        if ($cifrao"."_GET['tipo_url']) {
            $cifrao"."this->seo['title'] = $cifrao"."this->tipo['titulo'] . ' - ' . $cifrao"."this->seo['title'];
            $cifrao"."this->$nameMod = $cifrao"."this->detail$c($cifrao"."_GET['tipo_url']);
            
            $cifrao"."this->seo = array(
                'title'    => $cifrao"."this->$nameMod[0]['titulo'] . ' - $c',
                'keywords' => '$nameMod, contacto, entre em contacto, MVP Gás',
                'description' => strip_tags(explode('\\n',$cifrao"."this->$nameMod[0]['conteudo'])[0])
            );
            $cifrao"."this->view = '$nameMod';
        }else{
            $cifrao"."this->seo = array(
                'title'    => '$c',
                'keywords' => '$nameMod, contacto, entre em contacto, MVP Gás'
            );
        }
        
    }";
    $gridmodulo2 .="
    public function detail$c($cifrao"."id){
        
        $cifrao"."sql = $aspasDuplas SELECT * FROM $table where $pk = '$cifrao"."id' $aspasDuplas;
        
        return get_sql($cifrao"."sql, 'array');
    }
   
    public function get$c(){
        $cifrao"."sql = 'SELECT * FROM $table';
        return get_sql($cifrao"."sql, 'array');
    }
}";
//caminho onde vai ser criado o arquivo
$caminhofomodules = $caminho.'includes/modules/';
//Criando arquivo
if(file_put_contents($caminhofomodules . $nameMod.'.mod.php',$gridmodulo. $gridmodulo2)){
    $msg['success'][] = 'Arquivo '.$caminhofomodules .'<b>'. $nameMod.'.mod.php </b>criado com sucesso';
    chmod($caminhofomodules . $nameMod.'.mod.php', 0777);
}else{   
    $msg['error'][] = 'Erro ao criar '.$caminhofomodules .'<b>'. $nameMod.'.mod.php</b>';    
}