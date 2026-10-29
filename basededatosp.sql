
DROP DATABASE IF EXISTS vakerysss;

CREATE DATABASE vakerysss
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE vakerysss;


-- ============================================
-- TABLA GESTIÓN DE USUARIOS
-- ============================================

CREATE TABLE gestiondeusuarios (
    CI INT NOT NULL,
    Nombre VARCHAR(45),
    Direccion VARCHAR(45),
    Numero INT,
    Rol VARCHAR(45),
    Estado VARCHAR(45),
    PRIMARY KEY (CI)
) ENGINE=InnoDB;


-- ============================================
-- TABLA PEDIDOS
-- ============================================

CREATE TABLE pedidos (
    id INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(200),
    Fecha DATE,
    Estado VARCHAR(45),
    NombreVendedor VARCHAR(200),
    Direccion VARCHAR(45),
    Telefono INT,
    PRIMARY KEY (id)
) ENGINE=InnoDB;


-- ============================================
-- TABLA PRODUCTOS
-- ============================================

CREATE TABLE productos (
    Codigo VARCHAR(45) NOT NULL,
    NombreProducto VARCHAR(45),
    PrecioProducto INT,
    DetalleProducto VARCHAR(200),
    Stock INT,
    CostoProducto INT,
    PRIMARY KEY (Codigo)
) ENGINE=InnoDB;


-- ============================================
-- TABLA IMÁGENES
-- ============================================

