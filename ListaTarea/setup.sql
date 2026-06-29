-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS lista_tarea;
USE lista_tarea;

-- Crear la tabla lista con estructura correcta
CREATE TABLE IF NOT EXISTS lista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proyecto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL
);

-- Insertar datos de ejemplo (opcional)
-- INSERT INTO lista (proyecto, descripcion) VALUES 
-- ('Proyecto 1', 'Descripción del proyecto 1'),
-- ('Proyecto 2', 'Descripción del proyecto 2');
