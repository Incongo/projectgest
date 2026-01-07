-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ProjectGest
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ProjectGest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ProjectGest` DEFAULT CHARACTER SET utf8 ;
USE `ProjectGest` ;

-- -----------------------------------------------------
-- Table `ProjectGest`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProjectGest`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProjectGest`.`proyecto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProjectGest`.`proyecto` (
  `proyecto_id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NULL,
  `descripcion` VARCHAR(255) NULL,
  `tareas` VARCHAR(255) NULL,
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`proyecto_id`),
  INDEX `fk_proyecto_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_proyecto_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `ProjectGest`.`usuario` (`usuario_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProjectGest`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProjectGest`.`estado` (
  `estado_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  PRIMARY KEY (`estado_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProjectGest`.`tarea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProjectGest`.`tarea` (
  `tarea_id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NULL,
  `descripcion` VARCHAR(255) NULL,
  `usuario_id` INT NOT NULL,
  `comentario` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `estado_id` INT NOT NULL,
  `proyecto_id` INT NOT NULL,
  PRIMARY KEY (`tarea_id`),
  INDEX `fk_tarea_usuario_idx` (`usuario_id` ASC),
  INDEX `fk_tarea_estado1_idx` (`estado_id` ASC),
  INDEX `fk_tarea_proyecto1_idx` (`proyecto_id` ASC),
  CONSTRAINT `fk_tarea_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `ProjectGest`.`usuario` (`usuario_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tarea_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `ProjectGest`.`estado` (`estado_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tarea_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `ProjectGest`.`proyecto` (`proyecto_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
