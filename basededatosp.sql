
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema vakerysss
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema vakerysss
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `vakerysss` DEFAULT CHARACTER SET utf8 ;
USE `vakerysss` ;

-- -----------------------------------------------------
-- Table `vakerysss`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`clientes` (
  `CorreoCliente` VARCHAR(45) NOT NULL,
  `NombreCliente` VARCHAR(45) NULL,
  `ApellidoCliente` VARCHAR(45) NULL,
  `NumeroCliente` INT(11) NULL,
  PRIMARY KEY (`CorreoCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vakerysss`.`gestiondeusuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`gestiondeusuarios` (
  `CI` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Direccion` VARCHAR(45) NULL,
  `Numero` INT(11) NULL,
  `Rol` VARCHAR(45) NULL,
  `Estado` VARCHAR(45) NULL,
  PRIMARY KEY (`CI`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vakerysss`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`pedidos` (
  `id` INT(45) NOT NULL,
  `Nombre` VARCHAR(200) NULL,
  `Fecha` DATE NULL,
  `Estado` VARCHAR(45) NULL,
  `NombreVendedor` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vakerysss`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`productos` (
  `Codigo` VARCHAR(45) NOT NULL,
  `NombreProducto` VARCHAR(45) NULL,
  `PrecioProducto` INT(11) NULL,
  `DetalleProducto` VARCHAR(100) NULL,
  `Stock` INT(11) NULL,
  `CostoProducto` INT(11) NULL,
  PRIMARY KEY (`Codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vakerysss`.`carrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`carrito` (
  `productos_Codigo` VARCHAR(45) NOT NULL,
  `pedidos_id` INT(45) NOT NULL,
  `Cantidad` INT NULL,
  `CostoTotal` INT NULL,
  PRIMARY KEY (`productos_Codigo`, `pedidos_id`),
  INDEX `fk_productos_has_pedidos_pedidos1_idx` (`pedidos_id` ASC) ,
  INDEX `fk_productos_has_pedidos_productos_idx` (`productos_Codigo` ASC) ,
  CONSTRAINT `fk_productos_has_pedidos_productos`
    FOREIGN KEY (`productos_Codigo`)
    REFERENCES `vakerysss`.`productos` (`Codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_has_pedidos_pedidos1`
    FOREIGN KEY (`pedidos_id`)
    REFERENCES `vakerysss`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
