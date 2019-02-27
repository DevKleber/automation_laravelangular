<?php
//class para exibir mesagens
class Mensagem {
    public $error =0;
    public function __construct(array $msg){
        print " <br /><a href='?pag=home'><button class='btn border'  data-toggle='tooltip' data-placement='top' title='Ir para tela inicial'><img src='assets/images/home.svg' width='60px'></button></a><br /> ";
        if(isset($msg['error'])){
            foreach ($msg['error'] as $key => $value) {
                $this->error++;
                print '<img src="assets/images/warning.svg" class="w-25px m-all-15">'.$value.'<br />';
            }
        }
        if(isset($msg['warning'])){
            foreach ($msg['warning'] as $key => $value) {
                print '<img src="assets/images/warning.svg" class="w-25px m-all-15">'.$value.'<br />';
            }
        }
        if(isset($msg['success'])){
            foreach ($msg['success'] as $key => $value) {
                print '<img src="assets/images/checked.svg" class="w-25px m-all-15">'.$value.'<br />';
            }
        }
        if($this->error++ >0){
            print "<h1>Pode ser que não temos permissão de escrita no seu sistema, atere as permissões para podermos criar os arquivos. </h1>";
        }
    }
}