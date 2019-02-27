function checkCriarBo() {

    var check = document.getElementById('checkboxBo').checked;
    if (check) {
        document.getElementById("criarbe").style.display = "block";

    } else {
        document.getElementById("criarbe").style.display = "none";

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

        document.getElementById('checkboxUrlAmigavel').checked = false;
    }
}

function CriarUrl() {
    var check = document.getElementById('checkboxUrlAmigavel').checked;
    if (check) {
        document.getElementById("urlAmigavel").style.display = "block";

    } else {
        document.getElementById("urlAmigavel").style.display = "none";

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
    var nameMod = document.forms["myForm"]["nameMod"].value;
    var caminho = document.forms['myForm']["caminhoSi"].value;
    var checkfo = document.forms['myForm']["criar_fo"].checked;
    var checkbo = document.forms['myForm']["criar_bo"].checked;
    var e = document.getElementById("select");
    var itemSelecionado = e.options[e.selectedIndex].value;

    if (itemSelecionado == "") {
        document.getElementById("select").focus();
        snackbar("Escolha uma tabela do banco de dados!");
        return false;
    }

    if (nameMod == "") {
        snackbar("Nome do Mod obrigatório!");
        document.getElementById("nameMod").focus();
        return false;
    }
    if (caminho == "") {
        snackbar("Caminho obrigatório!");
        document.getElementById("caminhoSi").focus();
        return false;
    }


    if ((checkbo) || (checkfo)) {
        return true;
    }
    snackbar("Escolha LARAVEL (BACK-END) ou ANGULAR (FRONT-END), obrigatório!");
    return false;

}