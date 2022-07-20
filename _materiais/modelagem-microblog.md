```sql
CREATE TABLE usuarios(
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    senha VARCHAR (255) NOT NULL,
    tipo ENUM('admin','editor') NOT NULL UNIQUE
)
```

```sql
CREATE TABLE noticias(
    id MEDIUMINT NOT NULL PRIMARY KEY AUTO_INCREMENT, VARCHAR(45) NOT NULL,
    data DATETIME,
    titulo VARCHAR(150) NOT NULL,
    texto TEXT NOT NULL,
    resumo TINYTEXT NOT NULL,
    imagem VARCHAR(45),
    destaque ENUM('sim','nao'),
    usuarios_id SMALLINT NULL,
    categorias_id TINYINT NULL
)
```

```sql
CREATE TABLE categorias(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL
)
```
```sql

ALTER TABLE noticias
    ADD CONSTRAINT fk_noticias_usuarios

    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id)
```
```sql

ALTER TABLE noticias
    ADD CONSTRAINT fk_noticias_categorias

    FOREIGN KEY (categorias_id) REFERENCES categorias(id)
```