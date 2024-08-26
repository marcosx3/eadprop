<?php

$routes = array(
    "" => "LoginController@index",
    "/" => "LoginController@index",
    "entrar" => "loginController@entrar",
    "cadastrar-se" => "loginController@cadastraView",
    "cadastro-usuario" => "PessoaController@cadastroUsuario",
    "home" => "HomeController@index",
    "teste/:id" => "HomeController@teste"
);