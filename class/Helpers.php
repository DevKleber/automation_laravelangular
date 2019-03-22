<?php
class Helpers{
    
    public function checkLastChar($string){
        return $letrafinal = substr($string, -1);
    }
    public function removerUltimoCaracter($string){
        return substr_replace($string, '', -1);
    }
    public function nomeComponent($name){
        $name = explode("-",$name);
        foreach ($name as $key => $value) {
            $nome .= ucfirst($value);
        }
        $name = explode("_",$nome);
        if(count($name)>1){
            foreach ($name as $key => $value) {
                $nome .= ucfirst($value);
            }
        }
        return $nome;
    }
    
}