<?php

$inputs = '';
foreach ($colunas as $key => $value) {
  $buscaImage = explode("img",$value);
  if(count($buscaImage)>1){
	  $inputs .="<div class='form-group is-empty col-md-4'>
	  <input style=\"display: none\" type=\"file\" (change)=\"onFileChanged($event)\" #fileInput
			formControlName='fileimg'>
		<div class=\"uploadArquivo\" [style.background-image]=\"'url(' + img + ' )' | safeHtml: 'style' \"></div>
		<button class=\"btn btn-neutro btn-upload\" (click)=\"fileInput.click()\" style=\"width: 250px\">Imagem ".$value."</button>
  </div>";
	  
  }else{
	$inputs .="<div class='form-group is-empty col-md-4'>
	<label class=\"control-label\" for='".$value."'>".$value."</label>
	<app-input-container errorMessage='Campo obrigatório' label='".$value."'>
		<input class='form-control' formControlName='".$value."' placeholder=''>
	</app-input-container>
</div>";
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
			<form [formGroup]='form' novalidate>
				<div class='box-body'>
					$inputs
				</div>
				<!-- /.box-body -->

				<div class='box-footer col-md-12'>
					<button (click)='save(form.value)' [disabled]='!form.valid' class='btn btn-success'>Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
";


//caminho onde vai ser criado o arquivo
$caminhoInsertHtml = $caminhoComponent.'/incluir/incluir.component.html';
if (file_force_contents($caminhoInsertHtml,$html)){
    $msg['success'][] = 'Arquivo '.$caminhoInsertHtml.'</b> criado com sucesso';    
    chmod($caminhoComponent,0777);
    chmod($caminhoInsertHtml,0777);
}else{
    $msg['error'][] = 'Erro ao criar '.$caminhoInsertHtml;
}