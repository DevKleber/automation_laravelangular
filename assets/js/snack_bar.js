function snackbar(texto) {
    var x = document.getElementById("snackbar");
    document.getElementById("snackbar").innerHTML = texto;

    x.className = "show";

    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
} 