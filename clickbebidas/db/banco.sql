DROP DATABASE db_cliente;
CREATE DATABASE IF NOT EXISTS `db_cliente` DEFAULT CHARACTER SET utf8 ;
USE `db_cliente` ;

-- -----------------------------------------------------
-- Table `db_cliente`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cliente`.`USUARIO` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(45) NULL,
  `email` VARCHAR(100) NULL,
  `sobrenome` VARCHAR(45) NULL,
  `perfil` VARCHAR(1) NULL,
  `senha` VARCHAR(32) NULL);


-- -----------------------------------------------------
-- Table `db_cliente`.`PERFIL`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cliente`.`PERFIL` (
  `ID_PERFIL` INT NOT NULL AUTO_INCREMENT,
  `DRESCICAO` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_PERFIL`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_cliente`.`LOGIN`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_cliente`.`LOGIN` (
  `ID_LOGIN` INT NOT NULL AUTO_INCREMENT,
  `USER` VARCHAR(45) NULL,
  `SENHA` VARCHAR(80) NULL,
  `ID_PERFIL` INT NULL,
  `ID_USUARIO` INT NULL,
  PRIMARY KEY (`ID_LOGIN`),
  INDEX `FK_ID_PERFIL_LOGIN_idx` (`ID_PERFIL` ASC) ,
  INDEX `FK_ID_USUARIO_PERFIL_idx` (`ID_USUARIO` ASC) ,
  CONSTRAINT `FK_ID_PERFIL_LOGIN`
    FOREIGN KEY (`ID_PERFIL`)
    REFERENCES `db_cliente`.`PERFIL` (`ID_PERFIL`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ID_USUARIO_PERFIL`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `db_cliente`.`USUARIO` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    categoria VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS `db_cliente`.`compras` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_usuario` INT NOT NULL,
    `data_compra` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`id_usuario`) REFERENCES `USUARIO`(`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `db_cliente`.`itens_compra` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_compra` INT NOT NULL,
    `id_produto` INT NOT NULL,
    `quantidade` INT NOT NULL,
    FOREIGN KEY (`id_compra`) REFERENCES `compras`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_produto`) REFERENCES `produtos`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
