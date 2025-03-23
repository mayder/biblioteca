-- MySQL Workbench Synchronization
-- Generated: 2025-03-22 20:19
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Breno Mayder

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `biblioteca`.`livro_assunto` 
ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT 1 AFTER `assunto_id`,
ADD COLUMN `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`,
ADD COLUMN `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `data_cadastro`;

ALTER TABLE `biblioteca`.`livro_autor` 
ADD COLUMN `tipo_autor_id` INT(11) NOT NULL AFTER `autor_id`,
ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT 1 AFTER `tipo_autor_id`,
ADD COLUMN `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`,
ADD COLUMN `data_alteracao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `data_cadastro`,
ADD INDEX `fk_livro_autor_tipo_autor1_idx` (`tipo_autor_id` ASC) VISIBLE;
;

CREATE TABLE IF NOT EXISTS `biblioteca`.`tipo_autor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

ALTER TABLE `biblioteca`.`livro_autor` 
ADD CONSTRAINT `fk_livro_autor_tipo_autor1`
  FOREIGN KEY (`tipo_autor_id`)
  REFERENCES `biblioteca`.`tipo_autor` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
