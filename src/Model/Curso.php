<?php
namespace App\Model;

class Curso {
    private $nome;
    private $cod_categoria;
    private $desc;
    private $sts;
    private $aula1;
    private $aula2;
    private $aula3;
    private $aula4;
    private $aula5;
    private $id;

    /**
     * Construtor da classe Curso
     *
     * @param string $nome
     * @param int $cod_categoria
     * @param string $desc
     * @param string $sts
     * @param string $aula1
     * @param string $aula2
     * @param string $aula3
     * @param string $aula4
     * @param string $aula5
     */
    public function __construct($nome, $cod_categoria, $desc, $sts, $aula1, $aula2, $aula3, $aula4, $aula5) {
        $this->nome = $nome;
        $this->cod_categoria = $cod_categoria;
        $this->desc = $desc;
        $this->sts = $sts;
        $this->aula1 = $aula1;
        $this->aula2 = $aula2;
        $this->aula3 = $aula3;
        $this->aula4 = $aula4;
        $this->aula5 = $aula5;
    }

    /**
     * Métodos getters e setters
     */
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCodCategoria() {
        return $this->cod_categoria;
    }

    public function setCodCategoria($cod_categoria) {
        $this->cod_categoria = $cod_categoria;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getSts() {
        return $this->sts;
    }

    public function setSts($sts) {
        $this->sts = $sts;
    }

    public function getAula1() {
        return $this->aula1;
    }

    public function setAula1($aula1) {
        $this->aula1 = $aula1;
    }

    public function getAula2() {
        return $this->aula2;
    }

    public function setAula2($aula2) {
        $this->aula2 = $aula2;
    }

    public function getAula3() {
        return $this->aula3;
    }

    public function setAula3($aula3) {
        $this->aula3 = $aula3;
    }

    public function getAula4() {
        return $this->aula4;
    }

    public function setAula4($aula4) {
        $this->aula4 = $aula4;
    }

    public function getAula5() {
        return $this->aula5;
    }

    public function setAula5($aula5) {
        $this->aula5 = $aula5;
    }
}