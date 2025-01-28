<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', 'root');
define('DB', 'phpcrud');

$conexao = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Can not connect.');
?>