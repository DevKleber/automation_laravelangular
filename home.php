<?php
require_once 'manipulationdb.php';
$conf_db = new Conf_db();
?>

<script>
    checkCriarFo();
    CriarUrl();
</script>

<form method="POST" action="?pag=criar" name="myForm" onsubmit="return validateForm()" >
    <div class="card mt-15 border">
        <div class="card-header bgblue">
        Criando automação do LARAVEL (BACK-END) e ANGULAR (FRONT-END)
        </div>
            <div class="card-body">
                
                <!-- selecione tabela do banco  -->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tabelas</label>
                    <select class="form-control tabelaCheck " id="select" name="table">
                        <option></option>
                        <?php
                        foreach ($conf_db->getTables() as $key => $t) {
                            ?> <option value="<?= $t ?>"><?= $t ?></option> <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- fim selecione tabela do banco  -->




                <div class="form-group">
                    <label for="exampleForm">Nome do Component</label>
                    <input type="text" class="form-control inputCheck" onKeyup="montarHtaccess()"  id="nameComponent" name="nameComponent" >
                </div>                
                
             
                <!-- bloco frontend -->
                <label class="check">Criar ANGULAR (FRONT-END)?
                    <input class="form-check-input checkbox " type="checkbox" onclick="checkCriarFo()" value="fo" id="checkboxFo" name="criar_fo" >
                    <span class="checkmark"></span>
                </label>

                <div  class="form-group mt-15 ml-20 newBloco">
                    <div class="col-md-12 m-0  hide" id="caminhofe" >
                        <div id="path_fo" class="form-group  mt-15">
                            <label for="exampleForm">Caminho do Angular</label><br />
                            <input type="text" name="caminho" class="form-control inputCheck" id="caminhoFrontEnd"  placeholder="/home/documents/angular/automation/src/app (Caminho raiz do sistema até o APP)" >
                        </div>
                    </div>
                    <div class="col-md-6 m-0  hide" id="urlami">
                        <label class="check">Criar rota angular?
                            <input class="form-check-input" type="checkbox" onclick="CriarUrl()" value="fo" id="caminhoRouteAngular" name="caminhoRouteAngular" >
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="hide mt-30 ml-50 newBloco"  id="urlAmigavel">
                        <div class="mt-15">
                            <label class="check">Criar rota protegida por token?
                                <input class="form-check-input" type="checkbox" onclick="CriarUrl()" value="fo" id="checkboxRotaApiProtegidaToken" name="checkboxRotaApiProtegidaToken" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="col-md-4 m-0 p-0">
                            <label for="exampleForm">Nome da rota </label><br />
                            <input type="text" id="namerotaangular" onKeyup="alterarUrlAmigavel()" name="namerotaangular" class="form-control inputCheck"  placeholder="contactos|contacts|contact">
                        </div>
                        
                    </div>
                </div>
                <!-- bloco frontend -->
                <hr>

                <!-- bloco backend -->
                <div class="">
                    <label class="check">Criar LARAVEL (BACK-END)
                        <input class="form-check-input" type="checkbox" value="bo" onclick="checkCriarBo()" id="checkboxBo" name="criar_bo">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-6 hide mt-15 ml-40 newBloco" id="div_rotaapi">
                    <label class="check">Criar rota api?
                        <input class="form-check-input" type="checkbox" onclick="CriarRotaApi()" value="fo" id="checkboxRotaApi" name="checkboxRotaApi" >
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="ml-60 newBloco" id="div_criar_rota">

                    <div class="col-md-6 hide " id="div_rotabe">
                        <label for="exampleForm">Nome da rota </label><br />
                        <input type="text" id="rotabe" onKeyup="alterarUrlAmigavel()" name="rotabe" class="form-control inputCheck"  placeholder="contactos|contacts|contact">
                    </div>

                    <div id="criarbe" class="hide form-group mt-15 ">
                        <div class="mt-15">
                            <label class="check">Criar rota protegida por token?
                                <input class="form-check-input" type="checkbox" onclick="CriarTokenProtegido()" value="fo" id="checkboxRotaFeProtegidaToken" name="checkboxRotaFeProtegidaToken" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="ml-40 newBloco">

                            <div class="mt-15  hide" id="div_filtrarPorToken">
                                <label class="check">Trazer registros filtrando por token ex: where id = idtoken?
                                    <input class="form-check-input" type="checkbox" onclick="findByToken()" value="fo" id="filtrarPorToken" name="filtrarPorToken" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="mt-15 ml-40 newBloco hide " id="div_idtoken">
                                <label >Qual o campo configurado em jwt.php em 'identifier' => '???' ? </label>
                                <input class="form-control inputCheck" type="text"  id="nameidtoken" name="nameidtoken" placeholder="id_usuario">
                            </div>
                        </div>
                        <div id="path_fo" class="form-group  mt-15">
                            <label for="exampleForm">Caminho do Laravel</label><br />
                            <input type="text" name="caminhoBackEnd" class="form-control inputCheck" id="caminhoBackEnd"  placeholder="/var/www/html/financeiro/app (Caminho raiz do sistema até o APP)" >
                        </div>
                    </div>
                </div>
                <!-- bloco backend -->


            </div>
            <footer class="footer mr-15 text-left footer-space text-right" id="footer">
                <button type="submit" class="btn button btn-info" id="btnform" >Gerar Códigos</button>
            </footer>
        </div>
    </div>
</form>
