-- Escuela con su código de infraestructura
INSERT INTO escuelas (nombre, codigo_infraestructura) 
VALUES ('Instituto Nacional de Antiguo Cuscatlán', '33010');

-- Salón con su maestro
INSERT INTO secciones (nombre, maestro_usuario, maestro_password, escuela_id)
VALUES ("9B", 'Nelson_Paniagua', '12345678', 1);

-- Creamos un par de alumnos para ese salón
INSERT INTO usuarios (nombre, puntos, seccion_id)
VALUES ("Juan Pérez", 50, 1),
       ("María López", 85, 1),
       ("Abdul Rivera", 90, 1);