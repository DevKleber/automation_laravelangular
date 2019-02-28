function checkCriarBo() {

    var check = document.getElementById('checkboxBo').checked;
    if (check) {
        // document.getElementById("criarbe").style.display = "block";
        document.getElementById("div_rotaapi").style.display = "block";
        
    } else {
        var check = document.getElementById('checkboxRotaFeProtegidaToken').checked = false;
        var check = document.getElementById('checkboxRotaApi').checked = false;
        var check = document.getElementById('filtrarPorToken').checked = false;
        document.getElementById("div_rotaapi").style.display = "none";
        document.getElementById("div_filtrarPorToken").style.display = "none";
        document.getElementById("div_idtoken").style.display = "none";
        document.getElementById("div_idtoken").style.display = "none";
        document.getElementById("criarbe").style.display = "none";
        document.getElementById("div_criar_rota").style.display = "none";
        // document.getElementById("criarbe").style.display = "none";

    }
}

function checkCriarFo() {

    var check = document.getElementById('checkboxFo').checked;
    if (check) {
        document.getElementById("urlami").style.display = "block";
        document.getElementById("caminhofe").style.display = "block";

    } else {
        document.getElementById("urlami").style.display = "none";
        document.getElementById("caminhofe").style.display = "none";
        document.getElementById("urlAmigavel").style.display = "none";

        document.getElementById('caminhoRouteAngular').checked = false;
    }
}

function CriarUrl() {
    var check = document.getElementById('caminhoRouteAngular').checked;
    if (check) {
        document.getElementById("urlAmigavel").style.display = "block";

    } else {
        document.getElementById("urlAmigavel").style.display = "none";

    }
}
function CriarRotaApi() {
    var check = document.getElementById('checkboxRotaApi').checked;
    if (check) {
        document.getElementById("criarbe").style.display = "block";
        document.getElementById("div_rotabe").style.display = "block";
        document.getElementById("div_criar_rota").style.display = "block";
        // document.getElementById("urlAmigavel").style.display = "block";

    } else {
        // document.getElementById("urlAmigavel").style.display = "none";
        document.getElementById("criarbe").style.display = "none";
        document.getElementById("div_rotabe").style.display = "none";
        document.getElementById("div_criar_rota").style.display = "none";

    }
}
function CriarTokenProtegido() {
    var check = document.getElementById('checkboxRotaFeProtegidaToken').checked;
    if (check) {
        document.getElementById("div_filtrarPorToken").style.display = "block";
        
    } else {
        document.getElementById('filtrarPorToken').checked = false;
        document.getElementById("div_filtrarPorToken").style.display = "none";
        document.getElementById("div_idtoken").style.display = "none";

    }
}
function findByToken() {
    var check = document.getElementById('filtrarPorToken').checked;
    if (check) {
        document.getElementById("div_idtoken").style.display = "block";

    } else {
        document.getElementById("div_idtoken").style.display = "none";

    }
}

function myFunction() {
    document.getElementById("alertCopy").style.display = "none";
    var text = document.getElementById("copyMenu");
    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(text);
    selection.removeAllRanges();
    selection.addRange(range);

    if (document.execCommand('copy')) {
        document.getElementById("alertCopy").style.display = "block";
    }
}
$(".list-item").click(function (e) {
    $('.list-item').removeClass('active');
    $(this).addClass("active");
    e.stopPropagation();
});


function validateForm() {
    var nameComponent = document.forms["myForm"]["nameComponent"].value;
    var caminho = document.forms['myForm']["caminhoFrontEnd"].value;
    var caminhoBackEnd = document.forms['myForm']["caminhoBackEnd"].value;
    var checkfo = document.forms['myForm']["criar_fo"].checked;
    var checkbo = document.forms['myForm']["criar_bo"].checked;

    
    var e = document.getElementById("select");
    var itemSelecionado = e.options[e.selectedIndex].value;

    if (itemSelecionado == "") {
        document.getElementById("select").focus();
        snackbar("Escolha uma tabela do banco de dados!");
        return false;
    }

    if (nameComponent == "") {
        snackbar("Nome do Componente obrigatório!");
        document.getElementById("nameComponent").focus();
        return false;
    }
    if (checkfo) {
        if (caminho == "") {
            snackbar("Caminho obrigatório!");
            document.getElementById("caminhoFrontEnd").focus();
            return false;
        }
    }
    if (checkbo) {
        if (caminhoBackEnd == "") {
            snackbar("Caminho do BackEnd é obrigatório!");
            document.getElementById("caminhoFrontEnd").focus();
            return false;
        }
    }


    if ((checkbo) || (checkfo)) {
        return true;
    }
    // snackbar("Escolha LARAVEL (BACK-END) ou ANGULAR (FRONT-END), obrigatório!");
    // return false;

}