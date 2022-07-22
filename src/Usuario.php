<?php
namespace Microblog;
use PDO, Exception;

final class Usuario{
    private int $id;
    private  string $nome;
    private string $email;
    private string $senha;
    private string $tipo;

    //O método construtor funciona no momento em que o objeto é criado
    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }

    public function listar(){
        $sql = "SELECT id, nome, email, tipo FROM usuarios ORDER BY nome";
    

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die ("Erro: ". $erro->getMessage());
    }
    return $resultado;
}
}