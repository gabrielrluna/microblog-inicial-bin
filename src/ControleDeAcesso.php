<?php
namespace Microblog;

final class ControleDeAcesso{
    public function __construct()
    {
        // Se NÃO EXISTIR uma sessão em funcionamento
        if(!isset($_SESSION)){
            // Então iniciamos a sessão 
            session_start();
        }
    }

    public  function verificaAcesso():void {
        // Se não existir uma variável de sessão relacionada ao id do usuário logado...
        if(!isset($_SESSION['id'])){
            // Então significa que o usuário não está logado. Portanto, apague qualquer resquício de sessão e fore o usuário a ir para login.php
            session_destroy();
            header("location:../login.php?acesso_proibido");
            die(); //exit
        }
        
    }

    public function verificaAcessoAdmin():void{
        if($_SESSION['tipo'] != 'admin'){
            header("location:nao-autorizado.php");
        }
    }
    
    public function login(int $id, string $nome, string $tipo):void{
        // No momento em que ocorrer o login, adicionamos à sessão variáveis de sessão contendo os dados necessários para o sistema 
        $_SESSION ['id'] = $id;
        $_SESSION ['nome'] = $nome;
        $_SESSION ['tipo'] = $tipo;
    }

    public function logout():void{
        session_start();
        session_destroy();
        header("location:../login.php?logout");
        exit;
    }

    public function expirar():void{
        session_start();
        if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 10)) {
            session_unset(); 
            session_destroy(); 
            echo "session destroyed"; 
        }
        $_SESSION['start'] = time();
    }
}