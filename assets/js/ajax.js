function atualizedb() {
    document.getElementById("msgcfdb").innerHTML = "";
    var Self = this; if (Self.working) {
        return;
    }
    Self.working = true;
    var formData = new FormData($("#form")[0]);
    jQuery.ajax({
        type: 'POST',
        mimeType: "multipart/form-data",
        url: 'ajax/manipulationdb.php',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false
    }).done(function (html) {
        if (html == "sucesso") {
            var body = ' <div class="alert alert-success mb-25" role="alert">Sucesso ao alterar conexão com o banco. </div> ';
            modal(true,body,"Sucesso!");
        } else {
            var body = ' <div class="alert alert-danger mb-25" role="alert"> Erro ao alterar conexão com o banco.<br/> Favor, verifique a permissão da arquivo db_config.php </div> ';
            modal(false,body,"Error!");
            snackbar("Error teste");

        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
            modal(false,errorThrown,"Error!");
            if(textStatus=='parsererror'){
                var body = ' <div class="alert alert-danger mb-25" role="alert"> Erro ao alterar conexão com o banco.<br/> Favor, verifique a permissão da arquivo db_config.php </div> ';
                modal(false,body,"Error!");
                snackbar("Error");
            }

    }).always(function () {
        Self.working = false;
    });
}
function modal(refresh,body,title){
    $('#exampleModal').modal("show");
    document.getElementById("modalBody").innerHTML = body ;
    document.getElementById("exampleModalLabel").innerHTML = title ;
    
    $('#exampleModal').on('hidden.bs.modal', function () {
        if(refresh){
            window.location.reload();
            
        }

    })
}