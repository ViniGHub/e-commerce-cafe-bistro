<?php

use Repo\ProdutoRepo;

require_once 'src/conexao-bd.php';
require_once 'src/Model/Produto.php';
require_once 'src/Repo/ProdutoRepo.php';

$id = $_POST['id'];

var_dump($id);

$produtosRepo = new ProdutoRepo($pdo);

$produto = $produtosRepo->find($id);

if ($produto->getImagem() != 'logo-serenatto.png') {
    unlink($produto->getImgDirectory());
}

$produtosRepo->delete($id);



header('location: /admin.php');
