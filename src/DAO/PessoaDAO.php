<?php
namespace App\DAO;

use App\DB\Conexao;
use App\Model\Pessoa;
use PDO;
use PDOException;

class PessoaDAO {
    private $conn;

    public function __construct() {
        $conn = new Conexao();
        $this->conn = $conn->conectar();
    }

    // Método para criar um novo registro de Pessoa
    public function create(Pessoa $pessoa) {
        try {
            $query = "INSERT INTO TB_PESSOAS (NOM_PESSOA, DAT_NSC_PESSOA, CPF_PESSOA, CID_PESSOA, EST_PESSOA, STS_PESSOA) VALUES (:nome, :dat_nsc, :cpf, :cidade, :estado, :sts)";
            $stmt = $this->conn->prepare($query);
    
            // Armazena os valores em variáveis
            $nome = $pessoa->getNome();
            $dat_nsc = $pessoa->getDataNascimento();
            $cpf = $pessoa->getCpf();
            $cidade = $pessoa->getCidade();
            $estado = $pessoa->getEstado();
            $status = $pessoa->getStatus();
    
            // Usa as variáveis para o bindParam
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dat_nsc', $dat_nsc);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':sts', $status);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao criar pessoa: " . $e->getMessage();
            return false;
        }
    }
    

    // Método para ler todos os registros de Pessoa
    public function read() {
        try {
            $query = "SELECT * FROM TB_PESSOAS";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, Pessoa::class);
        } catch (PDOException $e) {
            echo "Erro ao ler pessoas: " . $e->getMessage();
            return [];
        }
    }

    // Método para atualizar um registro de Pessoa
    public function update(Pessoa $pessoa) {
        try {
            $query = "UPDATE TB_PESSOAS SET NOM_PESSOA = :nome, DAT_NSC_PESSOA = :dat_nsc, CPF_PESSOA = :cpf, CID_PESSOA = :cidade, EST_PESSOA = :estado, STS_PESSOA = : sts WHERE COD_PESSOA = :id";
            $stmt = $this->conn->prepare($query);

            // Armazena os valores em variáveis
            $nome = $pessoa->getNome();
            $dat_nsc = $pessoa->getDataNascimento();
            $cpf = $pessoa->getCpf();
            $cidade = $pessoa->getCidade();
            $estado = $pessoa->getEstado();
            $status = $pessoa->getStatus();
    
            // Usa as variáveis para o bindParam
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dat_nsc', $dat_nsc);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':sts', $status);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar pessoa: " . $e->getMessage();
            return false;
        }
    }

    // Método para deletar um registro de Pessoa
    public function delete($id) {
        try {
            $query = "DELETE FROM TB_PESSOAS WHERE COD_PESSOA = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao deletar pessoa: " . $e->getMessage();
            return false;
        }
    }

    // Método para encontrar uma pessoa por ID
    public function findById($id) {
        try {
            $query = "SELECT * FROM TB_PESSOAS WHERE COD_PESSOA = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Pessoa::class);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro ao buscar pessoa por ID: " . $e->getMessage();
            return null;
        }
    }
}
