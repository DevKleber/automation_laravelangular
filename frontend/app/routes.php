<?php
$pathRoutes = $caminho.'app.routes.ts';
$codigos = '';
if (!file_exists($pathRoutes)) {
    $codigos = montarFileRoute($namerotaangular,$nameGetServices,$checkboxRotaApiProtegidaToken,$inserir,$alterar,$detalhar);
}else{
    // $new,$encontrarPosicionar,$comparacao,$arquivo,$posicaosalvar=1
    verificarSeRegraExiste("import { Routes } from '@angular/router'",'regra-0','import { Routes',$pathRoutes);
    $canLoad = '';
    if($checkboxRotaApiProtegidaToken){
        $canLoad = ', canLoad: [LoggedInGuard], canActivate: [LoggedInGuard]';
    }
    $new = 'export const ROUTES: Routes = [
]';
    $newList = "    { path: '$namerotaangular', loadChildren: './$namerotaangular/$namerotaangular.module#".$nameGetServices."Module'$canLoad },";
    $newInsert = "    { path: '$namerotaangular/incluir', loadChildren: './$namerotaangular/incluir/incluir.module#IncluirModule' $canLoad },";
    $newAlterar = "    { path: '$namerotaangular/alterar/:id', loadChildren: './$namerotaangular/alterar/alterar.module#AlterarModule' $canLoad },";
    $newDetalhar = "    { path: '$namerotaangular/detalhar/:id', loadChildren: './$namerotaangular/detalhar/detalhar.module#DetalharModule'$canLoad },";
    
    verificarSeRegraExiste($new,'import { Routes }','export const ROUTES',$pathRoutes,2);
    verificarSeRegraExiste($newList,"]","'$namerotaangular'",$pathRoutes);
    if(!empty($inserir)){
        verificarSeRegraExiste($newInsert,"]","'$namerotaangular/incluir'",$pathRoutes);
    }    
    if(!empty($alterar)){
        verificarSeRegraExiste($newAlterar,"]","'$namerotaangular/alterar/:id'",$pathRoutes);
    }
    if(!empty($detalhar)){
        verificarSeRegraExiste($newDetalhar,"]","'$namerotaangular/detalhar/:id'",$pathRoutes);
    }
        
}

$new = "import { RouterModule, PreloadAllModules } from '@angular/router'";
verificarSeRegraExiste($new,"@NgModule({","@angular/router",$caminho."app.module.ts");
$new = "import { ROUTES } from './app.routes'";
verificarSeRegraExiste($new,"@NgModule({","/app.routes",$caminho."app.module.ts");
$new = "    RouterModule.forRoot(ROUTES),";
verificarSeRegraExiste($new,"imports: [","RouterModule.forRoot",$caminho."app.module.ts",2);

if($codigos !=''){
    if (file_force_contents($pathRoutes,$codigos)){
        $msg['success'][] = 'Arquivo '.$pathRoutes.'</b> criado com sucesso';    
        chmod($caminho,0777);
        chmod($pathRoutes,0777);
        require_once("frontend/environments/env.php");
    }else{
        $msg['error'][] = 'Erro ao criar '.$pathRoutes;
    }           
}
function montarFileRoute($namerotaangular,$nameGetServices,$checkboxRotaApiProtegidaToken,$inserir,$alterar,$detalhar){
    $nameGetServices = ucfirst($nameGetServices);
    $canLoad = '';
    if($checkboxRotaApiProtegidaToken){
        $canLoad = ', canLoad: [LoggedInGuard], canActivate: [LoggedInGuard]';
    }

    if(!empty($inserir)){
        $rotaInserir = "{ path: '$namerotaangular/incluir', loadChildren: './$namerotaangular/incluir/incluir.module#IncluirModule' $canLoad },";
    }    
    if(!empty($alterar)){
        $rotaAlterar = "{ path: '$namerotaangular/alterar/:id', loadChildren: './$namerotaangular/alterar/alterar.module#AlterarModule' $canLoad },";
    }
    if(!empty($detalhar)){
        $rotaDetalhar = "{ path: '$namerotaangular/detalhar/:id', loadChildren: './$namerotaangular/detalhar/detalhar.module#DetalharModule'$canLoad },";
    }

    $routes ="import { Routes } from '@angular/router'
    export const ROUTES: Routes = [
        { path: '', component: AppComponent},
        //{ path: 'login/:to', component: LoginComponent },
        //{ path: 'login', component: LoginComponent },
        
        { path: '$namerotaangular', loadChildren: './$namerotaangular/$namerotaangular.module#".$nameGetServices."Module'$canLoad },
        $rotaInserir
        $rotaAlterar
        $rotaDetalhar
        
    
        { path: 'not-found', loadChildren: './not-found/not-found.module#NotFoundModule', canLoad: [LoggedInGuard] },
        { path: '**', redirectTo: 'not-found', pathMatch: 'full' }
    ]";
    return $routes;

}

function verificarSeRegraExiste($new,$encontrarPosicionar,$comparacao,$arquivo,$posicaosalvar=1){
    $declarado = false;
    $new = $new;

    $array_texto = file($arquivo,FILE_IGNORE_NEW_LINES);
    $encontrarPosicionar = $encontrarPosicionar;
    $comparacao = $comparacao;
    //percorrendo arquivo
    $i =0;
    foreach ($array_texto as $line_num => $line) {
        $i++;
        
        $explodeComposer = explode($encontrarPosicionar,$line);
        if(count($explodeComposer)>1){
            $posicaoAddUrl = $line_num;//Pegando a posição do array para adicionar a nova URL
        }
        if($encontrarPosicionar == 'regra-0'){
            $posicaoAddUrl = 0;
        }
        //Vericando se a URL nova já existe no arquivo .htaccess
        $explodeComparacao = explode($comparacao,$line);
        if(count($explodeComparacao)>1){
            $declarado = true; 
            break;
        }
    }

    if($declarado){
        $msg['warning'][] = 'Já existe a regra <small><b>('.$new.')</b></small> em '.$arquivo;
    }else{
        //Pegando regra atual para concatenar com nova regra
        $textoOriginal = $array_texto[$posicaoAddUrl];
        if($posicaosalvar == 1){
            $array_texto[$posicaoAddUrl] =$new."\n".$textoOriginal;
        }else{
            $array_texto[$posicaoAddUrl] =$textoOriginal."\n".$new;
        }
        //Adicionando nova regra no local correto
        if(file_put_contents($arquivo,implode("\n",$array_texto))){
            $msg['success'][] = 'Importação do shared modulo '.$arquivo .'criado com sucesso';
        }else{
            $msg['error'][] = 'Não foi possivel adicionar a importação do shared module em '.$arquivo ;
        }   
    }
}