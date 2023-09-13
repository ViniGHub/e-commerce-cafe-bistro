<?php
use Repo\ProdutoRepo;

require_once 'src/conexao-bd.php';
require_once 'src/Model/Produto.php';
require_once 'src/Repo/ProdutoRepo.php';

$id = $_POST['id'];

$produtosRepo = new ProdutoRepo($pdo);

$produtosRepo->delete($id);

header('location: /admin.php');

?>