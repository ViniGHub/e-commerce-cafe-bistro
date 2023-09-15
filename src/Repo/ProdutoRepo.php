<?php

namespace Alura\Cafe\Repo;

use Alura\Cafe\Model\Produto;
use PDO;

class ProdutoRepo
{

    public function __construct(private PDO $pdo)
    {
    }

    /** @return Produto[] */
    public function produtosCafe(): array
    {
        $dadosCafe = $this->pdo->query("SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco")->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydrate($dadosCafe);
    }

    /** @return Produto[] */
    public function produtosAlmoco(): array {
        $dadosAlmoco = $this->pdo->query("SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco")->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->hydrate($dadosAlmoco);
    }

    /** @return Produto[] */
    public function all(): array  {
        $produtos = $this->pdo->query("SELECT * FROM produtos ORDER BY preco")->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydrate($produtos);
    }

    public function hydrate(array $array) : array
    {
        return array_map(function ($dado) {
            $dado['PRECO'] = str_replace(',', '.', $dado['PRECO']);
            return new produto($dado['ID'], $dado['TIPO'], $dado['NOME'], $dado['DESCRICAO'],floatval($dado['PRECO']), $dado['IMAGEM']);
        }, $array);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function save(Produto $prod): bool {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $prod->getTipo());
        $stmt->bindValue(2, $prod->getNome());
        $stmt->bindValue(3, $prod->getDescricao());
        $stmt->bindValue(4, str_replace('.', ',', $prod->getPreco()));
        $stmt->bindValue(5, $prod->getImagem());

        return $stmt->execute();
    }

    public function update(Produto $produto): bool {
        $stmt = $this->pdo->prepare("UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, imagem = ?, preco = ? WHERE id = ?");
        $stmt->bindValue(1, $produto->getTipo());
        $stmt->bindValue(2, $produto->getNome());
        $stmt->bindValue(3, $produto->getDescricao());
        $stmt->bindValue(4, $produto->getImagem());
        $stmt->bindValue(5, str_replace('.', ',', $produto->getPreco()));
        $stmt->bindValue(6, $produto->getId());
        
        return $stmt->execute();
    }

    public function find(int $id): Produto {

    $prod = $this->pdo->query("SELECT * FROM produtos WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

    return new Produto($prod['ID'], $prod['TIPO'], $prod['NOME'], $prod['DESCRICAO'], floatval(str_replace(',','.',$prod['PRECO'])), $prod['IMAGEM']);
}

}


