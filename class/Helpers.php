<?php
class Helpers{
    
    public function checkLastChar($string){
        return $letrafinal = substr($string, -1);
    }
    public function removerUltimoCaracter($string){
        return substr_replace($string, '', -1);
    }
    
}