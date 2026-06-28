CREATE DATABASE IF NOT EXISTS sistema_compras_prod;

USE sistema_compras_prod;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cracha VARCHAR(30) NOT NULL UNIQUE,
    nivel_acesso ENUM('usuario', 'administrador') NOT NULL DEFAULT 'usuario',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    categoria_id INT NOT NULL,
    quantidade DECIMAL(10,2) DEFAULT 0,
    unidade_medida VARCHAR(50) NOT NULL,
    valor_referencia DECIMAL(10,2) DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE solicitacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_solicitacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('em_espera', 'aprovado', 'reprovado') NOT NULL DEFAULT 'em_espera',
    usuario_id INT NOT NULL,
    item_id INT NOT NULL,
    quantidade DECIMAL(10,2) NOT NULL,
    turma VARCHAR(100) DEFAULT NULL,
    observacao TEXT DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

    FOREIGN KEY (item_id) REFERENCES itens(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

---------------------------------------------

