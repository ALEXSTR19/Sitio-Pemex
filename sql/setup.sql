CREATE DATABASE IF NOT EXISTS axelanto_pemex_bd DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE axelanto_pemex_bd;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS vacantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    puesto VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS aplicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacante_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vacante_id) REFERENCES vacantes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuarios (usuario, password, rol) VALUES
('admin', '$2y$12$rYFelBfwLsXPv0QWvEVpVu1ZXydP/3idi7FtK4Atn7WH/ZIi5rryS', 'administrador');

INSERT INTO vacantes (puesto, descripcion) VALUES
('Ejemplo de puesto', 'Ejemplo de descripcion');
