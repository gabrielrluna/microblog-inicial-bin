<?php


use Microblog\ControleDeAcesso;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();


$sessao = new ControleDeAcesso;
$sessao->verificaAcessoAdmin();
?>