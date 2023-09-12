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

    public function hydrate(array $array) : array
    {
        return array_map(function ($dado) {
            $dado['PRECO'] = str_replace(',', '.', $dado['PRECO']);
            return new produto($dado['ID'], $dado['TIPO'], $dado['NOME'], $dado['DESCRICAO'], $dado['IMAGEM'], floatval($dado['PRECO']));
        }, $array);
    }
}