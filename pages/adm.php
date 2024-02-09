<?php 
include('config.php');
session_start();
if($_SESSION['admLoggedIn'] != 1 || empty($_SESSION['admLoggedIn'])){
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Atlântida</title>
    <link rel="stylesheet" href="../css/user-adm.css">
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
                <div class="user-disconnect">
                    <a href="../pages/func.adm.php?disconnect=1" id="login-btn">Encerrar sessão</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="main">
        <div class="main__user">
            <div class="user__img">
                <img class="user-img" src="../images/user.png" alt="">
            </div>
            <div class="user__content">
                <div class="user__header">
                    <h1>Nome do usuário</h1>
                </div>
                <div class="user__reviews">
                    <span>Nº de avaliações</span>
                    <span>Nº de comentários</span>
                    <span>Nº de publicações</span>
                </div>
            </div>
        </div>
        <div class="main__adm">
            <div class="adm__header">
                <h2>Administração de livros:</h2>
                <a href="./bookAdd.php"><div class="adm__insert-btn">
                    <div class="insert-more">
                        <div></div>
                        <div></div>
                    </div>
                </div></a>
            </div>
            <div class="adm__publis">
                <?php
                    $sql="select * from cadastro_geral order by id_cadastro_geral";
                    $consulta=mysqli_query($conexao, $sql);
                    while($linha=mysqli_fetch_array($consulta)){
                        if ((!empty($linha))){
                            echo'<div class="adm__content">';
                                echo'<div class="content__img">';
                                    echo'<img src="../'.$linha['imagens'].'" alt="">';
                                echo'</div>';
                                echo'<div class="content__book">';
                                    echo'<div class="content__title">';
                                        echo'<h3>'.$linha['titulo'].'</h3>';
                                    echo'</div>';
                                    $tipo="select * from tipo_cadastro where id_tipo_cadastro=".$linha['cod_tipo_cadastro']."";
                                    $consulta_tipo=mysqli_query($conexao, $tipo);
                                    $tipo_cadastro=mysqli_fetch_array($consulta_tipo);

                                    $editora="select * from editora where id_editora=".$linha['cod_editora']."";
                                    $consulta_editora=mysqli_query($conexao, $editora);
                                    $editora_descricao=mysqli_fetch_array($consulta_editora);

                                    $categ="select * from categoria where id_categoria=".$linha['cod_categoria']."";
                                    $consulta_categ=mysqli_query($conexao, $categ);
                                    $categoria=mysqli_fetch_array($consulta_categ);

                                    $city="select * from cidade where id_cidade=".$linha['cod_cidade']."";
                                    $consulta_city=mysqli_query($conexao, $city);
                                    $cidade=mysqli_fetch_array($consulta_city);
                                    echo'<div class="content__info1">';
                                        echo'<span>'.$tipo_cadastro['descricao'].'</span>';
                                        echo'<span>'.$editora_descricao['descricao'].'</span>';
                                        echo'<span>'.$linha['autores'].'</span>';
                                        echo'<span>'.$categoria['descricao'].'</span>';
                                    echo'</div>';
                                   echo'<div class="content__info2">';
                                        echo'<span>'.$linha['colecao_volume'].'</span>';
                                        echo'<span>'.$linha['classificacao'].'</span>';
                                        echo'<span>'.$linha['edicao'].'</span>';
                                        echo'<span>'.$linha['aquisicao'].'</span>';
                                    echo'</div>';
                                    echo'<div class="content__info3">';
                                        echo'<span>'.$linha['idioma'].'</span>';
                                        echo'<span>'.$cidade['nome'].'</span>';
                                        echo'<span>'.$linha['ano'].'</span>';
                                        echo'<span class="star">Avaliações <img src="../images/star.svg" alt="" width="15px"></span>';
                                    echo'</div>';
                                    echo'<div class="content__info4">';
                                        echo'<span>'.$linha['assunto'].'</span>';
                                    echo'</div>';
                                echo'</div>';
                                echo'<div class="content__buttons">';
                                    echo'<a class="del_btn" href="./func.adm.php?delete='.$linha['id_cadastro_geral'].'"><img src="../images/trash-outline.svg" alt=""></a>';
                                    echo'<a href="./bookAdd.php?id='.$linha['id_cadastro_geral'].'"><img src="../images/pencil-outline.svg" alt=""></a>';
                                echo'</div>';
                            echo'</div>';
                        }
                    }
                ?> 
            </div>
        </div>
    </main>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let del_btn = document.querySelector(".del_btn").addEventListener("click", (del) => {
            swal({
                title: "Você tem certeza?",
                text: "Após deletado, você não poderá recuperar as informações!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("O seu livro foi deletado com sucesso!", {
                        icon: "success",
                    });
                } 
                else {
                    swal("Seu livro ainda está seguro!");
                }
            });
        })
    </script>
    <script src="../js/user-dropdown.js"></script>
</body>
</html>