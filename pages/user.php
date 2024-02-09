<?php 
include('config.php');
session_start();
if($_SESSION['error'] != 0){
    header('Location: login.php');
}
unset($_SESSION['register_status']);
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
            <?php
                if($_SESSION['userLoggedIn'] != 1){
                echo '<div class="user-disconnect">';
                   echo '<a href="../pages/login.php" id="login-btn">Login</a>';
                   echo '<a href="../pages/register.php" id="register-btn">Registrar</a>';
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
                <h2>Administração do Usuário:</h2>
                <div class="adm__insert-btn">
                    <div class="insert-more">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="adm__publis">
                <div class="adm__content">
                    <div class="content__img">
                        <img src="../images/direito-penal.jpg" alt="">
                    </div>
                    <div class="content__book">
                        <div class="content__title">
                            <h3>Título</h3>
                        </div>
                        <div class="content__info1">
                            <span>Tipo</span>
                            <span>Editora</span>
                            <span>Autor</span>
                            <span>Categoria</span>
                        </div>
                        <div class="content__info2">
                            <span>Coleção</span>
                            <span>Classificação</span>
                            <span>Edição</span>
                            <span>Ano do Livro</span>
                        </div>
                        <div class="content__info3">
                            <span>Idioma</span>
                            <span>Cidade</span>
                            <span>Ano da postagem</span>
                            <span class="star">Avaliações <img src="../images/star.svg" alt="" width="15px"></span>
                        </div>
                        <div class="content__info4">
                            <span>Assunto</span>
                        </div>
                    </div>
                    <div class="content__buttons">
                        <img src="../images/trash-outline.svg" alt="">
                        <img src="../images/pencil-outline.svg" alt="">
                    </div>
                </div>
                <div class="adm__content">
                    <div class="content__img">
                        <img src="../images/direito-penal.jpg" alt="">
                    </div>
                    <div class="content__book">
                        <div class="content__title">
                            <h3>Título</h3>
                        </div>
                        <div class="content__info1">
                            <span>Tipo</span>
                            <span>Editora</span>
                            <span>Autor</span>
                            <span>Categoria</span>
                        </div>
                        <div class="content__info2">
                            <span>Coleção</span>
                            <span>Classificação</span>
                            <span>Edição</span>
                            <span>Ano do Livro</span>
                        </div>
                        <div class="content__info3">
                            <span>Idioma</span>
                            <span>Cidade</span>
                            <span>Ano da postagem</span>
                            <span class="star">Avaliações <img src="../images/star.svg" alt="" width="15px"></span>
                        </div>
                        <div class="content__info4">
                            <span>Assunto</span>
                        </div>
                    </div>
                    <div class="content__buttons">
                        <img src="../images/trash-outline.svg" alt="">
                        <img src="../images/pencil-outline.svg" alt="">
                    </div>
                </div>
                <div class="adm__content">
                    <div class="content__img">
                        <img src="../images/direito-penal.jpg" alt="">
                    </div>
                    <div class="content__book">
                        <div class="content__title">
                            <h3>Título</h3>
                        </div>
                        <div class="content__info1">
                            <span>Tipo</span>
                            <span>Editora</span>
                            <span>Autor</span>
                            <span>Categoria</span>
                        </div>
                        <div class="content__info2">
                            <span>Coleção</span>
                            <span>Classificação</span>
                            <span>Edição</span>
                            <span>Ano do Livro</span>
                        </div>
                        <div class="content__info3">
                            <span>Idioma</span>
                            <span>Cidade</span>
                            <span>Ano da postagem</span>
                            <span class="star">Avaliações <img src="../images/star.svg" alt="" width="15px"></span>
                        </div>
                        <div class="content__info4">
                            <span>Assunto</span>
                        </div>
                    </div>
                    <div class="content__buttons">
                        <img src="../images/trash-outline.svg" alt="">
                        <img src="../images/pencil-outline.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/user-dropdown.js"></script>
</body>
</html>