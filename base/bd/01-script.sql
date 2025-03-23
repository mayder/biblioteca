-- MySQL Workbench Synchronization
-- Generated: 2025-03-21 19:54
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Breno Mayder

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `biblioteca`.`livro` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` CHAR(36) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `situacao_id` INT(11) NOT NULL,
  `editora_id` INT(11) NOT NULL,
  `edicao` INT(11) NOT NULL,
  `ano_publicacao` YEAR NOT NULL,
  `valor_recomendado` DECIMAL(10,2) NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_livro_editora1_idx` (`editora_id` ASC) VISIBLE,
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC) VISIBLE,
  INDEX `fk_livro_situacao1_idx` (`situacao_id` ASC) VISIBLE,
  CONSTRAINT `fk_livro_editora1`
    FOREIGN KEY (`editora_id`)
    REFERENCES `biblioteca`.`editora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_situacao1`
    FOREIGN KEY (`situacao_id`)
    REFERENCES `biblioteca`.`situacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`autor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` CHAR(36) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `data_nascimento` DATE NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`assunto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` CHAR(36) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `sigla` VARCHAR(20) NULL DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`livro_assunto` (
  `livro_id` INT(11) NOT NULL,
  `assunto_id` INT(11) NOT NULL,
  INDEX `fk_livro_assunto_livro1_idx` (`livro_id` ASC) VISIBLE,
  INDEX `fk_livro_assunto_assunto1_idx` (`assunto_id` ASC) VISIBLE,
  UNIQUE INDEX `uq_livro_assunto` (`livro_id` ASC, `assunto_id` ASC) VISIBLE,
  PRIMARY KEY (`livro_id`, `assunto_id`),
  CONSTRAINT `fk_livro_assunto_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `biblioteca`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_assunto_assunto1`
    FOREIGN KEY (`assunto_id`)
    REFERENCES `biblioteca`.`assunto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`livro_autor` (
  `livro_id` INT(11) NOT NULL,
  `autor_id` INT(11) NOT NULL,
  INDEX `fk_livro_autor_livro_idx` (`livro_id` ASC) VISIBLE,
  INDEX `fk_livro_autor_autor1_idx` (`autor_id` ASC) VISIBLE,
  UNIQUE INDEX `uq_livro_autor` (`livro_id` ASC, `autor_id` ASC) VISIBLE,
  PRIMARY KEY (`autor_id`, `livro_id`),
  CONSTRAINT `fk_livro_autor_livro`
    FOREIGN KEY (`livro_id`)
    REFERENCES `biblioteca`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_autor_autor1`
    FOREIGN KEY (`autor_id`)
    REFERENCES `biblioteca`.`autor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`editora` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uuid` CHAR(36) NOT NULL,
  `razao_social` VARCHAR(100) NOT NULL,
  `cnpj` CHAR(14) NOT NULL,
  `nome_fantasia` VARCHAR(45) NULL DEFAULT NULL,
  `status` TINYINT(1) NOT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`situacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
