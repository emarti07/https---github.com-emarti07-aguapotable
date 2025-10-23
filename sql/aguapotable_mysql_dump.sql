-- MySQL dump for aguapotable (simple schema + sample data)
CREATE DATABASE IF NOT EXISTS `aguapotable` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `aguapotable`;

-- users (simple)
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'operator',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`name`,`email`,`password`,`role`) VALUES
('Admin Principal','admin@example.com','$2y$10$examplehashreplace','admin'),
('Operador Uno','operador@example.com','$2y$10$examplehashreplace','operator');

-- clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) NOT NULL,
  `apellido` varchar(191) DEFAULT NULL,
  `identidad` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `clientes` (`nombre`,`apellido`,`identidad`,`direccion`,`telefono`,`email`) VALUES
('Juan','Pérez','0801199012345','Col. Centro, Casa 12','(505) 2222-3333','juan.perez@example.com'),
('María','Gómez','0802199023456','Barrio Norte, Apt 3','(505) 6666-7777','maria.gomez@example.com');

-- medidores
DROP TABLE IF EXISTS `medidores`;
CREATE TABLE `medidores` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(100) NOT NULL,
  `cliente_id` int unsigned DEFAULT NULL,
  `estado` enum('instalado','inactivo','mantenimiento') DEFAULT 'instalado',
  `ubicacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `medidores_cliente_id_foreign` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `medidores` (`numero`,`cliente_id`,`ubicacion`) VALUES
('MTR-0001',1,'Frente casa'),
('MTR-0002',2,'Patio trasero');

-- lecturas
DROP TABLE IF EXISTS `lecturas`;
CREATE TABLE `lecturas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `medidor_id` int unsigned NOT NULL,
  `periodo` date NOT NULL,
  `lectura` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lecturas_medidor_id_foreign` (`medidor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `lecturas` (`medidor_id`,`periodo`,`lectura`) VALUES
(1,'2025-08-01',120),
(1,'2025-09-01',150),
(2,'2025-09-01',80);

-- facturas
DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int unsigned NOT NULL,
  `periodo` date NOT NULL,
  `consumo` int NOT NULL DEFAULT 0,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` enum('pendiente','pagado','vencido') DEFAULT 'pendiente',
  `fecha_emision` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `facturas_cliente_id_foreign` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `facturas` (`cliente_id`,`periodo`,`consumo`,`monto`,`estado`,`fecha_emision`,`fecha_vencimiento`) VALUES
(1,'2025-09-01',30,45.00,'pendiente','2025-09-05','2025-09-20'),
(2,'2025-09-01',80,120.00,'pagado','2025-09-05','2025-09-20');

-- pagos
DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `factura_id` int unsigned NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metodo` varchar(100) DEFAULT 'efectivo',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pagos_factura_id_foreign` (`factura_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pagos` (`factura_id`,`fecha_pago`,`monto`,`metodo`) VALUES
(2,'2025-09-10',120.00,'efectivo');


    -- Insert operator users
    INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES
    ('Operador 1', 'operador1@example.com', '$2y$10$5KIXj7wXJ0qz7R6pujISi.g0bZkD8Ih31lrT7xvFeoJEB6Digw1aW', 'operator', NOW(), NOW()),
    ('Operador 2', 'operador2@example.com', '$2y$10$5KIXj7wXJ0qz7R6pujISi.g0bZkD8Ih31lrT7xvFeoJEB6Digw1aW', 'operator', NOW(), NOW());

    -- Insert sample clients
    INSERT INTO clientes (nombre, direccion, telefono, created_at, updated_at) VALUES
    ('Juan Pérez', 'Calle Central 123', '88888801', NOW(), NOW()),
    ('María López', 'Av. Libertad 456', '88888802', NOW(), NOW()),
    ('Carlos Rodríguez', 'Colonia Norte 12', '88888803', NOW(), NOW()),
    ('Ana González', 'Barrio Sur 34', '88888804', NOW(), NOW()),
    ('Pedro Martínez', 'Km 5 Carretera Masaya', '88888805', NOW(), NOW()),
    ('Luisa Fernández', 'Residencial Las Flores', '88888806', NOW(), NOW()),
    ('José Ramírez', 'Villa Fontana', '88888807', NOW(), NOW()),
    ('Sofía Torres', 'Ciudad Jardín', '88888808', NOW(), NOW()),
    ('Miguel Sánchez', 'Camino Real 77', '88888809', NOW(), NOW()),
    ('Laura Castillo', 'Altamira 23', '88888810', NOW(), NOW());
    