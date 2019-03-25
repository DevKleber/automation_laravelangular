<?php

$inputs = '';
foreach ($colunas as $key => $value) {
	if($value!=$pk){
		$det.=" 
					<dt>".$key."</dt>
					<dd>{{".lcfirst($nomeComponent)."?.".$key."}}</dd>
		";
	}
}
$html = "
<div class='row'>
	<div class='col-md-12'>
		<!-- general form elements -->
		<div class='box box-primary'>
			<div class='box-header with-border'>
				<h3 class='box-title'>".ucfirst($nameComponent)."</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<div class='bs-example' data-example-id='horizontal-dl'>
				<dl class='dl-horizontal'>
					".$det."
				</dl>
			</div>
			<div *ngIf='loader' class='loader'></div>
		</div>
	</div>
</div>
";



//caminho onde vai ser criado o arquivo
$caminhoInsertHtml = $caminhoComponent.'/detalhar/detalhar.component.html';
if (file_force_contents($caminhoInsertHtml,$html)){
    $msg['success'][] = 'Arquivo '.$caminhoInsertHtml.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoInsertHtml,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoInsertHtml;
}