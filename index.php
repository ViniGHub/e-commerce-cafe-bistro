<?php

require_once 'src/conexao-bd.php';

$produtosCafe = $pdo->query(mb_convert_encoding('SELECT * FROM produtos WHERE tipo = \'Café\'', 'UTF-8'))->fetchAll(PDO::FETCH_ASSOC);


$produtosAlmoco = [
    [
        'nome' => 'Bife',
        'descricao' => 'Bife, arroz com feijão e uma deliciosa batata frita.',
        'preco' => 'R$ 27.90',
        'imagem' => 'img/bife.jpg'
    ],
    [
        'nome' => 'Filé de peixe',
        'descricao' => 'Filé de peixe salmão assado, arroz, feijão verde e tomate.',
        'preco' => 'R$ 24.99',
        'imagem' => 'img/prato-peixe.jpg'
    ],
    [
        'nome' => 'Frango',
        'descricao' => 'Saboroso frango à milanesa com batatas fritas, salada de repolho e molho picante.',
        'preco' => 'R$ 23.00',
        'imagem' => 'img/prato-frango.jpg'
    ],
    [
        'nome' => 'Fettuccine',
        'descricao' => 'Prato italiano autêntico da massa do fettuccine com peito de frango grelhado.',
        'preco' => 'R$ 22.50',
        'imagem' => 'img/fettuccine.jpg'
    ],
    [
        'nome' => 'LentrecoTodas',
        'descricao' => 'Bom demais véi segura pai.',
        'preco' => 'R$ 70.99',
        'imagem' => 'img/lentrancia.jfif'
    ],
];


// $produtosCafe = ;
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>

<body>
    <!-- <div style="position: absolute; background: red; width: 4px; height:200vh; left: 50%; transform: translateX(-50%);"></div> -->

    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
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
                foreach ($produtosCafe as $cafe) { ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="img/<?= mb_convert_encoding($cafe['IMAGEM'], 'UTF-8') ?>">
                        </div>
                        <p><?= mb_convert_encoding($cafe['NOME'], "UTF-8") ?></p>
                        <p><?= mb_convert_encoding($cafe['DESCRICAO'], "UTF-8") ?></p>
                        <p> <?= mb_convert_encoding($cafe['PRECO'], "UTF-8") ?></p>
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
                foreach ($produtosAlmoco as $almoco) { ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="<?= $almoco['imagem'] ?>">
                        </div>
                        <p><?= $almoco['nome'] ?></p>
                        <p><?= $almoco['descricao'] ?></p>
                        <p><?= $almoco['preco'] ?></p>
                    </div>
                <?php
                } ?>
            </div>

        </section>
    </main>
</body>

</html>