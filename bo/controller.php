<?php
$colunasController = $colunas;
// unset($colunasModel['id']);
$nameModel = "\App\\".ucfirst($nomeComponent);
$nameController = ucfirst($nomeComponent).'Controller';
$nameControllerPhp = ucfirst($nomeComponent).'Controller.php';
$caminhoControllerNamePhp = $caminhoController.$nameControllerPhp;
$uparImage = false;

$fk = [];
// Field:"id_empresa"
// Type:"int(11)"
// Null:"NO"
// Key:"MUL"
// Default:null
// Extra:""
foreach ($infoTable as  $info) {
    if($info->Key=='MUL'){
        $fk[]= $info->Field;
    }
}



$bo_ativo = '';
if (in_array("bo_ativo", $colunasController)) { 
    $bo_ativo = '$request[\'bo_ativo\'] = true;';
}

foreach ($colunasController as $key => $value) {
    $buscaImage = explode("img",$value);
    if(count($buscaImage)>1){
        $uparImage = true;
    }
}
//verificando se terá token
$useToken = '';
$construct = '';
if(!empty($checkboxRotaFeProtegidaToken)){
    $useToken = 'use JWTAuth;';
    $construct = 'private $token;
    public function __construct()
    {
        $this->token = JWTAuth::parseToken()->authenticate();
    }';
}

$where = '::all()';
$updateByToken = '';


$store = '';
if(!empty($filtrarPorToken)){
    if(in_array($nameidtoken, $fk)) { 
        $requestToken = '$request[\''.$nameidtoken.'\'] = $this->token[\''.$nameidtoken.'\'];';
        $where = '::where(\''.$nameidtoken.'\', $this->token[\''.$nameidtoken.'\'])->get()';
        $updateByToken = 'if($'.$nomeComponent.'[\''.$nameidtoken.'\'] != $this->token[\''.$nameidtoken.'\']){
            return response([\'error\'=>"Não tem permissão para alterar esse '.$nomeComponent.'"],400);
        }';
    }else if(count($fk)==1){
        $requestToken = '$request[\''.$fk[0].'\'] = $this->token[\''.$nameidtoken.'\'];';
        $where = '::where(\''.$fk[0].'\', $this->token[\''.$nameidtoken.'\'])->get()';
        $updateByToken = 'if($'.$nomeComponent.'[\''.$fk[0].'\'] != $this->token[\''.$nameidtoken.'\']){
            return response([\'error\'=>"Não tem permissão para alterar esse '.$nomeComponent.'"],400);
        }';
    }else{
        // vamos tentar adivinhar a fk da tabela que guardará o token
        if (in_array("id", $fk)) { 
            $campo = "id";
        }else if (in_array("id_empresa", $fk)) { 
            $campo = "id_empresa";
        }else if (in_array("id_usuario", $fk)) { 
            $campo = "id_usuario";
        }else if (in_array("user", $fk)) { 
            $campo = "user";
        }else{
            $campo = 'id';
        }
        $requestToken = '$request[\''.$campo.'\'] = $this->token[\''.$nameidtoken.'\'];';
        $where = '::where(\''.$nameidtoken.'\', $this->token[\''.$nameidtoken.'\'])->get().';
        $updateByToken = 'if($'.$nomeComponent.'[\''.$campo.'\'] != $this->token[\''.$nameidtoken.'\']){
            return response([\'error\'=>"Não tem permissão para alterar esse '.$nomeComponent.'"],400);
        }';
    }
}
if($uparImage){
    $store = '
    if ($request->hasFile(\'fileimg\')) {
        if($img = Helpers::salveFile($request,\''.lcfirst($nomeComponent).'\')){
            return response(["response"=>"imagem movida com sucesso",\'file\'=>$img[\'file\']]);
        }
        }else{
            '.$requestToken.'
            $request[\'img\'] = $request[\'fileimg\'];
            '.$bo_ativo.'
            $'.$nomeComponent.' = '.$nameModel.'::create($request->all());
            if(!$'.$nomeComponent.'){
                return  response(["response"=>"Erro ao salvar '.$nomeComponent.'"],400); 
            }
            return response(["response"=>"Salvo com sucesso",\'dados\'=>$'.$nomeComponent.']);
        }
        return response(["response"=>"Error",\'dados\'=>$'.$nomeComponent.']);
    ';
}else{
    $store = $bo_ativo.'
        '.$requestToken.'
        $'.$nomeComponent.' = '.$nameModel.'::create($request->all());
        if(!$'.$nomeComponent.'){
            return  response(["response"=>"Erro ao salvar '.$nomeComponent.'"],400); 
        }
        return response(["response"=>"Salvo com sucesso",\'dados\'=>$'.$nomeComponent.']);';
    
}
$controller = '<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers;
'.$useToken.'

class '.$nomeComponent.'Controller extends Controller
{
    '.$construct.'
    
    public function index()
    {
        $'.$nomeComponent.' = '.$nameModel.$where.';
        if(!$'.$nomeComponent.'){
            return response(["response"=>"Não existe '.$nomeComponent.'"],400);
        }
        return response(["dados"=>$'.$nomeComponent.']);
    }

    
    public function store(Request $request)
    {
        
        '.$store.'
        
    }

    
    public function show($id)
    {
        $'.$nomeComponent.' ='.$nameModel.'::find($id);
        if(!$'.$nomeComponent.'){
            return response(["response"=>"Não existe '.$nomeComponent.'"],400);
        }
        return response($'.$nomeComponent.');
    }

    
    public function update(Request $request, $id)
    {
        $'.$nomeComponent.' =  '.$nameModel.'::find($id);
        '.$updateByToken.'
        if(!$'.$nomeComponent.'){
            return response([\'response\'=>\''.$nomeComponent.' Não encontrado\'],400);
        }
        $'.$nomeComponent.' = Helpers::processarColunasUpdate($'.$nomeComponent.',$request->all());
        
        if(!$'.$nomeComponent.'->update()){
            return response([\'response\'=>\'Erro ao alterar\'],400);
        }
        return response([\'response\'=>\'Atualizado com sucesso\']);
      
    }
    

    public function destroy($id)
    {
        $'.$nomeComponent.' =  '.$nameModel.'::find($id);
        '.$updateByToken.'
        if(!$'.$nomeComponent.'){
            return response([\'response\'=>\''.$nomeComponent.' Não encontrado\'],400);
        }
        $'.$nomeComponent.'->bo_ativo = false;
        if(!$'.$nomeComponent.'->save()){
            return response(["response"=>"Erro ao deletar '.$nomeComponent.'"],400);
        }
        return response([\'response\'=>\''.$nomeComponent.' Inativado com sucesso\']);
    }
}';
//Criando arquivo
if (file_force_contents($caminhoControllerNamePhp,$controller)) {
    $msg['laravel']['app']['http']['controllers'][] = $nameControllerPhp;    
    @chmod($caminhoControllerNamePhp,0777);
} else {
    $msg['laravel']['app']['http']['controllers'][] = 'ERROR|'.$nameControllerPhp;
}
