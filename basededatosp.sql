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

USE vakerysss;

INSERT INTO gestiondeusuarios
(CI, Nombre, Direccion, Numero, Rol, Estado)
VALUES
(1, 'Valeria  Muñoz', 'Centro', 123, 'administrador', 'Activo'),
(2, 'Keith Rojas', 'Queru Queru', 234, 'vendedor', 'Activo'),
(3, 'Matias Saravia', 'Cala Cala', 345, 'vendedor', 'Activo'),
(4, 'Briana Rojas', 'Recoleta', 456, 'administrador', 'Activo'),
(5, 'Joel Vargas', 'Sarco', 567, 'administrador', 'Activo');


INSERT INTO productos
(Codigo, NombreProducto, PrecioProducto, DetalleProducto, Stock, CostoProducto, Imagen)
VALUES
('P001', 'Galletas', 10, 'Galletas artesanales', 30, 5, 'cookieproc.png'),
('P002', 'Brownie', 15, 'Brownie de chocolate', 20, 9, 'brownieproc.png'),
('P003', 'Cheesecake de Maracuya', 25, 'Cheesecake de maracuya', 12, 16, 'cheesecakeproc.png'),
('P004', 'Pie de Manzana', 20, 'Pie de manzana artesanal', 15, 12, 'applepieproc.png'),
('P005', 'Pie de Limon', 20, 'Pie de limon artesanal', 15, 12, 'lemonpieproc.png');


INSERT INTO pedidos
(Nombre, Fecha, Estado, NombreVendedor, Direccion, Telefono)
VALUES
('Sofia Vargas', '2026-09-09', 'Finalizado', 'Maria Perez', 'Recoleta', 76543213),
('Carlos Rojas', '2026-09-08', 'Finalizado', 'Luis Fernandez', 'Sarco', 76543214),
('Sofia Vargas', '2026-09-05', 'Finalizado', 'Maria Perez', 'Recoleta', 76543213),
('Carlos Rojas', '2026-08-20', 'Finalizado', 'Luis Fernandez', 'Sarco', 76543214),
('Sofia Vargas', '2026-07-15', 'Finalizado', 'Maria Perez', 'Recoleta', 76543213),
('Carlos Rojas', '2025-12-20', 'Finalizado', 'Luis Fernandez', 'Sarco', 76543214);


INSERT INTO carrito
(productos_Codigo, pedidos_id, Cantidad, CostoTotal)
VALUES
('P001', 1, 3, 45),
('P002', 1, 1, 25),

('P003', 2, 1, 120),
('P004', 2, 2, 24),

('P001', 3, 2, 30),
('P005', 3, 3, 30),

('P002', 4, 2, 50),
('P001', 5, 4, 60),
('P003', 6, 1, 120);


INSERT INTO ventas
(pedidos_id, costoTotal, Estado, Metodo)
VALUES
(1, 70, 'Finalizado', 'QR'),
(2, 144, 'Finalizado', 'Efectivo'),
(3, 60, 'Finalizado', 'QR'),
(4, 50, 'Finalizado', 'Tarjeta'),
(5, 60, 'Finalizado', 'QR'),
(6, 120, 'Finalizado', 'Efectivo');