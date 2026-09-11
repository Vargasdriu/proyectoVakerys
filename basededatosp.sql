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
    ON UPDATE CASCADE
)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Datos
-- -----------------------------------------------------

USE vakerysss;

INSERT INTO gestiondeusuarios
(CI, Nombre, Direccion, Numero, Rol, Estado)
VALUES
(1, 'Valeria Munoz', 'Centro', 123, 'administrador', 'Activo'),
(2, 'Keith Rojas', 'Queru Queru', 234, 'vendedor', 'Activo'),
(3, 'Matias Saravia', 'Cala Cala', 345, 'vendedor', 'Activo'),
(4, 'Briana Rojas', 'Recoleta', 456, 'administrador', 'Activo'),
(5, 'Joel Vargas', 'Sarco', 567, 'administrador', 'Activo');

-- -----------------------------------------------------
-- Productos
-- -----------------------------------------------------

INSERT INTO productos
(Codigo, NombreProducto, PrecioProducto, DetalleProducto, Stock, CostoProducto, Imagen)
VALUES
('P001', 'Chocolate chips Cookies', 10, 'Galletas artesanales suaves y crujientes con abundantes trozos de chocolate.', 30, 5, 'cookieproc.png'),

('P002', 'Brownie', 15, 'Postre de chocolate suave y húmedo, con intenso sabor a cacao y textura densa.', 20, 9, 'brownieproc.png'),

('P003', 'Cheesecake de Maracuya', 25, 'Postre cremoso de queso y maracuyá con base de galleta y sabor dulce y refrescante.', 12, 16, 'cheesecakeproc.jpg'),

('P004', 'Apple pie', 20, 'Postre de manzana con canela y especias, cubierto con una masa dorada y crujiente.', 15, 12, 'applepieproc.jpg'),

('P005', 'Lemon pie', 20, 'Postre fresco con base crujiente y relleno cremoso de limón, dulce y ligeramente ácido.', 15, 12, 'lemonpieproc.jpg'),

('P006', 'Cinnamon Roll', 18, 'Rollo de masa suave con canela y azúcar, horneado y cubierto con un delicado glaseado.', 15, 10, 'cinnamonrollproc.png'),

('P007', 'Carrot Cake', 25, 'Pastel húmedo de zanahoria, canela y especias, acompañado de una cremosa cobertura.', 12, 16, 'carrotcakeproc.jpg'),

('P008', 'Tiramisu', 28, 'Postre italiano con bizcocho, café y crema de mascarpone, terminado con cacao.', 10, 18, 'tiramisuproc.jpg');

-- -----------------------------------------------------
-- Imágenes
-- -----------------------------------------------------

INSERT INTO imagenes
(CodigoProducto, Imagen)
VALUES
('P001', 'cookieproc.png'),
('P001', 'cookie2.jpg'),

('P002', 'brownieproc.png'),
('P002', 'brownie2.jpg'),
('P002', 'brownie3.jpg'),
('P002', 'browniesolo.png'),

('P003', 'cheesecakeproc.jpg'),
('P003', 'cheesecake2.jpg'),
('P003', 'cheesecake3.jpg'),

('P004', 'applepieproc.jpg'),
('P004', 'applepie2.jpg'),
('P004', 'applepie3.jpg'),

('P005', 'lemonpieproc.jpg'),

('P006', 'cinnamonrollproc.png'),
('P006', 'roll2.jpg'),
('P006', 'roll3.jpg'),

('P007', 'carrotcakeproc.jpg'),
('P007', 'carrotcake2.jpg'),
('P007', 'carrotcake3.jpg'),

('P008', 'tiramisuproc.jpg'),
('P008', 'tiramisu2.jpg'),
('P008', 'tiramisu3.jpg');

-- -----------------------------------------------------
-- Pedidos
-- -----------------------------------------------------

INSERT INTO pedidos
(Nombre, Fecha, Estado, NombreVendedor, Direccion, Telefono)
VALUES
('Taylor Swift', '2026-09-10', 'Finalizado', 'Maria Perez', 'Centro', 76543215),
('Tom Holland', '2026-09-07', 'Aceptado', 'Luis Fernandez', 'Recoleta', 76543216),
('Taylor Swift', '2026-09-06', 'En espera', 'Maria Perez', 'Queru Queru', 76543215),
('Robert Downey Jr.', '2026-09-03', 'Rechazado', 'Luis Fernandez', 'Cala Cala', 76543218),
('Taylor Swift', '2026-08-29', 'Aceptado', 'Maria Perez', 'Sarco', 76543215),
('Chris Hemsworth', '2026-08-25', 'Finalizado', 'Luis Fernandez', 'Centro', 76543220),
('Taylor Swift', '2026-08-18', 'En espera', 'Maria Perez', 'Recoleta', 76543215),
('Jenna Ortega', '2026-08-12', 'Aceptado', 'Luis Fernandez', 'Sarco', 76543222),
('Taylor Swift', '2026-08-05', 'Rechazado', 'Maria Perez', 'Centro', 76543215),
('Zendaya', '2026-07-28', 'Finalizado', 'Luis Fernandez', 'Recoleta', 76543223),
('Taylor Swift', '2026-07-20', 'Aceptado', 'Maria Perez', 'Queru Queru', 76543215),
('Timothee Chalamet', '2026-07-14', 'En espera', 'Luis Fernandez', 'Cala Cala', 76543224),
('Taylor Swift', '2026-07-08', 'Finalizado', 'Maria Perez', 'Sarco', 76543215),
('Tom Holland', '2026-06-30', 'Rechazado', 'Luis Fernandez', 'Centro', 76543216);

-- -----------------------------------------------------
-- Carrito
-- -----------------------------------------------------

INSERT INTO carrito
(productos_Codigo, pedidos_id, Cantidad, CostoTotal)
VALUES
('P001', 1, 3, 30),
('P002', 1, 1, 15),

('P003', 2, 1, 25),
('P004', 2, 2, 40),

('P001', 3, 2, 20),
('P005', 3, 3, 60),

('P002', 4, 2, 30),

('P001', 5, 4, 40),

('P003', 6, 1, 25),

('P006', 7, 2, 36),
('P001', 7, 3, 30),

('P002', 8, 2, 30),
('P008', 8, 1, 28),

('P007', 9, 2, 50),
('P003', 9, 1, 25),

('P004', 10, 2, 40),
('P002', 10, 1, 15),

('P006', 11, 1, 18),
('P005', 11, 2, 40),

('P008', 12, 2, 56),
('P003', 12, 1, 25),

('P007', 13, 1, 25),
('P001', 13, 4, 40),

('P004', 14, 1, 20),
('P006', 14, 2, 36);

-- -----------------------------------------------------
-- Ventas
-- -----------------------------------------------------

INSERT INTO ventas
(pedidos_id, costoTotal, Estado, Metodo)
VALUES
(1, 45, 'Entregado', 'QR'),
(2, 65, 'En Proceso', 'Efectivo'),
(3, 80, 'Finalizado', 'QR'),
(4, 30, 'En Espera', 'Tarjeta'),
(5, 40, 'Entregado', 'QR'),
(6, 25, 'En Proceso', 'Efectivo'),
(7, 66, 'Finalizado', 'QR'),
(8, 58, 'En Espera', 'Tarjeta'),
(9, 75, 'Entregado', 'Efectivo'),
(10, 55, 'En Proceso', 'QR'),
(11, 58, 'Finalizado', 'Efectivo'),
(12, 81, 'Entregado', 'QR'),
(13, 65, 'En Espera', 'Tarjeta'),
(14, 56, 'En Proceso', 'Efectivo');
