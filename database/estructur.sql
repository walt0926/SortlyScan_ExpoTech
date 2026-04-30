CREATE DATABASE IF NOT EXISTS bdsortlyscan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bdsortlyscan;

CREATE TABLE IF NOT EXISTS Instituciones (
    id_mined VARCHAR(20) PRIMARY KEY,
    nombre_centro VARCHAR(150) NOT NULL
);

CREATE TABLE IF NOT EXISTS Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_mined VARCHAR(20) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('Director', 'Maestro') NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_mined) REFERENCES Instituciones(id_mined) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Salones (
    id_salon INT AUTO_INCREMENT PRIMARY KEY,
    id_mined VARCHAR(20) NOT NULL,
    id_maestro INT NOT NULL,
    nombre_salon VARCHAR(50) NOT NULL,
    codigo_aula VARCHAR(10) UNIQUE NOT NULL,
    FOREIGN KEY (id_mined) REFERENCES Instituciones(id_mined) ON DELETE CASCADE,
    FOREIGN KEY (id_maestro) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Alumnos (
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    id_salon INT NOT NULL,
    nombre_display VARCHAR(50) NOT NULL,
    pin VARCHAR(4) NOT NULL,
    puntos_totales INT DEFAULT 0,
    FOREIGN KEY (id_salon) REFERENCES Salones(id_salon) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Escaneos (
    id_escaneo INT AUTO_INCREMENT PRIMARY KEY,
    id_alumno INT NOT NULL,
    tipo_residuo VARCHAR(50) NOT NULL,
    puntos_obtenidos INT NOT NULL,
    fecha_escaneo DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_alumno) REFERENCES Alumnos(id_alumno) ON DELETE CASCADE
);

DELIMITER //
CREATE TRIGGER trigger_sumar_puntos
AFTER INSERT ON Escaneos
FOR EACH ROW
BEGIN
    UPDATE Alumnos 
    SET puntos_totales = puntos_totales + NEW.puntos_obtenidos
    WHERE id_alumno = NEW.id_alumno;
END;
//
DELIMITER ;