CREATE TABLE imagenes (
    idImagen INT NOT NULL AUTO_INCREMENT,
    CodigoProducto VARCHAR(45) NOT NULL,
    Imagen VARCHAR(255) NOT NULL,

    PRIMARY KEY (idImagen),

    CONSTRAINT fk_imagenes_productos
    FOREIGN KEY (CodigoProducto)
    REFERENCES productos(Codigo)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================
-- TABLA CARRITO
-- ============================================

CREATE TABLE carrito (
    productos_Codigo VARCHAR(45) NOT NULL,
    pedidos_id INT NOT NULL,
    Cantidad INT,
    CostoTotal INT,

    PRIMARY KEY (productos_Codigo, pedidos_id),

    CONSTRAINT fk_carrito_productos
    FOREIGN KEY (productos_Codigo)
    REFERENCES productos(Codigo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

    CONSTRAINT fk_carrito_pedidos
    FOREIGN KEY (pedidos_id)
    REFERENCES pedidos(id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;


-- ============================================
-- TABLA VENTAS
-- RELACIÓN 1 A 1 CON PEDIDOS
-- ============================================

CREATE TABLE ventas (
    pedidos_id INT NOT NULL,
    costoTotal INT,
    Estado VARCHAR(45),
    Metodo VARCHAR(45),

    PRIMARY KEY (pedidos_id),

    CONSTRAINT fk_ventas_pedidos1
    FOREIGN KEY (pedidos_id)
    REFERENCES pedidos(id)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================
-- DATOS DE USUARIOS
-- ============================================

INSERT INTO gestiondeusuarios
(CI, Nombre, Direccion, Numero, Rol, Estado)
VALUES
(1, 'Valeria Munoz', 'Tupuraya', 123, 'administrador', 'Activo'),
(2, 'Keith Rojas', 'Queru Queru', 234, 'vendedor', 'Activo'),
(3, 'Matias Saravia', 'Cala Cala', 345, 'vendedor', 'Activo'),
(4, 'Briana Rojas', 'Recoleta', 456, 'administrador', 'Activo'),
(5, 'Joel Vargas', 'Sarco', 567, 'administrador', 'Activo');


-- ============================================
-- DATOS DE PRODUCTOS
-- PRODUCTO ROLL ELIMINADO
-- ============================================

INSERT INTO productos
(Codigo, NombreProducto, PrecioProducto,
 DetalleProducto, Stock, CostoProducto)
VALUES

('Paaa', 'Apple Pie', 65,
'Pie de manzana entero elaborado con manzanas frescas, canela y una masa artesanal crujiente',
6, 35),

('Paab', 'Brownie', 45,
'Brownie entero de chocolate intenso, con textura suave y húmeda en el centro y una superficie ligeramente crujiente',
4, 23),

('Paac', 'Carrot Cake', 120,
'Torta entera de zanahoria preparada con nueces, especias y una suave cobertura cremosa',
3, 65),

('Paad', 'Cheesecake', 150,
'Cheesecake entero de textura cremosa y suave, acompañado de una base crujiente y un delicado acabado dulce',
2, 80),

('Paae', 'Cinnamon Roll', 15,
'Roll de canela suave y esponjoso, relleno con canela y azúcar y cubierto con un delicado glaseado',
15, 7),

('Paaf', 'Cookie', 10,
'Cookie artesanal horneada hasta quedar dorada y suave, preparada con chispas de chocolate',
20, 4),

('Paag', 'Lemon Pie', 70,
'Pie de limón entero con una base crujiente, relleno cremoso de limón y un delicado acabado dulce',
5, 38),

('Paai', 'Tiramisu', 140,
'Tiramisú entero elaborado con capas suaves de bizcocho, crema de mascarpone y un delicado toque de café y cacao',
3, 75);


-- ============================================
-- IMÁGENES DE PRODUCTOS
-- ============================================

INSERT INTO imagenes
(CodigoProducto, Imagen)
VALUES

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

('Paai', 'tiramisu2.jpg'),
('Paai', 'tiramisu3.jpg'),
('Paai', 'tiramisuproc.jpg');


-- ============================================
-- 15 PEDIDOS
-- ============================================

INSERT INTO pedidos
(Nombre, Fecha, Estado, NombreVendedor,
 Direccion, Telefono)
VALUES

('Taylor Swift', '2026-09-29', 'Aceptado',
'Keith Rojas', 'Queru Queru', 70123456),

('Lionel Messi', '2026-09-30', 'Aceptado',
'Matias Saravia', 'Cala Cala', 70234567),

('Zendaya', '2026-10-01', 'Aceptado',
'Keith Rojas', 'Recoleta', 70345678),

('Chris Hemsworth', '2026-10-02', 'Aceptado',
'Matias Saravia', 'Sarco', 70456789),

('Sofia Fernandez', '2026-10-03', 'Rechazado',
'Keith Rojas', 'Centro', 70567890),

('Tom Holland', '2026-10-04', 'Rechazado',
'Matias Saravia', 'Norte', 70678901),

('Taylor Swift', '2026-10-05', 'Rechazado',
'Keith Rojas', 'Queru Queru', 70123456),

('Selena Gomez', '2026-10-05', 'Rechazado',
'Matias Saravia', 'Recoleta', 70789012),

('Robert Downey Jr.', '2026-10-05', 'Pendiente',
'Keith Rojas', 'Cala Cala', 70890123),

('Sofia Fernandez', '2026-10-05', 'Pendiente',
'Matias Saravia', 'Centro', 70567890),

('Dwayne Johnson', '2026-10-04', 'Pendiente',
'Keith Rojas', 'Sarco', 70901234),

('Emma Watson', '2026-10-03', 'Pendiente',
'Matias Saravia', 'Queru Queru', 71012345),

('Cristiano Ronaldo', '2026-10-02', 'Pendiente',
'Keith Rojas', 'Norte', 71123456),

('Ariana Grande', '2026-10-01', 'Rechazado',
'Matias Saravia', 'Centro', 71234567),

('Pedro Pascal', '2026-09-30', 'Aceptado',
'Keith Rojas', 'Recoleta', 71345678);


-- ============================================
-- DATOS DEL CARRITO
-- ============================================

INSERT INTO carrito
(productos_Codigo, pedidos_id, Cantidad, CostoTotal)
VALUES

-- Pedido 1: Taylor Swift
('Paab', 1, 1, 45),
('Paae', 1, 4, 60),

-- Pedido 2: Lionel Messi
('Paad', 2, 1, 150),
('Paaf', 2, 6, 60),

-- Pedido 3: Zendaya
('Paac', 3, 1, 120),
('Paae', 3, 4, 60),

-- Pedido 4: Chris Hemsworth
('Paai', 4, 1, 140),
('Paaa', 4, 1, 65),

-- Pedido 5: Sofia Fernandez
('Paab', 5, 1, 45),
('Paaf', 5, 5, 50),
('Paae', 5, 2, 30),

-- Pedido 6: Tom Holland
('Paad', 6, 1, 150),
('Paac', 6, 1, 120),

-- Pedido 7: Taylor Swift
('Paab', 7, 2, 90),
('Paae', 7, 3, 45),

-- Pedido 8: Selena Gomez
('Paai', 8, 1, 140),
('Paag', 8, 1, 70),

-- Pedido 9: Robert Downey Jr.
-- Se reemplazó Roll por Cookie
('Paad', 9, 1, 150),
('Paaf', 9, 2, 20),

-- Pedido 10: Sofia Fernandez
('Paab', 10, 1, 45),
('Paaf', 10, 4, 40),

-- Pedido 11: Dwayne Johnson
('Paac', 11, 1, 120),
('Paaa', 11, 1, 65),

-- Pedido 12: Emma Watson
('Paae', 12, 6, 90),
('Paag', 12, 1, 70),

-- Pedido 13: Cristiano Ronaldo
('Paai', 13, 1, 140),
('Paab', 13, 1, 45),

-- Pedido 14: Ariana Grande
('Paad', 14, 1, 150),
('Paaf', 14, 3, 30),

-- Pedido 15: Pedro Pascal
('Paab', 15, 1, 45),
('Paae', 15, 4, 60);


-- ============================================
-- VENTAS FINALIZADAS
-- ============================================

INSERT INTO ventas
(pedidos_id, costoTotal, Estado, Metodo)
VALUES

(1, 105, 'Finalizado', 'QR'),
(2, 210, 'Finalizado', 'Tarjeta'),
(3, 180, 'Finalizado', 'Efectivo'),
(4, 205, 'Finalizado', 'QR'),
(15, 105, 'Finalizado', 'Efectivo');


-- ============================================
-- VERIFICACIÓN DE TABLAS
-- ============================================

SHOW TABLES;

SELECT * FROM gestiondeusuarios;
SELECT * FROM productos;
SELECT * FROM imagenes;
SELECT * FROM pedidos;
SELECT * FROM carrito;
SELECT * FROM ventas;


-- ============================================
-- VERIFICAR RELACIÓN PEDIDOS - VENTAS
-- ============================================

SHOW CREATE TABLE ventas;