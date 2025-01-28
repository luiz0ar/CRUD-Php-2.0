<?php
session_start();
require 'conexao.php';
if (isset($_POST['create_usuario'])) {
	$name = mysqli_real_escape_string($conexao, trim($_POST['name']));
	$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
	$birth = mysqli_real_escape_string($conexao, trim($_POST['birth']));
	$password = isset($_POST['password']) ? mysqli_real_escape_string($conexao, password_hash(trim($_POST['password']), PASSWORD_DEFAULT)) : '';
	$sql = "INSERT INTO usuarios (name, email, birth, password) VALUES ('$name', '$email', '$birth', '$password')";
	mysqli_query($conexao, $sql);
	if (mysqli_affected_rows($conexao) > 0) {
		$_SESSION['mensagem'] = 'Usuário criado com sucesso.';
		header('Location: index.php');
		exit;
	} else {
		$_SESSION['mensagem'] = 'Usuário não foi criado';
		header('Location: index.php');
		exit;
	}
}
if (isset($_POST['update_usuario'])) {
	$usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
	$name = mysqli_real_escape_string($conexao, trim($_POST['name']));
	$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
	$birth = mysqli_real_escape_string($conexao, trim($_POST['birth']));
	$password = mysqli_real_escape_string($conexao, trim($_POST['password']));
	$sql = "UPDATE usuarios SET name = '$name', email = '$email', birth = '$birth'";
	if (!empty($password)) {
		$sql .= ", password='" . password_hash($password, PASSWORD_DEFAULT) . "'";
	}
	$sql .= " WHERE id = '$usuario_id'";
	mysqli_query($conexao, $sql);
	if (mysqli_affected_rows($conexao) > 0) {
		$_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
		header('Location: index.php');
		exit;
	} else {
		$_SESSION['mensagem'] = 'Usuário não foi atualizado';
		header('Location: index.php');
		exit;
	}
}
if (isset($_POST['delete_usuario'])) {
	$usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
	$sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";
	mysqli_query($conexao, $sql);
	if (mysqli_affected_rows($conexao) > 0) {
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