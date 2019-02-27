<?php
session_start();
class Util{
    public function refresh(){
        header("Refresh:0");
    }
}