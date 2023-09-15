<?php

require_once 'vendor/autoload.php';
require_once 'src/conexao-bd.php';

use Alura\Cafe\Repo\ProdutoRepo;

$id = $_POST['id'];

var_dump($id);

$produtosRepo = new ProdutoRepo($pdo);

$produto = $produtosRepo->find($id);

if ($produto->getImagem() != 'logo-serenatto.png') {
    unlink($produto->getImgDirectory());
}

$produtosRepo->delete($id);


header('location: /admin.php');
