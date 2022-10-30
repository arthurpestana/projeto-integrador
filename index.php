<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./images/favicon.svg" type="image/x-icon">
    <title>Home - Atlântida</title>
</head>
<body>
    <header class="header">
        <nav class="header__nav">
            <div class="nav__links">
                <div class="nav__logo">
                    <a href="index.php"><img src="./images/atlantis-logo.png" alt="Atlantis Logo" id="logo-img"></a>
                </div>
                <a href="./pages/catalog.php">Catálogo</a>
                <a href="#">Sobre nós</a>
            </div>
            <div class="nav__account">
                <a href="./pages/login.php" id="login-btn">Login</a>
                <a href="./pages/register.php" id="register-btn">Registrar</a>
            </div>
        </nav>
    </header>
    <main class="main">
        <section class="main__content">
            <h1>Mergulhe nesse mar de livros!</h1>
            <p>Acesse o nosso catálogo e desbrave esse oceano profundo da literatura. Não esqueça de fornecer a sua própria review sobre um livro.</p>
            <a href="./pages/catalog.php">Catálogo</a>
            <div class="main__brands">
                <img src="./images/client-databiz.svg" alt="Cliente-DataBiz">
                <img src="./images/client-audiophile.svg" alt="Cliente-AudioPhile">   
                <img src="./images/client-maker.svg" alt="Cliente-Maker">
                <img src="./images/client-meet.svg" alt="Cliente-Meet">
            </div>
        </section>
        <section class="main__img">
            <img src="./images/image-books-desktop.png">
        </section>
    </main>
    <script src="./js/main.js"></script>
</body>
</html>