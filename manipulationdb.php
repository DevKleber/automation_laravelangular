
<div class="row mt-25">
    <div class="col-md-4 ">
        <div class="list-container">
            <div class="list-item border">
                <div class="list-item-title">
                    <div class="list-item-title-icon "><img src="assets/images/database.png" width="50%"></div>
                    <div class="list-item-title-text">Banco</div>
                </div>
                <div class="list-item-content-name"><?= DB_HOST . ' - ' . DB_NOME ?></div>
                <form id="form" name="form"  >
                    <div class="list-item-content-text">
                        <label class="edit-input"><b>Driver: </b></label>
                        <input class="edit-input" type="text" value="<?= DB_DRIVER ?>"name="db_driver">
                    </div>
                    <div class="list-item-content-text">
                        <label class="edit-input"><b>Host: </b></label>
                        <input class="edit-input" type="text" value="<?= DB_HOST ?>"name="db_host">
                    </div>
                    <div class="list-item-content-text">
                    <label class="edit-input"><b>Nome do Banco: </b></label>
                        <input class="edit-input" type="text" value="<?= DB_NOME ?>"name="db_nome">
                    </div>
                    <div class="list-item-content-text">
                        <label class="edit-input"><b>Usuário: </b></label>
                        <input class="edit-input" type="text" value="<?= DB_USUARIO ?>"name="db_usuario">
                    </div>
                    <div class="list-item-content-text">
                        <label class="edit-input"><b>Senha: </b></label>
                        <input class="edit-input" type="password"value="<?= DB_SENHA ?>"name="db_senha">
                    </div>
                </form>  
                <button class="btn m-all-15 button" onClick="atualizedb()" name="btnalterdb">Alterar</button>
                <div id="msgcfdb"></div>    
            </div>
        </div>
    </div>
</div>

<script >

$(".list-item").click(function (e) {
        $('.list-item').removeClass('active');
        $(this).addClass("active");
        e.stopPropagation();
    });

    $(document).click(function () {
        $('.list-item').removeClass("active"); //hide the button
    });

//# sourceURL=pen.js
</script>

