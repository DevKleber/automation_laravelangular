<?php
$helpers = '';
$c = ucfirst($nameComponent);
$helpers .=' 
<?php
class Helpers{
    public static function convertdateBr2DB($date){
        if(empty($date)){
            return null;
        }
        $arDate = explode("/",$date);
        if(count($arDate)<=1){
            return $date;
        }
        return date("$arDate[2]-$arDate[1]-$arDate[0]");
        return date(\'Y-m-d\', strtotime(str_replace(\'-\', \'/\', $date)));
        
    }
    
    public static function convertdateBr2DBTs($date){
        return date(\'Y-m-d H:i:s\', strtotime(str_replace(\'-\', \'/\', $date)));
    }
    public static function removerVazio($controler,$request){
        foreach ($request as $key => $value) {
            if(!empty($value)){
                $tipo = substr($key, 0, 2); 
                $controler->$key = $value;
                if($tipo == \'dt\'){
                    $controler->$key = Helpers::convertdateBr2DB($value);
                }
            }
        }
        return $controler;
    }
    public static function processar($controler,$request){
        foreach ($request as $key => $value) {
            $tipo = substr($key, 0, 2); 
            $controler->$key = (!empty($value))?$value:null;
            if($tipo == \'dt\'){
                $controler->$key = Helpers::convertdateBr2DB($value);
            }
        }
        return $controler;
    }
    public static function processarColunas($colunas,$request){
        $ar =[];
        foreach ($request as $key => $value) {
            if(in_array($key,$colunas)){
                $tipo = substr($key, 0, 2); 
                $ar[$key] = (!empty($value))?$value:null;
                if($tipo == \'dt\'){
                    $ar[$key] = Helpers::convertdateBr2DB($value);
                }
            }
        }
        return $ar;
    }
    public static function processarColunasUpdate($colunas,$request){
        $columns = $colunas->getFillable();
        
        foreach ($request as $key => $value) {
            if(in_array($key,$columns)){
                $colunas->$key = $value;
            }else{
                if($key === "fileimg" && !is_null($value)){
                    $colunas->img = $value; 
                }
            }
        }
        return $colunas;
    }
    public static function salveFile($request,$folder){
        if ($request->hasFile(\'fileimg\')) {
            $doc = $request->file(\'fileimg\');

                //Recupera o nome original do arquivo
                $filename  = $doc->getClientOriginalName();

                //Recupera a extensão do arquivo
                $extension = $doc->getClientOriginalExtension();

                //Definindo um nome unico para o arquivo
                $name  = date(\'His_Ymd\').\'_\'.str_replace(\' \',\'\',$filename);

                //Diretório onde será salvo os arquivos
                $destinationPath = \'img/\'.$folder;
                //Move o arquivo para a pasta indicada
                if($doc->move($destinationPath, $name)){
                    return [\'file\'=>$name];
                    
                }
        }
        return false;
        
    }
}
';

//Criando arquivo
if(file_force_contents($caminhoHelpers,$helpers)){
    @chmod($caminhoHelpers,0777);
    $msg['laravel']['app']['http'][] = 'Helpers.php';
} else {
    $msg['laravel']['app']['http'][] = 'ERROR|Helpers.php' ;
}

