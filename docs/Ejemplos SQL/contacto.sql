
CREATE TABLE tm_contacto (
    con_id INT AUTO_INCREMENT PRIMARY KEY,
    cli_id INT NOT NULL,
    car_id INT NOT NULL,
    con_nom VARCHAR(100) NOT NULL,
    con_email VARCHAR(100),
    con_telf VARCHAR(15),
    est INT DEFAULT 1,
    FOREIGN KEY (cli_id) REFERENCES tm_cliente(cli_id),
    FOREIGN KEY (car_id) REFERENCES tm_cargo(car_id)
);

INSERT INTO tm_contacto (cli_id, car_id, con_nom, con_email, con_telf, est) VALUES
(1, 1, 'Carlos Mendoza', 'carlos.mendoza@example.com', '1234567890', 1),
(2, 2, 'Ana García', 'ana.garcia@example.com', '0987654321', 1),
(3, 3, 'Juan Pérez', 'juan.perez@example.com', '1112233445', 1),
(4, 4, 'Marta Torres', 'marta.torres@example.com', '1122334455', 1),
(5, 5, 'Luis Fernández', 'luis.fernandez@example.com', '1223344556', 1),
(6, 6, 'Sofía Morales', 'sofia.morales@example.com', '1334455667', 1),
(7, 1, 'Daniel Ortiz', 'daniel.ortiz@example.com', '1445566778', 1),
(8, 2, 'María López', 'maria.lopez@example.com', '1556677889', 1),
(9, 3, 'Pedro Sánchez', 'pedro.sanchez@example.com', '1667788990', 1),
(10, 4, 'Lucía Ramírez', 'lucia.ramirez@example.com', '1778899001', 1),
(11, 5, 'Alberto Castro', 'alberto.castro@example.com', '1889900112', 1),
(12, 6, 'Elena Rojas', 'elena.rojas@example.com', '1990011223', 1),
(13, 1, 'Gabriela Gómez', 'gabriela.gomez@example.com', '2111122334', 1),
(14, 2, 'Raúl Vargas', 'raul.vargas@example.com', '2222233445', 1),
(15, 3, 'Carla Núñez', 'carla.nunez@example.com', '2333344556', 1),
(16, 4, 'Mario González', 'mario.gonzalez@example.com', '2444455667', 1),
(17, 5, 'Patricia Díaz', 'patricia.diaz@example.com', '2555566778', 1),
(18, 6, 'Javier Ruiz', 'javier.ruiz@example.com', '2666677889', 1),
(19, 1, 'Isabel Rodríguez', 'isabel.rodriguez@example.com', '2777788990', 1),
(20, 2, 'Felipe Martínez', 'felipe.martinez@example.com', '2888899001', 1);

