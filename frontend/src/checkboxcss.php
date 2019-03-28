<?php
$fileText = '
.onoffswitch {
    position: relative; width: 70px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    height: 27px; padding: 0; line-height: 27px;
    border: 2px solid #E3E3E3; border-radius: 27px;
    background-color: #FFFFFF;
    transition: background-color 0.3s ease-in;
}
.onoffswitch-label:before {
    content: "";
    display: block; width: 27px; margin: 0px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 41px;
    border: 2px solid #E3E3E3; border-radius: 27px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label {
    background-color: #49E845;
}
.onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
   border-color: #49E845;
}
.onoffswitch-checkbox:checked + .onoffswitch-label:before {
    right: 0px; 
}
.img_grid{
    width:35px;
    border-radius: 5px;
}

';

if (file_force_contents($caminhoAssetsCss.$arquivoCheckbox,$fileText)){
    $msg['success']['assets']['css'][] = $arquivoCheckbox;    
    @chmod($caminho.'pipes',0777);
    @chmod($caminhoAssetsCss.$arquivoCheckbox,0777);
    $camihoAngularJson = "$caminhoRaizFrontEnd/../angular.json";
    $new = '              "src/assets/css/checkbox.css",';
    $retImport = verificarSeRegraExiste($new,'src/styles.css',"checkbox.css",$camihoAngularJson,1,true);
}else{
    $msg['success']['assets']['css'][] = 'ERROR|'.$arquivoCheckbox;
}