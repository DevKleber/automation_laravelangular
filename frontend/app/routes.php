<?php
$pathRoutes = $caminho.'app.routes.ts';
$codigos = '';
if (!file_exists($pathRoutes)) {
    $codigos = montarFileRoute($namerotaangular,$nameGetServices,$checkboxRotaApiProtegidaToken,$inserir,$alterar,$detalhar,$nomeComponent);
}else{
    $new = "    { path: '**', redirectTo: 'not-found', pathMatch: 'full' },";
    verificarSeRegraExiste($new,']',"path: '**'",$pathRoutes);
    // $new,$encontrarPosicionar,$comparacao,$arquivo,$posicaosalvar=1
    $ret = verificarSeRegraExiste("import { Routes } from '@angular/router'",'regra-0','import { Routes',$pathRoutes);
    if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
    $canLoad = '';
    if($checkboxRotaApiProtegidaToken){
        $canLoad = ', canLoad: [LoggedInGuard], canActivate: [LoggedInGuard]';
    }
    $new = 'export const ROUTES: Routes = [
]';
    $newList = "    { path: '$namerotaangular', loadChildren: './$namerotaangular/$namerotaangular.module#".$nomeComponent."Module'$canLoad },";
    $newInsert = "    { path: '$namerotaangular/incluir', loadChildren: './$namerotaangular/incluir/incluir.module#IncluirModule' $canLoad },";
    $newAlterar = "    { path: '$namerotaangular/alterar/:id', loadChildren: './$namerotaangular/alterar/alterar.module#AlterarModule' $canLoad },";
    $newDetalhar = "    { path: '$namerotaangular/detalhar/:id', loadChildren: './$namerotaangular/detalhar/detalhar.module#DetalharModule'$canLoad },";
    
    $ret = verificarSeRegraExiste($new,'import { Routes }','export const ROUTES',$pathRoutes,2);
    if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
    $ret = verificarSeRegraExiste($newList,"path: '**'","'$namerotaangular'",$pathRoutes);
    if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
    if(!empty($inserir)){
        $ret = verificarSeRegraExiste($newInsert,"path: '**'","'$namerotaangular/incluir'",$pathRoutes);
        if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
    }    
    if(!empty($alterar)){
        $ret = verificarSeRegraExiste($newAlterar,"path: '**'","'$namerotaangular/alterar/:id'",$pathRoutes);
        if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
    }
    if(!empty($detalhar)){
        $ret = verificarSeRegraExiste($newDetalhar,"path: '**'","'$namerotaangular/detalhar/:id'",$pathRoutes);
        if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
    }
        
}
$new = "<router-outlet></router-outlet>";
$ret = verificarSeRegraExiste($new,"regra-ultimalinha","<router-outlet>",$caminho."app.component.html");
if($ret!='alert')$msg['success'][$pastaApi][] = 'app.component.html';

$new = "import { RouterModule, PreloadAllModules } from '@angular/router'";
$ret = verificarSeRegraExiste($new,"@NgModule({","@angular/router",$caminho."app.module.ts");
if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
$new = "import { ROUTES } from './app.routes'";
$ret = verificarSeRegraExiste($new,"@NgModule({","/app.routes",$caminho."app.module.ts");
if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';
$new = "    RouterModule.forRoot(ROUTES),";
$ret = verificarSeRegraExiste($new,"imports: [","RouterModule.forRoot",$caminho."app.module.ts",2);
if($ret!='alert')$msg['warning'][$pastaApi][] = $ret.' .info';

if($codigos !=''){
    if (file_force_contents($pathRoutes,$codigos)){
        $msg['success'][$pastaApi][] = 'app.routes.ts';    
        @chmod($caminho,0777);
        @chmod($pathRoutes,0777);
        require_once("frontend/environments/env.php");
    }else{
        $msg['success'][$pastaApi][] = 'ERROR|app.routes.ts';
    }           
}
function montarFileRoute($namerotaangular,$nameGetServices,$checkboxRotaApiProtegidaToken,$inserir,$alterar,$detalhar,$nomeComponent){
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
    //{ path: '', component: AppComponent},
    //{ path: 'login/:to', component: LoginComponent },
    //{ path: 'login', component: LoginComponent },
    
    { path: '$namerotaangular', loadChildren: './$namerotaangular/$namerotaangular.module#".$nomeComponent."Module'$canLoad },
    $rotaInserir
    $rotaAlterar
    $rotaDetalhar
    

    //{ path: 'not-found', loadChildren: './not-found/not-found.module#NotFoundModule', canLoad: [LoggedInGuard] },
    { path: '**', redirectTo: 'not-found', pathMatch: 'full' },
]";
    return $routes;

}
