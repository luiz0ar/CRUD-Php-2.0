<?php
define('HOST', '10.1.99.17');
define('USUARIO', 'root');
define('PASSWORD', 'root');
define('DB', 'phpcrud');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Can not connect.');
?>