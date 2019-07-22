
<?php

$db_host = $_POST['db_host'] ? $_POST['db_host'] : '';
$db_nome = $_POST['db_nome'] ? $_POST['db_nome'] : '';
$db_usuario = $_POST['db_usuario'] ? $_POST['db_usuario'] : '';
$db_senha = $_POST['db_senha'] ? $_POST['db_senha'] : '';
$db_driver = $_POST['db_driver'] ? $_POST['db_driver'] : '';


$criarDB = '<?php
define("DB_HOST", "' . $db_host . '");
define("DB_NOME", "' . $db_nome . '");
define("DB_USUARIO", "' . $db_usuario . '");
define("DB_SENHA", "' . $db_senha . '");
define("DB_DRIVER", "'.$db_driver.'");';
// print json_encode($criarDB);

@chmod(__DIR__ . '/class/db_config.php', 0777);
if (file_put_contents("../class/db_config.php", $criarDB)) {
    // Util::refresh();
    print json_encode("sucesso");
} else {
    print json_encode ("Erro ao criar");
}