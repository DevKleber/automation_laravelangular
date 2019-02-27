<?php 
spl_autoload_register(function ($class_name) {
    include 'class/'.$class_name . '.php';
});