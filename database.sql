CREATE DATABASE IF NOT EXISTS appdb;
USE appdb;


-- TABLA PRINCIPAL 
CREATE TABLE solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,

    cedula VARCHAR(20) NOT NULL,
    edad INT NOT NULL,
    estado_civil VARCHAR(50),

    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),

    ocupacion VARCHAR(100),
    motivo TEXT,

    documento VARCHAR(255),

    estado ENUM('En revisión','Aprobado','Rechazado') 
        DEFAULT 'En revisión',

    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



