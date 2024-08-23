<?php
namespace App\Model;

class Categoria {

    private $id;
    private $nome;
    private $dsc;
    private $sts;

    public function __construct($nome, $dsc ) {
        $this->nome = $nome;
        $this->dsc = $dsc;
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
   
    public function getDescricao() {
        return $this->dsc;
    }

    public function setDescricao($dsc) {
        $this->dsc = $dsc;
    }
    public function getId() {
        return $this->id;
    }
} 