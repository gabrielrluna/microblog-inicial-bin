<?php
use Microblog\ControleDeAcesso;
use Microblog\Categoria;

require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

$sessao = new ControleDeAcesso;
$sessao->verificaAcessoAdmin();

$categoria = new Categoria;
$categoria->setId($_GET['id']);

$categoria->excluirCategoria();
header("location:categorias.php");
?>