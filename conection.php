<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('PASSWORD', 'root');
define('DB', 'phpcrud');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Can not connect.');
?>