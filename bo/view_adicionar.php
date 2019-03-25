<?php
$name =str_replace(" ","_",$nameComponent);
$gridForm = '';
$gridtop ='';
$gridDiv ='';
foreach ($colunas as $key => $c) {
    if ($c !== $pk){
    $gridForm .= '
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">'.$c.'</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo '.$cifrao.$name.'["'.$c.'"]?>" name="'.$c.'" class="form-control"  />
                                    </div>
                                </div>'     ;
    }
}

$d = ucfirst($name);
$c = ucfirst($nameComponent);
$aspasSimples = "'";
$gridtop .= '
'.$cifrao. $name.' = new '.$d.'();
'.$cifrao. $name.' = '.$cifrao. $name.'->load();

if (isset('.$cifrao. $name.'["id"])) {
	$label = "A editar - " . '.$cifrao. $name.'["ds_endereco"];
}else{
	$label = "A adicionar";
}
?>
';
$gridDiv .='<?php '.$gridtop.'

<div class="wrapper extended scrollable" style="opacity:1;">
    <br>
    <div class="panel panel-default panel-block panel-title-block">
        <div class="panel-heading">
            <div class="mod-title">
                <i class="icon-file-text-alt"></i>
                    <h1>
                        '.$c.' - <?php echo $label; ?>
                    </h1>
            </div>
        </div>
    </div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default panel-block panel-title-block">
                <div class="panel-heading">	
                    <form action="index.php?mod='.$name.'&view=insert_to_db" method="post" class="form-horizontal" enctype="multipart/form-data">	

                        <?php if (isset('.$cifrao.$name.'["'.$pk.'"])): ?>       
                            <input type="hidden" name="'.$pk.'" value="<?php echo '.$cifrao. $name.'["'.$pk.'"] ?>" />
                        <?php endif ?>

                        <ul class="nav nav-tabs panel panel-default panel-block">
						    <li class="active"><a href="#pagina" data-toggle="tab">'.$c.'</a></li>
					    </ul>

                        <div class="tab-content panel panel-default panel-block">
                    
                            <!-- pt -->
                            <div class="tab-pane list-group active" id="pagina">

                                <div class="list-group-item">
                                    <!-- en -->
                                            '.$gridForm.'

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Idioma</label>
                                        <div class="col-sm-10 checkbox">
                                            <label> <input type="radio" <?php echo ( !'.$cifrao.$name.'["lang"] || '.$cifrao.$name.'["lang"] == "pt" )?'.$aspasSimples.' checked="checked"'.$aspasSimples.':""; ?> name="lang" value="pt" /> PT </label>
                                            <label> <input type="radio" <?php echo ( '.$cifrao.$name.'["lang"] == "en" )?'.$aspasSimples.' checked="checked"'.$aspasSimples.':""; ?> name="lang" value="en" /> EN </label>
                                        </div>
                                    </div>
                                </div>

					    	</div>
				        </div>
			            <div class="clearfix"></div>
					    <div class="form-actions">
                            <button class="btn btn-success" name="stay" value="1">Editar</button>
					    </div>
                    </form>
    		    </div>	<!-- panel heading -->
	        </div> <!-- panel-title-block -->
        </div> <!-- col-lg-span -->
    </div> <!-- row -->
</div> <!-- Wrapper -->
';
//caminho onde vai ser criado o arquivo
$caminhoboAdicionar = $caminho.'admin/includes/views/'.$nameComponent.'/';
//Criando arquivo
if(file_force_contents($caminhoboAdicionar . 'adicionar.php', $gridDiv)){
    $msg['success'][] = $caminhoboAdicionar;
    @chmod($caminhoboAdicionar.'adicionar.php',0777);
} else {
    $msg['error'][] = $caminhoboAdicionar;
}
