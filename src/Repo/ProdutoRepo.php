<?php

namespace Repo;

use Modelo\Produto;
use PDO;

class ProdutoRepo
{

    public function __construct(private PDO $pdo)
    {
    }

    /** @return Produto[] */
    public function produtosCafe(): array
    {
        $produtos = $this->pdo->query("SELECT * FROM produtos ORDER BY preco")->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_filter($produtos, function ($cafe) {
            if (str_starts_with($cafe['TIPO'], 'Ca')) {
                return $cafe;
            }
        });

        return $this->hydrate($dadosCafe);
    }

    /** @return Produto[] */
    public function produtosAlmoco(): array {
        $produtos = $this->pdo->query("SELECT * FROM produtos ORDER BY preco")->fetchAll(PDO::FETCH_ASSOC);

        $dadosAlmoco = array_filter($produtos, function ($almoco) {
            if (str_starts_with($almoco['TIPO'], 'Al')) {
                return $almoco;
            }
        });
        
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
}
