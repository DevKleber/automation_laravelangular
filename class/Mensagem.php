<?php
//class para exibir mesagens
class Mensagem {
    public $error =0;
    public function __construct(array $msg){
                 
        $success = $msg['success'];
        $warning = $msg['warning'];
        $laravel = $msg['laravel'];
        $warninglaravel = $msg['warning-laravel'];

        
        print "
        <a href='?pag=home' title='Ir para tela inicial'>
                <img src='assets/images/home.png' width='60px'>
        </a><br /><br /> ";
        ?>
        <div class="row">
            <div class="col-md-6 ">
                <div class="frontend">
                    <h3 class="text-center">Front-End</h3>
                    <?php $this->setImage($success); ?>
                    
                    <h3>Alertas</h3>

                    <?php $this->setImage($warning); ?>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="backend">
                    <h3 class="text-center">Back-End</h3>
                    <?php $this->setImage($laravel); ?>
                </div>
            </div>
        </div>
        <?php
        
        die;
        
    }
    private function getStatus($name){
        $status = explode("|",$name);
        if($status[0] == 'ERROR'){
            return ['status'=>'false','name'=>$status[1]];
        }
        return ['status'=>'true','name'=>$name];
    }
    private function setImage($success){
        foreach ($success as $key => $value) {
            $folder = explode(".",$key);
            $file = explode(".",$value);
            $filetipo = $file[1];
            $fileExtensao = $file[2];
            print "<img src='assets/images/icons/".$this->getImage($key)."' class='w-25px mr-15'>$key<br />";
            foreach ($value as $keySub => $sub) {
                $status = $this->getStatus($sub);
                $file = explode(".",$status['name']);
                $tamaho = count($file);
                $img = str_replace(" ","",$file[$tamaho-1]);
                if(gettype($sub)!='array'){
                    print "<div class='imgNivel2 ".$status['status']."'> 
                                <img class='w-25px m-all-15 ' src='assets/images/icons/".$img.".svg'>
                                ".$status['name']."
                           </div>";
                }else{
                    print "<img src='assets/images/icons/".$this->getImage($keySub)."' class='w-25px m-all-15 imgNivel4'>$keySub<br />";
                    foreach ($sub as $key => $subsub) {
                        $status = $this->getStatus($subsub);
                        $file = explode(".",$status['name']);
                        $tamaho = count($file);
                        $img = str_replace(" ","",$file[$tamaho-1]);
                        if(gettype($subsub)!='array'){
                            print "<div class='imgNivel6 ".$status['status']."'> <img src='assets/images/icons/".$img.".svg' class='w-25px m-all-15'>".$status['name']."</div>";
                        }else{
                            print "<img src='assets/images/icons/".$this->getImage($key)."' class='w-25px m-all-15 imgNivel8'>$key<br />";
                            foreach ($subsub as $keysubsub => $subsubsub) {
                                $status = $this->getStatus($subsubsub);
                                $file = explode(".",$status['name']);
                                $tamaho = count($file);
                                $img = str_replace(" ","",$file[$tamaho-1]);
                                print "<div class='imgNivel10 ".$status['status']."'> <img src='assets/images/icons/".$img.".svg' class='w-25px m-all-15'>".$status['name']."</div>";
                            }

                        }
                        # code...
                    }

                }
            }
            print '<hr>';
        }
    }
    private function getImage($name){
        $img = '';
        if($name == 'app'){
            $img = "folder-app-open.svg";
        }else{
            if (!file_exists("assets/images/icons/folder-$name.svg")) {
                $img = "folder-open.svg";
            }else{
                $img = "folder-$name-open.svg";
            }
        }
        return $img;        
    }
}