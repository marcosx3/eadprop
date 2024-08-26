<?php

namespace App\Controller;

class LoginController {

    public function index() {
        require_once '../View/login-view.php';
    }

    public function cadastraView() {
        require_once '../View/cadastro-view.php';
    }
    public function entrar() {
        require_once '../View/entrar.php';
    }
}