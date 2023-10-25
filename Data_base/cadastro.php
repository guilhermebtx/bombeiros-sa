<?php
session_start();
include("conexao.php");

Recebe os valores
$user_name = mysqli_real_escape_string($conexao, trim($_POST['name']));
$user_email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$user_senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

Valida o email
$sql = "select count(*) as total from usuario where email = '$user_email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

Valida o usuario como já existente
if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: login.php');
	exit;
}

Insere os valores no banco
$sql = "INSERT INTO usuario (email,senha) VALUES ('$user_email', '$user_senha')";

Executa se for verdadeiro
if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
	$conexao->close();

	header('Location: index.html');
}
//exit;
//?>