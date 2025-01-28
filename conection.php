<?php
define('HOST', '127.0.0.1');
define('USER', 'login');
define('PASSWORD', 'login@748596');
define('DB', 'phpcrud');

$conection = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Can not connect.');
?>