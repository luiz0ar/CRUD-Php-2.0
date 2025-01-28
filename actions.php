<?php
session_start();
require 'connection.php';
if (isset($_POST['userCreate'])) {
    $name = mysqli_real_escape_string($connection, trim($_POST['name']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $birth = mysqli_real_escape_string($connection, trim($_POST['birth']));
    $password = isset($_POST['password']) ? mysqli_real_escape_string($connection, password_hash(trim($_POST['password']), PASSWORD_DEFAULT)) : '';
    $sql_check_email = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql_check_email);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = 'O e-mail informado já está cadastrado.';
        header('Location: userCreate.php');
        return;
    }
    $sql = "INSERT INTO users (name, email, birth, password) VALUES ('$name', '$email', '$birth', '$password')";
    mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['message'] = 'Usuário criado com sucesso.';
        header('Location: index.php');
        return;
    } else {
        $_SESSION['message'] = 'Usuário não foi criado';
        header('Location: index.php');
        return;
    }
}

if (isset($_POST['userUpdate'])) {
	$user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
	$name = mysqli_real_escape_string($connection, trim($_POST['name']));
	$email = mysqli_real_escape_string($connection, trim($_POST['email']));
	$birth = mysqli_real_escape_string($connection, trim($_POST['birth']));
	$password = mysqli_real_escape_string($connection, trim($_POST['password']));
    $sql_check_email = "SELECT id FROM users WHERE email = '$email' AND id != '$user_id'";
	$result = mysqli_query($connection, $sql_check_email);
	if (mysqli_num_rows($result) > 0) {
		$_SESSION['message'] = 'O e-mail informado já está cadastrado.';
		header('Location: userUpdate.php');
		return;
	}
	$sql = "UPDATE users SET name = '$name', email = '$email', birth = '$birth'";
	if (!empty($password)) {
		$sql .= ", password='" . password_hash($password, PASSWORD_DEFAULT) . "'";
	}
	$sql .= " WHERE id = '$user_id'";
	mysqli_query($connection, $sql);
	if (mysqli_affected_rows($connection) > 0) {
		$_SESSION['message'] = 'Usuário atualizado com sucesso';
		header('Location: index.php');
		return;
	} else {
		$_SESSION['message'] = 'Usuário não foi atualizado';
		header('Location: index.php');
		return;
	}
}
if (isset($_POST['userDelete'])) {
	$user_id = mysqli_real_escape_string($connection, $_POST['userDelete']);
	$sql = "DELETE FROM users WHERE id = '$user_id'";
	mysqli_query($connection, $sql);
	if (mysqli_affected_rows($connection) > 0) {
		$_SESSION['message'] = 'Usuário deletado com sucesso';
		header('Location: index.php');
		return;
	} else {
		$_SESSION['message'] = 'Usuário não foi deletado';
		header('Location: index.php');
		return;
	}
}
?>