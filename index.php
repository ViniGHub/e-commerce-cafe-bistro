<?php

require_once 'vendor/autoload.php';
require_once 'src/conexao-bd.php';

use Alura\Cafe\Repo\ProdutoRepo;


/** @var PDO $pdo */

$produtosRepo = new ProdutoRepo($pdo);

$dadosCafe = $produtosRepo->produtosCafe();

$dadosAlmoco = $produtosRepo->produtosAlmoco();

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet"> -->
    <title>Serenatto - Cardápio</title>
</head>

<body>
    <!-- <div style="position: absolute; background: red; width: 4px; height:200vh; left: 50%; transform: translateX(-50%);"></div> -->

    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <a href="admin.php">
                    <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
                </a>
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php
                foreach ($dadosCafe as $cafe) { ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="<?= $cafe->getImgDirectory() ?>">
                        </div>
                        <p><?= $cafe->getNome() ?></p>
                        <p><?= $cafe->getDescricao() ?></p>
                        <p><?= $cafe->getPrecoFormat() ?></p>
                    </div>
                <?php
                } ?>
            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php
                foreach ($dadosAlmoco as $almoco) { ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="<?= $almoco->getImgDirectory() ?>">
                        </div>
                        <p><?= $almoco->getNome() ?></p>
                        <p><?= $almoco->getDescricao() ?></p>
                        <p><?= $almoco->getPrecoFormat() ?></p>
                    </div>
                <?php
                } ?>
            </div>

        </section>
    </main>
</body>

</html>