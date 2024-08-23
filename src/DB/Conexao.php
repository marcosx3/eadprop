<?php

namespace App\DB;

use Exception;
use PDO;
use PDOException;

class Conexao {

    var $c_servidor = "localhost";
    var $c_bancodedados = "sistemaprospen";
    var  $c_usuario = "sistemaprospen";
    var  $c_senha = "326157";

   var $conexao;
    function conectar() {
        try {
            $dsn = "mysql:host={$GLOBALS["c_servidor"]};dbname={$GLOBALS["c_bancodedados"]}";
            $this->conexao = new PDO($dsn, $GLOBALS["c_usuario"], $GLOBALS["c_senha"]);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->exec("SET NAMES utf8");
            return $this->conexao;
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    function fechar() {
        $this->conexao = null;
    }
    function executar($sql) {
        try {
            $this->conexao->exec($sql);
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * Summary of tabela
     * @param mixed $sql
     * @param mixed $params
     * @return array
     * Exemplo: $sql = "SELECT * FROM tabela WHERE campo = :valor";
     * $params = array('valor' => 'exemplo');
     * $resultados = $this->tabela($sql, $params);
     */
    function tabela($sql, $params = array()) {  
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    function valor($tab, $col, $cnd = "") {
        $conexao = $this->conexao;
        $sql = "SELECT :col AS CAMPO FROM :tab";
        $params = array('col' => strtoupper($col), 'tab' => strtoupper($tab));
        
        if (strlen($cnd) > 0) {
            $sql .= " WHERE :cnd";
            $params['cnd'] = strtoupper($cnd);
        }
        try {
            $stmt = $conexao->prepare($sql);
            $stmt->execute($params);
            
            if ($stmt->rowCount() > 0) {
                $linha = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!is_null($linha["CAMPO"])) {
                    return $linha["CAMPO"];
                } else {
                    return "";
                }
            } else {
                return "";
            }
        } catch (PDOException $e) {
            throw new PDOException("Erro ao executar consulta: " . $e->getMessage(), $e->getCode());
        }
    }

    function executar_multiplos($sql) {
        $conexao = $this->conexao;
        $queries = explode(';', $sql);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $stmt->closeCursor();
            }
        }
    }

    function executar_multiplos_partes($sql, $maxComandos = 200) {
        $conexao = $this->conexao;
        $comandos = explode(";", $sql);
        $totalComandos = count($comandos);
        $divisoes = ceil($totalComandos / $maxComandos);
        for ( $i = 0; $i < $divisoes; $i++ ) {
            $comandosAtuais = array_slice($comandos, $i * $maxComandos, min(($i + 1) * $maxComandos, $totalComandos));
            foreach ( $comandosAtuais as $query ) {
                $query = trim($query);
                if (!empty($query)) {
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $stmt->closeCursor();
                }
            }
        }
    }

}
