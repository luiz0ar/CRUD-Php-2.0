<?php
define('HOST', '127.0.0.1:3306');
define('USER', 'root');
define('PASSWORD', 'root');
define('DB', 'phpcrud');

$connection = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Can not connect.');
?>