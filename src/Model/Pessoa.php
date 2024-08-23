<?php
namespace App\Model;
class Pessoa {
    private $nome;
    private $dat_nsc;
    private $id;
    private $cpf;
    private $cidade;
    private $estado;
    private $status;


    /**
     * Construtor da classe Pessoa
     *
     * @param string $nome
     * @param string $dat_nsc
     * @param string $cpf
     * @param string $cidade
     * @param string $estado
     * @param string $status
     */
    public function __construct($nome, $dat_nsc, $cpf, $cidade, $estado, $status) {
        $this->nome = $nome;
        $this->dat_nsc = $dat_nsc;
        $this->cpf = $cpf;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->status = $status;
    }

    /**
     * Métodos getters e setters
     */
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDataNascimento() {
        return $this->dat_nsc;
    }

    public function setDataNascimento($dat_nsc) {
        $this->dat_nsc = $dat_nsc;
    }

    public function getId() {
        return $this->id;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}