-- Tabla para los centros escolares
CREATE TABLE IF NOT EXISTS escuelas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    codigo_infraestructura TEXT UNIQUE NOT NULL -- El código del MINED
);

-- Tabla para los salones (secciones) manejados por maestros
CREATE TABLE IF NOT EXISTS secciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL, -- Ej: '1A', '9B'
    maestro_usuario TEXT UNIQUE NOT NULL,
    maestro_password TEXT NOT NULL,
    escuela_id INTEGER,
    FOREIGN KEY (escuela_id) REFERENCES escuelas(id)
);

-- Tabla para los alumnos
CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    puntos INTEGER DEFAULT 0,
    seccion_id INTEGER,
    FOREIGN KEY (seccion_id) REFERENCES secciones(id)
);