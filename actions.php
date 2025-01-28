<?php
session_start();
require 'conection.php';
if (isset($_POST['userCreate'])) {
	$name = mysqli_real_escape_string($conection, trim($_POST['name']));
	$email = mysqli_real_escape_string($conection, trim($_POST['email']));
	$birth = mysqli_real_escape_string($conection, trim($_POST['birth']));
	$password = isset($_POST['password']) ? mysqli_real_escape_string($conection, password_hash(trim($_POST['password']), PASSWORD_DEFAULT)) : '';
	$sql = "INSERT INTO users (name, email, birth, password) VALUES ('$name', '$email', '$birth', '$password')";
	mysqli_query($conection, $sql);
	if (mysqli_affected_rows($conection) > 0) {
		$_SESSION['message'] = 'Usuário criado com sucesso.';
		header('Location: index.php');
		exit;
	} else {
		$_SESSION['message'] = 'Usuário não foi criado';
		header('Location: index.php');
		exit;
	}
}
if (isset($_POST['userUpdate'])) {
	$user_id = mysqli_real_escape_string($conection, $_POST['user_id']);
	$name = mysqli_real_escape_string($conection, trim($_POST['name']));
	$email = mysqli_real_escape_string($conection, trim($_POST['email']));
	$birth = mysqli_real_escape_string($conection, trim($_POST['birth']));
	$password = mysqli_real_escape_string($conection, trim($_POST['password']));
	$sql = "UPDATE users SET name = '$name', email = '$email', birth = '$birth'";
	if (!empty($password)) {
		$sql .= ", password='" . password_hash($password, PASSWORD_DEFAULT) . "'";
	}
	$sql .= " WHERE id = '$user_id'";
	mysqli_query($conection, $sql);
	if (mysqli_affected_rows($conection) > 0) {
		$_SESSION['message'] = 'Usuário atualizado com sucesso';
		header('Location: index.php');
		exit;
	} else {
		$_SESSION['message'] = 'Usuário não foi atualizado';
		header('Location: index.php');
		exit;
	}
}
if (isset($_POST['delete_usuario'])) {
	$user_id = mysqli_real_escape_string($conection, $_POST['delete_usuario']);
	$sql = "DELETE FROM users WHERE id = '$user_id'";
	mysqli_query($conection, $sql);
	if (mysqli_affected_rows($conection) > 0) {
		$_SESSION['message'] = 'Usuário deletado com sucesso';
		header('Location: index.php');
		exit;
	} else {
		$_SESSION['message'] = 'Usuário não foi deletado';
		header('Location: index.php');
		exit;
	}
}
?>