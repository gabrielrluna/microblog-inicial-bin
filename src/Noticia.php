<?php

namespace Microblog;
use PDO, Exception;

final class Noticia{
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private int $categoriaId;

    // Criando uma propriedade do tipo Usuario, ou seja, a partir de uma classe que criamos com o objetivo de reutilizar recursos dela. Isso permitirá fazer uma associação entre as classes
    public Usuario $usuario;

    private PDO $conexao;

    public function __construct(){
        /*No momento em que o objeto "noticia" for instanciado nas páginas, aproveitaremos para também instanciar um objeto Usuario e com isso acessar recursos desta classe*/
        $this->usuario = new Usuario;
        $this->conexao = $this->usuario->getConexao();
    }


    public function inserir():void{
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuarios_id, categorias_id) VALUES (:titulo, :texto, :resumo, :imagem, :destaque, :usuarios_id, :categorias_id)";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":titulo",$this->titulo, PDO::PARAM_STR);
            $consulta->bindParam(":texto",$this->texto, PDO::PARAM_STR);
            $consulta->bindParam(":resumo",$this->resumo, PDO::PARAM_STR);
            $consulta->bindParam(":imagem",$this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":destaque",$this->destaque, PDO::PARAM_STR);
            $consulta->bindParam(":categorias_id",$this->categoriaID, PDO::PARAM_INT);
            $consulta->bindValue(":usuarios_id",$this->usuario->getId(), PDO::PARAM_INT);
            
            // BINDVALUE: Aqui, primeiro chamamos o getter de ID a partir do objeto/classe de Usuario. E só depois atribuimos ele ao parâmetro :usuario_id usando para isso o bindValue. Obs.: bindParam pode ser usado, mas há riscos de erro devido a forma como ele é executado pelo PHP. Por isso, recomenda-se o uso do bindValue em situações como essa.
            
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die ("Erro: ". $erro->getMessage());
        }
    }




    public function listar(){
        $sql = "SELECT id, data, titulo, texto, resumo, imagem, destaque, categoriaId FROM noticias ORDER BY data";
    

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die ("Erro: ". $erro->getMessage());
    }
    return $resultado;
}



    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }


    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function setTitulo(string $titulo)
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getTexto(): string
    {
        return $this->texto;
    }
    public function setTexto(string $texto)
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getResumo(): string
    {
        return $this->resumo;
    }
    public function setResumo(string $resumo)
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getDestaque(): string
    {
        return $this->destaque;
    }
    public function setDestaque(string $destaque)
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }
    public function setImagem(string $imagem)
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }
    public function setCategoriaId(int $categoriaId)
    {
        $this->categoriaId = filter_var($categoriaId, FILTER_SANITIZE_NUMBER_INT);
    }
}

