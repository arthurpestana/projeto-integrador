<?php
unset($_SESSION['admLoggedIn']);
include('config.php');
unset($_SESSION['id']);
$_SESSION['id']=htmlspecialchars($_GET['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro - Atlântida</title>
    <link rel="stylesheet" href="../css/content.css">
    <link rel="shortcut icon" href="../images/favicon.svg" type="image/x-icon">
</head>
<body>
    <header class="header">
        <nav class="header__nav">
            <div class="nav__links">
                <div class="nav__logo">
                    <a href="../index.php"><img src="../images/atlantis-logo.png" alt="Atlantis Logo" id="logo-img"></a>
                </div>
                <a href="./catalog.php">Catálogo</a>
            </div>
            <div class="nav__account">
            <?php
                if($_SESSION['error'] !=0){
                echo '<div class="user-disconnect">';
                   echo '<a href="./pages/login.php" id="login-btn">Login</a>';
                   echo '<a href="./pages/register.php" id="register-btn">Registrar</a>';
                echo '</div>';
                }
                else{
                echo '<div class="user-connect">';
                    echo '<span class="user-btn"><img src="../images/person.svg" alt="" width="28px"></span>';
                    echo '<div class="nav__dropdown">';
                        echo '<a href="" id="account-btn">Conta</a>';
                        echo '<a href="" id="logout-btn">Desconectar</a>';
                    echo '</div>';
                echo '</div>';
                }
                ?>
            </div>
        </nav>
    </header>
    <main class="main">
        <div class="main__book">
        <?php
        $sql_generico = "select * from cadastro_geral where id_cadastro_geral=".$_SESSION['id']."";
        $consulta_generico = mysqli_query($conexao, $sql_generico);
        $linha = mysqli_fetch_array($consulta_generico);
        
        $sql_categoria = "select * from categoria where id_categoria=".$linha['cod_categoria']."";
        $consulta_categoria = mysqli_query($conexao, $sql_categoria);
        $categoria = mysqli_fetch_array($consulta_categoria);

        $sql_editora = "select * from editora where id_editora=".$linha['cod_editora']."";
        $consulta_editora=mysqli_query($conexao, $sql_editora);
        $editora=mysqli_fetch_array($consulta_editora);
            echo'<div class="book__img">';
                echo'<img src="../'.$linha['imagens'].'" alt="">';
            echo'</div>';
            echo'<div class="book__info">';
                echo'<div class="book__header">';
                    echo'<h1>'.$linha['titulo'].'</h1>';
                    echo'<div class="book__review">';
                        echo'<span>'.$linha['ano'].'</span>';
                        echo'<span>'.$categoria['descricao'].'</span>';
                        echo'<span>'.$editora['descricao'].'</span>';
                        echo'<span>'.$linha['idioma'].'</span>';
                        echo'<span>Nº Comentários</span>';
                        echo'<a href="func.content.php?aval=1&id='.$linha['id_cadastro_geral'].'&user='.$_SESSION['codsessao'].'">Avaliação <img src="../images/star.svg" alt=""></a>';
                    echo'</div>';
                echo'</div>';
                echo'<div class="book__content">';
                    echo '<p>'.$linha['resenha'].'</p>';
                echo'</div>';
            echo'</div>';
            ?>
        </div>
    </main>
    <script src="../js/user-dropdown.js"></script>
</body>
</html>