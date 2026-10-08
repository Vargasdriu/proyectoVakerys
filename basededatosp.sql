SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `vakerysss` DEFAULT CHARACTER SET utf8;
USE `vakerysss`;

-- Tabla gestiondeusuarios
CREATE TABLE IF NOT EXISTS `gestiondeusuarios` (
  `CI` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Direccion` VARCHAR(45) NULL,
  `Numero` INT NULL,
  `Rol` VARCHAR(45) NULL,
  `Estado` VARCHAR(45) NULL,
  PRIMARY KEY (`CI`)
) ENGINE=InnoDB;

-- Tabla pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(200) NULL,
  `Fecha` DATE NULL,
  `Estado` VARCHAR(45) NULL,
  `NombreVendedor` VARCHAR(200) NULL,
  `Direccion` VARCHAR(45) NULL,
  `Telefono` INT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Tabla productos
CREATE TABLE IF NOT EXISTS `productos` (
  `Codigo` VARCHAR(45) NOT NULL,
  `NombreProducto` VARCHAR(45) NULL,
  `PrecioProducto` INT NULL,
  `DetalleProducto` VARCHAR(100) NULL,
  `Stock` INT NULL,
  `CostoProducto` INT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB;

-- Tabla imagenes
CREATE TABLE IF NOT EXISTS `imagenes` (
  `idImagen` INT NOT NULL AUTO_INCREMENT,
  `CodigoProducto` VARCHAR(45) NOT NULL,
  `Imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idImagen`),
  INDEX `fk_imagenes_productos_idx` (`CodigoProducto`),
  CONSTRAINT `fk_imagenes_productos`
    FOREIGN KEY (`CodigoProducto`)
    REFERENCES `productos` (`Codigo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabla carrito
CREATE TABLE IF NOT EXISTS `carrito` (
  `productos_Codigo` VARCHAR(45) NOT NULL,
  `pedidos_id` INT NOT NULL,
  `Cantidad` INT NULL,
  `CostoTotal` INT NULL,
  PRIMARY KEY (`productos_Codigo`, `pedidos_id`),
  INDEX `fk_productos_has_pedidos_pedidos1_idx` (`pedidos_id` ASC),
  INDEX `fk_productos_has_pedidos_productos_idx` (`productos_Codigo` ASC),
  CONSTRAINT `fk_productos_has_pedidos_productos`
    FOREIGN KEY (`productos_Codigo`)
    REFERENCES `productos` (`Codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_has_pedidos_pedidos1`
    FOREIGN KEY (`pedidos_id`)
    REFERENCES `pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabla ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `pedidos_id` INT NOT NULL,
  `costoTotal` INT NULL,
  `Estado` VARCHAR(45) NULL,
  `Metodo` VARCHAR(45) NULL,
  PRIMARY KEY (`pedidos_id`),
  CONSTRAINT `fk_ventas_pedidos1`
    FOREIGN KEY (`pedidos_id`)
    REFERENCES `pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Datos de usuarios
INSERT INTO `gestiondeusuarios` (`CI`, `Nombre`, `Direccion`, `Numero`, `Rol`, `Estado`) VALUES
(1, 'Valeria Munoz', 'Tupuraya', 123, 'administrador', 'Activo'),
(2, 'Keith Rojas', 'Queru Queru', 234, 'vendedor', 'Activo'),
(3, 'Matias Saravia', 'Cala Cala', 345, 'vendedor', 'Activo'),
(4, 'Briana Rojas', 'Recoleta', 456, 'administrador', 'Activo'),
(5, 'Joel Vargas', 'Sarco', 567, 'administrador', 'Activo');

-- Productos
INSERT INTO `productos` (`Codigo`, `NombreProducto`, `PrecioProducto`, `DetalleProducto`, `Stock`, `CostoProducto`) VALUES
('Paaa', 'Apple Pie', 65, 'Pie de manzana entero elaborado con manzanas frescas, canela y una masa artesanal crujiente', 6, 35),
('Paab', 'Brownie', 45, 'Brownie entero de chocolate intenso, con textura suave y húmeda en el centro y una superficie ligeramente crujiente', 4, 23),
('Paac', 'Carrot Cake', 120, 'Torta entera de zanahoria preparada con nueces, especias y una suave cobertura cremosa', 3, 65),
('Paad', 'Cheesecake', 150, 'Cheesecake entero de textura cremosa y suave, acompañado de una base crujiente y un delicado acabado dulce', 2, 80),
('Paae', 'Cinnamon Roll', 15, 'Roll de canela suave y esponjoso, relleno con canela y azúcar y cubierto con un delicado glaseado', 15, 7),
('Paaf', 'Cookie', 10, 'Cookie artesanal horneada hasta quedar dorada y suave, preparada con chispas de chocolate', 20, 4),
('Paag', 'Lemon Pie', 70, 'Pie de limón entero con una base crujiente, relleno cremoso de limón y un delicado acabado dulce', 5, 38),
('Paah', 'Roll', 20, 'Roll dulce artesanal de masa suave y esponjosa, preparado con un delicioso relleno y acabado de repostería', 7, 13),
('Paai', 'Tiramisu', 140, 'Tiramisú entero elaborado con capas suaves de bizcocho, crema de mascarpone y un delicado toque de café y cacao', 3, 75);

-- Imágenes: CodigoProducto coincide con productos.Codigo
INSERT INTO `imagenes` (`CodigoProducto`, `Imagen`) VALUES
('Paaa', 'applepie2.jpg'),
('Paaa', 'applepie3.jpg'),
('Paaa', 'applepieproc.jpg'),
('Paab', 'brownie2.jpg'),
('Paab', 'brownie3.jpg'),
('Paab', 'brownieproc.png'),
('Paab', 'browniesolo.png'),
('Paac', 'carrotcake2.jpg'),
('Paac', 'carrotcake3.jpg'),
('Paac', 'carrotcakeproc.jpg'),
('Paad', 'cheesecake2.jpg'),
('Paad', 'cheesecake3.jpg'),
('Paad', 'cheesecakeproc.jpg'),
('Paae', 'cinnamonrollproc.png'),
('Paaf', 'cookie2.jpg'),
('Paaf', 'cookieproc.png'),
('Paag', 'lemonpieproc.jpg'),
('Paah', 'roll2.jpg'),
('Paah', 'roll3.jpg'),
('Paai', 'tiramisu2.jpg'),
('Paai', 'tiramisu3.jpg'),
('Paai', 'tiramisuproc.jpg');

-- 15 pedidos
INSERT INTO `pedidos` (`Nombre`, `Fecha`, `Estado`, `NombreVendedor`, `Direccion`, `Telefono`) VALUES
('Taylor Swift', '2026-09-29', 'Finalizado', 'Keith Rojas', 'Queru Queru', 70123456),
('Lionel Messi', '2026-09-30', 'Finalizado', 'Matias Saravia', 'Cala Cala', 70234567),
('Zendaya', '2026-10-01', 'Finalizado', 'Keith Rojas', 'Recoleta', 70345678),
('Chris Hemsworth', '2026-10-02', 'Finalizado', 'Matias Saravia', 'Sarco', 70456789),
('Sofia Fernandez', '2026-10-03', 'Finalizado', 'Keith Rojas', 'Centro', 70567890),
('Tom Holland', '2026-10-04', 'Finalizado', 'Matias Saravia', 'Norte', 70678901),
('Taylor Swift', '2026-10-05', 'Finalizado', 'Keith Rojas', 'Queru Queru', 70123456),
('Selena Gomez', '2026-10-05', 'En proceso', 'Matias Saravia', 'Recoleta', 70789012),
('Robert Downey Jr.', '2026-10-05', 'En espera', 'Keith Rojas', 'Cala Cala', 70890123),
('Sofia Fernandez', '2026-10-05', 'Finalizado', 'Matias Saravia', 'Centro', 70567890),
('Dwayne Johnson', '2026-10-04', 'En proceso', 'Keith Rojas', 'Sarco', 70901234),
('Emma Watson', '2026-10-03', 'Finalizado', 'Matias Saravia', 'Queru Queru', 71012345),
('Cristiano Ronaldo', '2026-10-02', 'Finalizado', 'Keith Rojas', 'Norte', 71123456),
('Ariana Grande', '2026-10-01', 'En espera', 'Matias Saravia', 'Centro', 71234567),
('Pedro Pascal', '2026-09-30', 'Finalizado', 'Keith Rojas', 'Recoleta', 71345678);

-- Carrito: productos_Codigo coincide con productos.Codigo
-- Taylor Swift
INSERT INTO `carrito` (`productos_Codigo`, `pedidos_id`, `Cantidad`, `CostoTotal`) VALUES
('Paab', 1, 1, 45),
('Paae', 1, 4, 60),
-- Lionel Messi
('Paad', 2, 1, 150),
('Paaf', 2, 6, 60),
-- Zendaya
('Paac', 3, 1, 120),
('Paae', 3, 4, 60),
-- Chris Hemsworth
('Paai', 4, 1, 140),
('Paaa', 4, 1, 65),
-- Sofia Fernandez
('Paab', 5, 1, 45),
('Paaf', 5, 5, 50),
('Paae', 5, 2, 30),
-- Tom Holland
('Paad', 6, 1, 150),
('Paac', 6, 1, 120),
-- Taylor Swift
('Paab', 7, 2, 90),
('Paae', 7, 3, 45),
-- Selena Gomez
('Paai', 8, 1, 140),
('Paag', 8, 1, 70),
-- Robert Downey Jr.
('Paad', 9, 1, 150),
('Paah', 9, 1, 55),
-- Sofia Fernandez
('Paab', 10, 1, 45),
('Paaf', 10, 4, 40),
-- Dwayne Johnson
('Paac', 11, 1, 120),
('Paaa', 11, 1, 65),
-- Emma Watson
('Paae', 12, 6, 90),
('Paag', 12, 1, 70),
-- Cristiano Ronaldo
('Paai', 13, 1, 140),
('Paab', 13, 1, 45),
-- Ariana Grande
('Paad', 14, 1, 150),
('Paaf', 14, 3, 30),
-- Pedro Pascal
('Paab', 15, 1, 45),
('Paae', 15, 4, 60);

-- Ventas
INSERT INTO `ventas` (`pedidos_id`, `costoTotal`, `Estado`, `Metodo`) VALUES
(1, 105, 'Finalizado', 'QR'),
(2, 210, 'Finalizado', 'Tarjeta'),
(3, 180, 'Finalizado', 'Efectivo'),
(4, 205, 'Finalizado', 'QR'),
(5, 125, 'Finalizado', 'Efectivo'),
(6, 270, 'Finalizado', 'Tarjeta'),
(7, 135, 'Finalizado', 'QR'),
(8, 210, 'En proceso', 'QR'),
(9, 205, 'En espera', 'Efectivo'),
(10, 85, 'Finalizado', 'Tarjeta'),
(11, 185, 'En proceso', 'QR'),
(12, 160, 'Finalizado', 'Efectivo'),
(13, 185, 'Finalizado', 'QR'),
(14, 180, 'En espera', 'Tarjeta'),
(15, 105, 'Finalizado', 'Efectivo');
