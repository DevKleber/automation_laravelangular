<?php
$colunasController = $colunas;
// unset($colunasModel['id']);
$nameModel = "\App\\".ucfirst($nameComponent);
$nameController = ucfirst($nameComponent).'Controller';
$nameControllerPhp = ucfirst($nameComponent).'Controller.php';
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
    $useToken = 'use Tymon\JWTAuth\JWTAuth;';
    $construct = 'private $jwtAuth;
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }';
}

$where = '::all()';
$updateByToken = '';


$store = '';
if(!empty($filtrarPorToken)){
    if(in_array($nameidtoken, $fk)) { 
        $requestToken = '$request[\''.$nameidtoken.'\'] = $this->token[\''.$nameidtoken.'\'];';
        $where = '::where(\''.$nameidtoken.'\', $this->token[\''.$nameidtoken.'\'])->get().';
        $updateByToken = 'if($'.$nameComponent.'[\''.$nameidtoken.'\'] != $this->token[\''.$nameidtoken.'\']){
            return response([\'error\'=>"Não tem permissão para alterar esse '.$nameComponent.'"],400);
        }';
    }else if(count($fk)==1){
        $requestToken = '$request[\''.$fk[0].'\'] = $this->token[\''.$nameidtoken.'\'];';
        $where = '::where(\''.$fk[0].'\', $this->token[\''.$nameidtoken.'\'])->get().';
        $updateByToken = 'if($'.$nameComponent.'[\''.$fk[0].'\'] != $this->token[\''.$nameidtoken.'\']){
            return response([\'error\'=>"Não tem permissão para alterar esse '.$nameComponent.'"],400);
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
        }
        $requestToken = '$request[\''.$campo.'\'] = $this->token[\''.$nameidtoken.'\'];';
        $where = '::where(\''.$nameidtoken.'\', $this->token[\''.$nameidtoken.'\'])->get().';
        $updateByToken = 'if($'.$nameComponent.'[\''.$campo.'\'] != $this->token[\''.$nameidtoken.'\']){
            return response([\'error\'=>"Não tem permissão para alterar esse '.$nameComponent.'"],400);
        }';
    }
}
if($uparImage){
    $store = '
    if ($request->hasFile(\'fileimg\')) {
        if($img = Helpers::salveFile($request,\''.$nameComponent.'\')){
            return response(["response"=>"imagem movida com sucesso",\'file\'=>$img[\'file\']]);
        }
        }else{
            '.$requestToken.'
            $request[\'img\'] = $request[\'fileimg\'];
            '.$bo_ativo.'
            $'.$nameComponent.' = '.$nameModel.'::create($request->all());
            if(!$'.$nameComponent.'){
                return  response(["response"=>"Erro ao salvar '.$nameComponent.'"],400); 
            }
            return response(["response"=>"Salvo com sucesso",\'dados\'=>$'.$nameComponent.']);
        }
        return response(["response"=>"Error",\'dados\'=>$'.$nameComponent.']);
    ';
}else{
    $store = $bo_ativo.'
        '.$requestToken.'
        $'.$nameComponent.' = '.$nameModel.'::create($request->all());
        if(!$'.$nameComponent.'){
            return  response(["response"=>"Erro ao salvar '.$nameComponent.'"],400); 
        }
        return response(["response"=>"Salvo com sucesso",\'dados\'=>$'.$nameComponent.']);';
    
}
$controller = '<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers;
'.$useToken.'

class '.$nameController.' extends Controller
{
    '.$construct.'
    
    public function index()
    {
        $'.$nameComponent.' = '.$nameModel.$where.'
        if(!$'.$nameComponent.'){
            return response(["response"=>"Não existe '.$nameComponent.'"],400);
        }
        return response(["dados"=>$'.$nameComponent.']);
    }

    
    public function store(Request $request)
    {
        
        '.$store.'
        
    }

    
    public function show($id)
    {
        $'.$nameComponent.' ='.$nameModel.'::find($id);
        if(!$'.$nameComponent.'){
            return response(["response"=>"Não existe '.$nameComponent.'"],400);
        }
        return response($'.$nameComponent.');
    }

    
    public function update(Request $request, $id)
    {
        $'.$nameComponent.' =  '.$nameModel.'::find($id);
        '.$updateByToken.'
        if(!$'.$nameComponent.'){
            return response([\'response\'=>\''.$nameComponent.' Não encontrado\'],400);
        }
        $'.$nameComponent.' = Helpers::processarColunasUpdate($'.$nameComponent.',$request->all());
        
        if(!$'.$nameComponent.'->update()){
            return response([\'response\'=>\'Erro ao alterar\'],400);
        }
        return response([\'response\'=>\'Atualizado com sucesso\']);
      
    }
    

    public function destroy($id)
    {
        $'.$nameComponent.' =  '.$nameModel.'::find($id);
        '.$updateByToken.'
        if(!$'.$nameComponent.'){
            return response([\'response\'=>\''.$nameComponent.' Não encontrado\'],400);
        }
        $'.$nameComponent.'->bo_ativo = false;
        if(!$'.$nameComponent.'->save()){
            return response(["response"=>"Erro ao deletar '.$nameComponent.'"],400);
        }
        return response([\'response\'=>\''.$nameComponent.' Inativado com sucesso\']);
    }
}';
//Criando arquivo
if (file_force_contents($caminhoControllerNamePhp,$controller)) {
    $msg['success'][] = $caminhoControllerNamePhp;    
    @chmod($caminhoControllerNamePhp,0777);
} else {
    $msg['error'][] = $caminhoControllerNamePhp;
}
