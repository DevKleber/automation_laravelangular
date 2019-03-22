<?php
$module = "import {environment} from \"../environments/environment\"
export const API = environment.api
export const APIWithoutApi = API.split('/api')[0]; 
export const API_PATH_IMG = APIWithoutApi+'/img'";

//caminho onde vai ser criado o arquivo
$appapi = $caminho.'app.api.ts';
if (file_force_contents($appapi,$module)){
    $msg['success'][] = 'Arquivo '.$appapi.'</b> criado com sucesso';    
    chmod($caminho,0777);
    chmod($appapi,0777);
    require_once("frontend/environments/env.php");
}else{
    $msg['error'][] = 'Erro ao criar '.$appapi;
}

