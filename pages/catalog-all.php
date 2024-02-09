<?php
include('config.php');

unset($_SESSION['admLoggedIn']);
unset($_SESSION['search-input']);

@$_SESSION['search-input']=(!empty($_POST['search-input'])?"titulo like '%".trim($_POST['search-input']."%'"):$_SESSION['search-input']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
            <form class="catalog__search" method="POST">
                <input type="text" name="search-input" class="search-input" OnClick="content.action='index.php'; content.submit()">
                <span class="search-focus" data-placeholder="Pesquisar"></span>
                <button><img src="../images/search-outline.svg" alt=""></button>
            </form>
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
        <div class="catalog__main">
            <section class="catalog__recommend">
                <div class="recommend__header">
                    <?php
                    $categ=htmlspecialchars($_GET['categ']);
                    $type=htmlspecialchars($_GET['type']);
                    $edit=htmlspecialchars($_GET['edit']);
                    if(!empty($_SESSION['consulta'])){
                        echo '<h1>Resultados da pesquisa</h1>';
                    }
                    else{
                        if(!empty($categ)){
                            $sql="select * from categoria where id_categoria=".$categ."";
                            $consulta_header=mysqli_query($conexao, $sql);
                        }
                        if(!empty($type)){
                            $sql="select * from tipo_cadastro where id_tipo_cadastro=".$type."";
                            $consulta_header=mysqli_query($conexao, $sql);
                        }
                        if(!empty($edit)){
                            $sql="select * from editora where id_editora=".$edit."";
                            $consulta_header=mysqli_query($conexao, $sql);
                        }
                        $array=mysqli_fetch_array($consulta_header);
                        echo '<h1>Todos de '.$array['descricao'].'</h1>';
                    }
                    ?>
                </div>
                <div class="catalog__best--flex">
                    <?php
                    if(!empty($_SESSION['consulta'])){
                        if(!empty($categ)){
                            $sql_generico="select * from cadastro_geral ".$_SESSION['consulta']." and cod_categoria=".$categ."";
                        }
                        if(!empty($type)){
                            $sql_generico="select * from cadastro_geral ".$_SESSION['consulta']." and cod_tipo_cadastro=".$type."";
                        }
                        if(!empty($edit)){
                            $sql_generico="select * from cadastro_geral ".$_SESSION['consulta']." and cod_editora=".$edit."";
                        }
                    }
                    else{
                        if(!empty($categ)){
                            $sql_generico="select * from cadastro_geral where cod_categoria=".$categ."";
                        }
                        if(!empty($type)){
                            $sql_generico="select * from cadastro_geral where cod_tipo_cadastro=".$type."";
                        }
                        if(!empty($edit)){
                            $sql_generico="select * from cadastro_geral where cod_editora=".$edit."";
                        }
                    }
                    $consulta_generico=mysqli_query($conexao, $sql_generico);
                    while($linha=mysqli_fetch_array($consulta_generico)){
                        if ((!empty($linha))){
                            echo'<div class="catalog__best--book">';
                            echo'<div class="best__book">';
                                echo'<img src="../'.$linha['imagens'].'" alt="Capa do Livro" class="book-img">';
                            echo'</div>';
                            echo'<div class="best__book-info">';
                                echo'<div class="book__header">';
                                    echo'<h2 class="book-title">'.$linha['titulo'].'</h2>';
                                echo'</div>';
                                echo'<div class="book-sub-info">';
                                    echo'<span>'.$linha['ano'].'</span>';
                                    echo'<span>'.$linha['classificacao'].'</span>';
                                    echo'<div class="book-star"><span>7.5</span><span class="star-icon" data-avaliacao="1"></span></div>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
    </main>
    <script>
        let input_form = document.querySelectorAll(".search-input")
        for (let i=0; i<input_form.length; i++) {
            input_form[i].addEventListener("click", () => {
                let input_focus = document.querySelectorAll(".search-focus")
                focusInterval = setInterval(() => {
                    if (input_form[i].value != "") {
                        input_focus[i].style.setProperty("--translate-focus", "-30px")
                        input_focus[i].style.setProperty("--font-focus", "0.9em")
                    }
                    else {
                        input_focus[i].style.setProperty("--translate-focus", "0px")
                        input_focus[i].style.setProperty("--font-focus", "1em")
                    }
                }, 100)
            })
        }
    </script>
    <script src="../js/user-dropdown.js"></script>
</body>
</html>