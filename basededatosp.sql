-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema vakerysss
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `vakerysss` DEFAULT CHARACTER SET utf8;
USE `vakerysss`;

-- -----------------------------------------------------
-- Table `vakerysss`.`gestiondeusuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`gestiondeusuarios` (
  `CI` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Direccion` VARCHAR(45) NULL,
  `Numero` INT NULL,
  `Rol` VARCHAR(45) NULL,
  `Estado` VARCHAR(45) NULL,
  PRIMARY KEY (`CI`)
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `vakerysss`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`pedidos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(200) NULL,
  `Fecha` DATE NULL,
  `Estado` VARCHAR(45) NULL,
  `NombreVendedor` VARCHAR(200) NULL,
  `Direccion` VARCHAR(45) NULL,
  `Telefono` INT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `vakerysss`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`productos` (
  `Codigo` VARCHAR(45) NOT NULL,
  `NombreProducto` VARCHAR(45) NULL,
  `PrecioProducto` INT NULL,
  `DetalleProducto` VARCHAR(100) NULL,
  `Stock` INT NULL,
  `CostoProducto` INT NULL,
  `Imagen` VARCHAR(255) NULL,
  PRIMARY KEY (`Codigo`)
)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `vakerysss`.`imagenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`imagenes` (
  `idImagen` INT NOT NULL AUTO_INCREMENT,
  `CodigoProducto` VARCHAR(45) NOT NULL,
  `Imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idImagen`),
  INDEX `fk_imagenes_productos_idx` (`CodigoProducto`),
  CONSTRAINT `fk_imagenes_productos`
    FOREIGN KEY (`CodigoProducto`)
    REFERENCES `vakerysss`.`productos` (`Codigo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `vakerysss`.`carrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`carrito` (
  `productos_Codigo` VARCHAR(45) NOT NULL,
  `pedidos_id` INT NOT NULL,
  `Cantidad` INT NULL,
  `CostoTotal` INT NULL,
  PRIMARY KEY (`productos_Codigo`, `pedidos_id`),
  INDEX `fk_productos_has_pedidos_pedidos1_idx` (`pedidos_id` ASC),
  INDEX `fk_productos_has_pedidos_productos_idx` (`productos_Codigo` ASC),
  CONSTRAINT `fk_productos_has_pedidos_productos`
    FOREIGN KEY (`productos_Codigo`)
    REFERENCES `vakerysss`.`productos` (`Codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_has_pedidos_pedidos1`
    FOREIGN KEY (`pedidos_id`)
    REFERENCES `vakerysss`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `vakerysss`.`ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vakerysss`.`ventas` (
  `pedidos_id` INT NOT NULL,
  `costoTotal` INT NULL,
  `Estado` VARCHAR(45) NULL,
  `Metodo` VARCHAR(45) NULL,
  PRIMARY KEY (`pedidos_id`),
  CONSTRAINT `fk_ventas_pedidos1`
    FOREIGN KEY (`pedidos_id`)
    REFERENCES `vakerysss`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;