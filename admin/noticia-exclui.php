<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();


?>