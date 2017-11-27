-- MySQL Script generated by MySQL Workbench
-- 03/16/17 21:22:31
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sge
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sge
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sge` DEFAULT CHARACTER SET utf8 ;
USE `sge` ;

-- -----------------------------------------------------
-- Table `sge`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sge`.`user` (
  `user_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;