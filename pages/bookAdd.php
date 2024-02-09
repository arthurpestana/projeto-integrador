<?php 
include('config.php');
session_start();
if($_SESSION['admLoggedIn'] != 1 || empty($_SESSION['admLoggedIn'])){
    header('Location: login.php');
}
unset($_SESSION['edit']);
$_SESSION['edit']=htmlspecialchars($_GET['id']);
if(!empty($_SESSION['edit'])){
    $sql="select * from cadastro_geral where id_cadastro_geral=".$_SESSION['edit']."";
    $consulta=mysqli_query($conexao, $sql);
    $linha=mysqli_fetch_array($consulta);

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
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicação - Atlântida</title>
    <link rel="stylesheet" href="../css/bookadd.css">
    <link rel="shortcut icon" href="../images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <form class="adm__form" name="adm__form" method="POST" action="func.adm.php" enctype="multipart/form-data">
            <div class="form__header">
                <h1>Cadastro de Livros</h1>
            </div>
            <div class="form__grid">
                <div class="form__img">
                    <input type="file" name="file-input" id="file-input" accept="image/*">
                    <label for="file-input"><img src="../images/download-outline.svg" alt="" width="20px" height="20px">&nbsp;Escolha uma imagem...</label>
                    <span id="file-name"><?php if(!empty($_SESSION['edit'])){echo '../'.$linha['imagens'].'';}else{echo 'Nenhum arquivo selecionado...';} ?></span>
                </div>
                <div class="form__box1">
                    <div class="form__title">
                        <input type="text" name="title" id="title" class="input-form" value="<?php echo $linha['titulo']; ?>" required>
                        <span class="input-focus" data-placeholder="Título"></span>
                    </div>
                    <div class="form__type">
                        <div class="type__dropdown">
                            <div class="dropdown--active" name="type__active">
                                <input class="option__active" value="<?php if(!empty($_SESSION['edit'])){echo $tipo_cadastro['descricao'];}else{echo 'Tipo';} ?>" name="type_active" readonly>
                                <img src="../images/chevron-down-outline.svg" alt="">
                            </div>
                            <div class="dropdown__display">
                            <?php 
                            $sql="select * from tipo_cadastro";
                            $consulta=mysqli_query($conexao, $sql);
                            while($conteudo=mysqli_fetch_array($consulta)){
                                if ((!empty($conteudo))){
                                    echo '<div class="dropdown__option">'.$conteudo['descricao'].'</div>';
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__box2">
                    <div class="form__extra">
                        <input type="text" name="extra" id="extra" class="input-form" value="<?php echo $linha['extra']; ?>" required>
                        <span class="input-focus" data-placeholder="Extra"></span>
                    </div>
                    <div class="form__edit">
                        <div class="edit__dropdown">
                            <div class="dropdown--active" name="edit__active">
                                <input class="option__active" value="<?php if(!empty($_SESSION['edit'])){echo $editora_descricao['descricao'];}else{echo 'Editora';} ?>" name="edit_active" readonly>
                                <img src="../images/chevron-down-outline.svg" alt="">
                            </div>
                            <div class="dropdown__display">
                            <?php 
                            $sql="select * from editora";
                            $consulta=mysqli_query($conexao, $sql);
                            while($conteudo=mysqli_fetch_array($consulta)){
                                if ((!empty($conteudo))){
                                    echo '<div class="dropdown__option">'.$conteudo['descricao'].'</div>';
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__box3">
                    <div class="form__autor">
                        <input type="text" name="autor" id="autor" class="input-form" value="<?php echo $linha['autores']; ?>" required>
                        <span class="input-focus" data-placeholder="Autor"></span>
                    </div>
                    <div class="form__edit">
                        <div class="edit__dropdown">
                            <div class="dropdown--active" name="categ__active">
                                <input class="option__active" value="<?php if(!empty($_SESSION['edit'])){echo $categoria['descricao'];}else{echo 'Categoria';} ?>" name="categ_active" readonly>
                                <img src="../images/chevron-down-outline.svg" alt="">
                            </div>
                            <div class="dropdown__display">
                            <?php 
                            $sql="select * from categoria";
                            $consulta=mysqli_query($conexao, $sql);
                            while($conteudo=mysqli_fetch_array($consulta)){
                                if ((!empty($conteudo))){
                                    echo '<div class="dropdown__option">'.$conteudo['descricao'].'</div>';
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__box4">
                    <div class="form__colec">
                        <input type="text" name="colec" id="colec" class="input-form" value="<?php echo $linha['colecao_volume']; ?>" required>
                        <span class="input-focus" data-placeholder="Coleção"></span>
                    </div>
                    <div class="form__class">
                        <input type="text" name="class" id="class" class="input-form" value="<?php echo $linha['classificacao']; ?>" required>
                        <span class="input-focus" data-placeholder="Classificação"></span>
                    </div>
                </div>
                <div class="form__box5">
                    <div class="form__nums">
                        <div class="form__edicao">
                            <input type="number" name="edicao" id="edicao" class="input-form" value="<?php echo $linha['edicao']; ?>" required>
                            <span class="input-focus" data-placeholder="Edição"></span>
                        </div>
                        <div class="form__year">
                            <input type="number" name="ano" id="ano" class="input-form" value="<?php echo $linha['ano']; ?>" required>
                            <span class="input-focus" data-placeholder="Ano"></span>
                        </div>
                    </div>
                    <div class="form__bar">
                        <input type="number" name="barras" id="barras" class="input-form" value="<?php echo $linha['codigo_barras']; ?>" required>
                        <span class="input-focus" data-placeholder="Código de Barras"></span>
                    </div>
                </div>
                <div class="form__box6">
                    <div class="form__isbn">
                        <input type="number" name="isbn" id="isbn" class="input-form" value="<?php echo $linha['num_isbn']; ?>" required>
                        <span class="input-focus" data-placeholder="ISBN"></span>
                    </div>
                    <div class="form__idioma">
                        <input type="text" name="idioma" id="idioma" class="input-form" value="<?php echo $linha['idioma']; ?>" required>
                        <span class="input-focus" data-placeholder="Idioma"></span>
                    </div>
                </div>
                <div class="form__box7">
                    <div class="form__date">
                        <input type="date" name="input-date" id="input-date" formmethod="POST">
                    </div>
                    <div class="form__city">
                        <div class="city__dropdown">
                            <div class="dropdown--active" name="city__active">
                                <input class="option__active" name="city_active" value="<?php if(!empty($_SESSION['edit'])){echo $cidade['nome'];}else{echo 'Cidade';} ?>" readonly>
                                <img src="../images/chevron-down-outline.svg" alt="">
                            </div>
                            <div class="dropdown__display">
                            <?php 
                            $sql="select * from cidade";
                            $consulta=mysqli_query($conexao, $sql);
                            while($conteudo=mysqli_fetch_array($consulta)){
                                if ((!empty($conteudo))){
                                    echo '<div class="dropdown__option">'.$conteudo['nome'].'</div>';
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__box8">
                    <div class="form__assunto">
                        <label for="area-assunto">Assunto do Livro</label>
                        <textarea name="area-assunto" id="area-assunto"><?php echo $linha['assunto']; ?></textarea>
                    </div>
                    <div class="form__coment">
                        <label for="area-coment">Comentários sobre o Livro</label>
                        <textarea name="area-coment" id="area-coment"><?php echo $linha['comentario']; ?></textarea>
                    </div>
                </div>
                <div class="form__box9">
                    <div class="form__resenha">
                        <label for="area-resenha">Resenha do Livro</label>
                        <textarea name="area-resenha" id="area-resenha"><?php echo $linha['resenha']; ?></textarea>
                    </div>
                </div>
                <div class="form__box10">
                    <input type="submit" id="submit-btn" value="<?php if(!empty($_SESSION['edit'])){echo 'Editar';}else{echo 'Adicionar';} ?>">
                </div>
            </div>
        </form>
    </main>
    <script src="../js/image-file.js"></script>
    <script src="../js/dropdown.js"></script>
    <script>
        let input_form = document.querySelectorAll(".input-form")
        let focusInfinite = setInterval(() => {
            for (let i=0; i<input_form.length; i++) {
                let input_focus = document.querySelectorAll(".input-focus")
                focusInterval = setInterval(() => {
                    if (input_form[i].value != "") {
                        input_focus[i].style.setProperty("--translate-focus", "-25px")
                        input_focus[i].style.setProperty("--font-focus", "15px")
                    }
                    else {
                        input_focus[i].style.setProperty("--translate-focus", "0px")
                        input_focus[i].style.setProperty("--font-focus", "18px")
                    }
                }, 100)
            }
        }, 10)
    </script>
    <script src="../js/user-dropdown.js"></script>
</body>
</html>