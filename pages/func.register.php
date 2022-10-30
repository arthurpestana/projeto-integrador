<?php 
session_start();
include('config.php');

$name= mysqli_real_escape_string($conexao, trim($_POST['name']));
$username= mysqli_real_escape_string($conexao, trim($_POST['username']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$password = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));

$sql="select count(*) as total from usuario where user_login = '$username' or email = '$email'";
$result= mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] >= 1){
    $_SESSION['user_exists'] = 1;
    header('Location: register.php');
    exit;
}

$sql = "INSERT INTO usuario (user_nome, user_login, user_senha, email, ativo_inativo) VALUES ('$name', '$username', '$password', '$email', '1')";
if($conexao->query($sql) === TRUE){
    $_SESSION['register_status'] = true;
}

$conexao->close();
header('Location: register.php');
exit;
?>