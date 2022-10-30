<?php
include('config.php');

unset($_SESSION['search-input']);

@$_SESSION['search-input']=(!empty($_POST['search-input'])?"(titulo like '%".trim($_POST['search-input']."%')"):$_SESSION['search-input']);
if((!empty($consulta)) && (!empty($_SESSION['search-input']))){
    $consulta=$consulta."and".$_SESSION['search-input'];
}
if((empty($consulta)) && (!empty($_SESSION['search-input']))){
    $consulta=$_SESSION['search-input'];
}
$_SESSION['consulta']=(!empty($consulta)?" where ".$consulta:NULL);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/catalog.css">
    <link rel="shortcut icon" href="../images/favicon.svg" type="image/x-icon">
    <title>Catálogo - Atlântida</title>
</head>
<body>
    <header class="header">
        <nav class="header__nav">
            <div class="nav__hamburguer">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="nav__links">
                <ul class="nav__list">
                    <div class="nav__pages">
                        <li class="nav__logo"><a href="../index.php"><img src="../images/logo-white.png" alt="Atlantis Logo" class="nav__imgs"><img src="../images/atlantis-logo-white.png" alt="" class="nav__text" id="logo-img"></a></li>
                        <li><a href="./catalog.php"><img src="../images/catalog-outline.svg" alt="" class="nav__imgs"><span class="nav__text">Catálogo</span></a></li>
                        <li><a href="./about.html"><img src="../images/about-circle-outline.svg" alt="" class="nav__imgs"><span class="nav__text">Sobre nós</span></a></li>
                        <li><a href="./login.php" id="login-btn"><img src="../images/log-in-outline.svg" alt="" class="nav__imgs"><span class="nav__text">Login</span></a></li>
                        <li><a href="./register.php" id="register-btn"><img src="../images/sign-up-outline.svg" alt="" class="nav__imgs"><span class="nav__text">Registrar</span></a></li>
                    </div>
                    <div class="nav__user">
                        <li><a href="./user.html"><img src="../images/user-circle-outline.svg" alt="" class="nav__imgs"><span class="nav__text">Usuário</span></a></li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>
    <main class="main">
        <form class="catalog__search" method="POST">
            <input type="text" name="search-input" class="search-input" OnClick="content.action='index.php'; content.submit()">
            <span class="search-focus" data-placeholder="Pesquisar por livros"><img src="../images/search-outline.svg" alt="Lupa" id="search-img"></span>
        </form>
        <div class="catalog__main">
            <section class="catalog__trend">
                <h1>Tendência</h1>
                <div class="catalog__trend--slider">
                    <div class="catalog__slider-content">
                        <?php
                        $sql_generico="select * from cadastro_geral ".$_SESSION['consulta']." order by ano";
                        $consulta_generico=mysqli_query($conexao, $sql_generico);
                        while($linha=mysqli_fetch_array($consulta_generico)){
                            if ((!empty($linha))){
                                echo'<div class="catalog__trend--book">';
                                    echo'<div class="trend__book">';
                                        echo'<img src="../'.$linha['imagens'].'" alt="Capa do Livro" class="book-img">';
                                    echo'</div>';
                                    echo'<div class="trend__book-info">';
                                        echo'<div class="book-sub-info">';
                                            echo'<span>'.$linha['ano'].'</span>';
                                            echo'<span>'.$linha['classificacao'].'</span>';
                                            echo'<ul class="book__star">';
                                                echo'<li class="star-icon" data-avaliacao="1"></li>';
                                                echo'<li class="star-icon" data-avaliacao="2"></li>';
                                                echo'<li class="star-icon" data-avaliacao="3"></li>';
                                                echo'<li class="star-icon" data-avaliacao="4"></li>';
                                                echo'<li class="star-icon" data-avaliacao="5"></li>';
                                            echo'</ul>';
                                        echo'</div>';
                                        echo'<h2 class="book-title">'.$linha['titulo'].'</h2>';
                                    echo'</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <div class="arrow-left slider__btn"><img src="../images/arrow-back-outline.svg" alt=""></div>
                    <div class="arrow-right slider__btn"><img src="../images/arrow-forward-outline.svg" alt=""></div>
                </div>
            </section>
            <section class="catalog__recommend">
                <h1>Recomendados para você</h1>
                    <?php
                    $sql_generico="select * from cadastro_geral ".$_SESSION['consulta']." order by rand()";
                    $consulta_generico=mysqli_query($conexao, $sql_generico);
                    while($linha=mysqli_fetch_array($consulta_generico)){
                        if ((!empty($linha))){
                            echo'<div class="catalog__recommend--grid">';
                                echo'<div class="catalog__recommend--book">';
                                    echo'<div class="recommend__book">';
                                        echo'<img src="../'.$linha['imagens'].'" alt="Capa do Livro" class="book-img">';
                                    echo'</div>';
                                    echo'<div class="recommend__book-info">';
                                        echo'<div class="book-sub-info">';
                                            echo'<span>'.$linha['ano'].'</span>';
                                            echo'<span>'.$linha['classificacao'].'</span>';
                                            echo'<ul class="book__star">';
                                                echo'<li class="star-icon" data-avaliacao="1"></li>';
                                                echo'<li class="star-icon" data-avaliacao="2"></li>';
                                                echo'<li class="star-icon" data-avaliacao="3"></li>';
                                                echo'<li class="star-icon" data-avaliacao="4"></li>';
                                                echo'<li class="star-icon" data-avaliacao="5"></li>';
                                            echo'</ul>';
                                        echo'</div>';
                                        echo'<h2 class="book-title">'.$linha['titulo'].'</h2>';
                                    echo'</div>';
                                echo'</div>';   
                            echo'</div>';
                        }
                    }
                    ?>
            </section>
        </div>
    </main>
    <script>
        let search_input = document.querySelector(".search-input")
        search_input.addEventListener("click", () => {
            let search_focus = document.querySelector(".search-focus")
            let css_afterFocus = window.getComputedStyle(search_focus, "::after")
            let search_img = document.querySelector("#search-img")
            focusInterval = setInterval(() => {
                if (search_input.value != "") {
                    search_focus.style.setProperty("--translate-focus", "-15px")
                    search_focus.style.setProperty("--font-focus", "1.2em")
                    search_img.style.width = "18px"
                    search_img.style.translate = "10px -15px"
                }
                else {
                    search_focus.style.setProperty("--translate-focus", "0px")
                    search_focus.style.setProperty("--font-focus", "1.5em")
                }

                if (css_afterFocus.translate != "0px") {
                    search_img.style.width = "18px"
                    search_img.style.translate = "10px -15px"
                }
                else {
                    search_img.style.width = "25px"
                    search_img.style.translate = "0px 0px"
                }
            }, 100)
        })
    </script>
    <script src="../js/slider.js"></script>
    <script src="../js/navbar.js"></script>
</body>
</html>