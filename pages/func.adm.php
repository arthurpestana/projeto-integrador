<?php
include('config.php');
$delete=htmlspecialchars($_GET['delete']);
$disconnect=htmlspecialchars($_GET['disconnect']);
if(!empty($disconnect)){
    unset($_SESSION['admLoggedIn']);
    header('Location: ../index.php');
}
if(!empty($delete)){
    $sql_generico = 'delete from `cadastro_geral` where `id_cadastro_geral`="'.$delete.'"';
    mysqli_query($conexao, $sql_generico);
    header("Location: adm.php");
}
else{
    $file='images/'.$_FILES['file-input']['name'].'';
    $titulo=$_POST['title'];
    $type=$_POST['type_active'];
    $extra=$_POST['extra'];
    $ed=$_POST['edit_active'];
    $autor=$_POST['autor'];
    $cat=$_POST['categ_active'];
    $colec=$_POST['colec'];
    $class=$_POST['class'];
    $edicao=$_POST['edicao'];
    $ano=$_POST['ano'];
    $barras=$_POST['barras'];
    $isbn=$_POST['isbn'];
    $idioma=$_POST['idioma'];
    $data=$_POST['date'];
    $cid=$_POST['city_active'];
    $assunto=$_POST['area-assunto'];
    $comentario=$_POST['area-coment'];
    $resenha=$_POST['area-resenha'];

    $tipo_cad='select * from tipo_cadastro where descricao="'.$type.'"';
    $tipo_consulta= mysqli_query($conexao, $tipo_cad);
    $tipo_id= mysqli_fetch_array($tipo_consulta);

    $editora='select * from editora where descricao="'.$ed.'"';
    $consulta_editora=mysqli_query($conexao, $editora);
    $editora_descricao=mysqli_fetch_array($consulta_editora);

    $categ='select * from categoria where descricao="'.$cat.'"';
    $consulta_categ=mysqli_query($conexao, $categ);
    $categoria=mysqli_fetch_array($consulta_categ);

    $city='select * from cidade where nome="'.$cid.'"';
    $consulta_city=mysqli_query($conexao, $city);
    $cidade=mysqli_fetch_array($consulta_city);

    $dir="../images";
    $img=$_FILES['file-input'];
    move_uploaded_file($img["tmp_name"], "$dir/".$img["name"]);
    if(empty($_SESSION['edit'])){
        $sql_generico= 'insert into cadastro_geral (`cod_tipo_cadastro`,`titulo`,`autores`,`cod_editora`,`edicao`,`ano`,`codigo_barras`,`num_isbn`,`cod_cidade`, 
        `idioma`,`aquisicao`,`cod_categoria`,`assunto`,`classificacao`,`colecao_volume`,`extra`,`resenha`,`comentario`,`imagens`,`usuario_id_user`) values 
        ("'.$tipo_id['id_tipo_cadastro'].'", "'.$titulo.'","'.$autor.'", "'.$editora_descricao['id_editora'].'", "'.$edicao.'", "'.$ano.'", "'.$barras.'", 
        "'.$isbn.'", "'.$cidade['id_cidade'].'", "'.$idioma.'", 4 , "'.$categoria['id_categoria'].'", "'.$assunto.'", "'.$class.'", "'.$colec.'", "'.$extra.'", "'.$resenha.'", 
        "'.$comentario.'", "'.$file.'", 0);';
        mysqli_query($conexao, $sql_generico);
        header("Location: adm.php");
    }
    else{
        $sql_generico = 'update cadastro_geral set cod_tipo_cadastro="'.$tipo_id['id_tipo_cadastro'].'", titulo="'.$titulo.'", autores="'.$autor.'", cod_editora="'.$editora_descricao['id_editora'].'",
        edicao="'.$edicao.'", ano="'.$ano.'", codigo_barras="'.$barras.'", num_isbn="'.$isbn.'", cod_cidade="'.$cidade['id_cidade'].'", idioma="'.$idioma.'", aquisicao="0", cod_categoria="'.$categoria['id_categoria'].'",
        assunto="'.$assunto.'", classificacao="'.$class.'", colecao_volume="'.$colec.'", extra="'.$extra.'", resenha="'.$resenha.'", comentario="'.$comentario.'", imagens="'.$file.'",
        usuario_id_user="0" where id_cadastro_geral="'.$_SESSION['edit'].'";';
        mysqli_query($conexao, $sql_generico);
        header("Location: adm.php");
    }
}
?>