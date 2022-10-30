<?php 
include('config.php');

$login=(string)addslashes($_POST['username']);
$senha=(string)addslashes(md5($_POST['password']));

$sql_user="select * from usuario where user_login='".$login."' and user_senha='".$senha."'";
$rel=mysqli_query($conexao, $sql_user);
$valor=mysqli_fetch_array($rel);

$verify=mysqli_num_rows($rel);
if($verify==1){
    $_SESSION['codsessao']=$valor['id'];
    $_SESSION['nome']=$valor['user_nome'];
    $_SESSION['tipo']=$valor['tipo'];
    $_SESSION['ativo_inativo']=$valor['ativo_inativo'];
    
    print"<script>document.location='../index.php'</script>";
}
else{
    print"<script>document.location='login.php?error=1'</script>";
}
?>