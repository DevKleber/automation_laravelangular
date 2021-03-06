<?php
$colunasHtml = $colunas;
unset($colunasHtml['id']);
$fillable = "'".implode("','",$colunasHtml)."'";

$c = ucfirst($nameComponent);
$option = '';
$td = '';

// $nameGetServices =$nameComponentTrocarUnderlinePorPrimieraMaiuscula;
// if($helpers->checkLastChar($nameComponentTrocarUnderlinePorPrimieraMaiuscula) != 's'){
//     $nameGetServices =$nameComponentTrocarUnderlinePorPrimieraMaiuscula.'s';
// }
$nameToLateNgFor = $helpers->removerUltimoCaracter($nameGetServices);
foreach ($colunasHtml as $key => $value) {
    $option.='<li role="menuitem">
                                            <label> <input type="checkbox" data-field="id_'.$value.'" value="'.$value.'" checked="checked"> '.$value.' </label>
                                        </li>
										';
	
    $montarTr.='<th *ngIf="columns?.'.$value.'.show"><span class="cursor-pointer" (click)="orderby(\'id\')">'.$value.'<i [className]="order?.id | helpers:\'iconorder\'"></i> </span></th>
								';
	$format = '';
	if($value == 'bo_ativo'){
		$format = " | BooleanMessage:'bo_ativo_withbg'";
		$td.=" <td *ngIf=\"columns?.tp_risco.show\" [innerHtml]=\"".lcfirst($nameToLateNgFor)."?.".$value.$format."\"></td>
								";
	}else{
		$td.=" <td *ngIf=\"columns?.".$value.".show\">{{".lcfirst($nameToLateNgFor)."?.".$value.$format."}}</td>
								";
	}
}


$html = '
<div class="row">
	<div class="col-xs-12">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">'.$nameComponent.'</h3>
			</div>

			<!--Data Table-->
			<!--===================================================-->
			<div class="panel-body">
				<div class="pad-btm form-inline">
					<div class="row">
						<div class="col-sm-6 table-toolbar-left">
							<a [routerLink]="[\'/'.$namerotaangular.'/incluir\']"> <button class="btn btn-purple"><i class="pli-add icon-fw"></i>Add</button></a>
							<button class="btn btn-default print"><i class="pli-printer icon-lg"></i></button>
							<div class="btn-group">
								<button class="btn btn-default" data-target="#sm-modal_'.$namerotaangular.'" data-toggle="modal"><i class="pli-information icon-lg"></i></button>
								<button class="btn btn-default"><i class="pli-trash icon-lg"></i></button>
							</div>
						</div>
						<div class="col-sm-6 table-toolbar-right">
							<div class="form-group">
								<input type="text" autocomplete="off" class="form-control" placeholder="Search" id="input-search2">
							</div>
							<div class="btn-group">
								<button class="btn btn-default"><i class="pli-download-from-cloud icon-lg"></i></button>
								<div class="btn-group dropdown">
									<button class="btn btn-default btn-active-primary dropdown-toggle" data-toggle="dropdown">
										<i class="pli-check"></i>
									</button>

									<ul class="keep-open dropdown-menu dropdown-menu-right" role="menu">
										<li class="open cursor-pointer" role="menuitem" *ngFor="let column of columns  | keyvalue" (click)="hideshowColumns(column.key)"> 
											<ng-container *ngIf="column.value.show; else elseTemplate"> <i class="far fa-check-square"></i> </ng-container>
											<ng-template #elseTemplate> <i class="far fa-square"></i> </ng-template>
											{{column.value.name}}
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								'.$montarTr.'
							</tr>
						</thead>
						<tbody>
							<tr *ngFor="let '.lcfirst($nameToLateNgFor).' of '.lcfirst($nameGetServices).'">
								'.$td.'
                                
                                <td>
                                    <i class="iconsListOptions pli-magnifi-glass" routerLink="/'.$namerotaangular.'/detalhar/{{'.lcfirst($nameToLateNgFor).'?.'.$pk.'}}"></i>
                                    <i class="iconsListOptions pli-pencil" routerLink="/'.$namerotaangular.'/alterar/{{'.lcfirst($nameToLateNgFor).'?.'.$pk.'}}"></i>
                                    <i class="iconsListOptions pli-trash" (click)="inativar('.lcfirst($nameToLateNgFor).')"></i>
								</td>

							</tr>

						</tbody>
					</table>
				</div>


				<hr class="new-section-xs">
				<div class="pull-right">
					<ul class="pagination text-nowrap mar-no">
						<li class="page-pre disabled">
							<a href="">&lt;</a>
						</li>
						<li class="page-number active">
							<span>1</span>
						</li>
						<li class="page-number">
							<a href="">2</a>
						</li>
						<li class="page-number">
							<a href="">3</a>
						</li>
						<li>
							<span>...</span>
						</li>
						<li class="page-number">
							<a href="">9</a>
						</li>
						<li class="page-next">
							<a href="">&gt;</a>
						</li>
					</ul>
				</div>
			</div>
			<!--===================================================-->
			<!--End Data Table-->

		</div>
	</div>
</div>


<!--============== Small Bootstrap Modal =====================================-->
<div id="sm-modal_'.$namerotaangular.'" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
				<h4 class="modal-title" id="mySmallModalLabel">Trocar Texto</h4>
			</div>
			<div class="modal-body">
				<p>Crie apelidos para frases. Quando você digitar o apelido faremos todo trabalho pesado <i class="iconesExemplos pli-happy"></i></p>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--End Small Bootstrap Modal-->

';


//caminho onde vai ser criado o arquivo
$caminhoHtml = $caminhoComponent.'/'.$nameComponent.'.component.html';
if (file_force_contents($caminhoHtml,$html)){
    $msg['success'][$pastaComponentView][] = $nameComponent.'.component.html';    
    @chmod($caminhoComponent,0777);
    @chmod($caminhoHtml,0777);
}else{
    $msg['success'][$pastaComponentView][] = 'ERROR|'.$nameComponent.'.component.html';    
}