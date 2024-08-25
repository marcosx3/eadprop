<?php
namespace App\DAO;

use App\DB\Conexao;
use App\Model\Categoria;
use PDO;
use PDOException;

class CategoriaDAO {
    private $conn;

    public function __construct() {
        $conn = new Conexao();
        $this->conn = $conn->conectar();
    }

    // Método para criar uma nova categoria
    public function create(Categoria $categoria) {
        try {
            $query = "INSERT INTO TB_CATEGORIAS (NOM_CATEGORIA, DSC_CATEGORIA) VALUES (:nome, :dsc)";
            $stmt = $this->conn->prepare($query);

            // Armazena os valores em variáveis
            $nome = $categoria->getNome();
            $dsc = $categoria->getDescricao();

            // Usa as variáveis para o bindParam
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dsc', $dsc);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao criar categoria: " . $e->getMessage();
            return false;
        }
    }

    // Método para ler todas as categorias
    public function read() {
        try {
            $query = "SELECT * FROM TB_CATEGORIAS";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, Categoria::class);
        } catch (PDOException $e) {
            echo "Erro ao ler categorias: " . $e->getMessage();
            return [];
        }
    }

    // Método para atualizar uma categoria
    public function update(Categoria $categoria) {
        try {
            $query = "UPDATE TB_CATEGORIAS SET NOM_CATEGORIA = :nome, DSC_CATEGORIA = :dsc WHERE COD_CATEGORIA = :id";
            $stmt = $this->conn->prepare($query);
            // Armazena os valores em variáveis
            $id = $categoria->getId();
            $nome = $categoria->getNome();
            $dsc = $categoria->getDescricao();

            // Usa as variáveis para o bindParam
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dsc', $dsc);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar categoria: " . $e->getMessage();
            return false;
        }
    }

    // Método para deletar uma categoria
    public function delete($id) {
        try {
            $query = "DELETE FROM TB_CATEGORIAS WHERE COD_CATEGORIA = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao deletar categoria: " . $e->getMessage();
            return false;
        }
    }

    // Método para encontrar uma categoria por ID
    public function findById($id) {
        try {
            $query = "SELECT * FROM TB_CATEGORIAS WHERE COD_CATEGORIA = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Categoria::class);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar categoria por ID: " . $e->getMessage();
            return null;
        }
    }
}
