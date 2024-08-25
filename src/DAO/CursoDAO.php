<?php
namespace App\DAO;

use App\DB\Conexao;
use App\Model\Curso;
use PDO;
use PDOException;

class CursoDAO {
    private $conn;

    public function __construct() {
        $conn = new Conexao();
        $this->conn = $conn->conectar();
    }

    // Método para criar um novo registro de Curso
    public function create(Curso $curso) {
        try {
            $query = "INSERT INTO TB_CURSOS (NOM_CURSO, COD_CATEGORIA, DSC_CURSO, AUL_LN1_CURSO, AUL_LN2_CURSO, AUL_LN3_CURSO, AUL_LN4_CURSO, AUL_LN5_CURSO) 
                      VALUES (:nome, :cod_categoria, :dsc, :aula1, :aula2, :aula3, :aula4, :aula5)";
            $stmt = $this->conn->prepare($query);

            // Armazena os valores em variáveis
            $nome = $curso->getNome();
            $cod_categoria = $curso->getCodCategoria();
            $desc = $curso->getDesc();
            $sts = $curso->getSts();
            $aula1 = $curso->getAula1();
            $aula2 = $curso->getAula2();
            $aula3 = $curso->getAula3();
            $aula4 = $curso->getAula4();
            $aula5 = $curso->getAula5();

            // Usa as variáveis para o bindParam
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cod_categoria', $cod_categoria);
            $stmt->bindParam(':dsc', $desc);
            $stmt->bindParam(':sts', $sts);
            $stmt->bindParam(':aula1', $aula1);
            $stmt->bindParam(':aula2', $aula2);
            $stmt->bindParam(':aula3', $aula3);
            $stmt->bindParam(':aula4', $aula4);
            $stmt->bindParam(':aula5', $aula5);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao criar curso: " . $e->getMessage();
            return false;
        }
    }

    // Método para ler todos os registros de Curso
    public function read() {
        try {
            $query = "SELECT * FROM TB_CURSOS";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, Curso::class);
        } catch (PDOException $e) {
            echo "Erro ao ler cursos: " . $e->getMessage();
            return [];
        }
    }

    // Método para atualizar um registro de Curso
    public function update(Curso $curso) {
        try {
            $query = "UPDATE TB_CURSOS SET NOM_CURSO = :nome, COD_CATEGORIA = :cod_categoria, DSC_CURSO = :dsc, 
                      AUL_LN1_CURSO = :aula1, AUL_LN2_CURSO = :aula2, AUL_LN3_CURSO = :aula3, AUL_LN4_CURSO = :aula4, AUL_LN5_CURSO = :aula5 
                      WHERE COD_CURSO = :id";
            $stmt = $this->conn->prepare($query);

            // Armazena os valores em variáveis
            $id = $curso->getId();
            $nome = $curso->getNome();
            $cod_categoria = $curso->getCodCategoria();
            $desc = $curso->getDesc();
            $sts = $curso->getSts();
            $aula1 = $curso->getAula1();
            $aula2 = $curso->getAula2();
            $aula3 = $curso->getAula3();
            $aula4 = $curso->getAula4();
            $aula5 = $curso->getAula5();

            // Usa as variáveis para o bindParam
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cod_categoria', $cod_categoria);
            $stmt->bindParam(':dsc', $desc);
            $stmt->bindParam(':aula1', $aula1);
            $stmt->bindParam(':aula2', $aula2);
            $stmt->bindParam(':aula3', $aula3);
            $stmt->bindParam(':aula4', $aula4);
            $stmt->bindParam(':aula5', $aula5);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar curso: " . $e->getMessage();
            return false;
        }
    }

    // Método para deletar um registro de Curso
    public function delete($id) {
        try {
            $query = "DELETE FROM TB_CURSOS WHERE COD_CURSO = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao deletar curso: " . $e->getMessage();
            return false;
        }
    }

    // Método para encontrar um curso por ID
    public function findById($id) {
        try {
            $query = "SELECT * FROM TB_CURSOS WHERE COD_CURSO = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Curso::class);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar curso por ID: " . $e->getMessage();
            return null;
        }
    }
}
