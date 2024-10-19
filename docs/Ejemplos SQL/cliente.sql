CREATE TABLE tm_cliente (
    cli_id INT AUTO_INCREMENT PRIMARY KEY,
    cli_nom VARCHAR(100) NOT NULL,
    cli_ruc VARCHAR(20) NOT NULL,
    cli_tel VARCHAR(15),
    cli_email VARCHAR(100),
    est INT
);

INSERT INTO tm_cliente (cli_nom, cli_ruc, cli_tel, cli_email, est) VALUES
('Juan Pérez', '20123456789', '987654321', 'juan.perez@example.com', 1),
('María Gómez', '20456789012', '987654322', 'maria.gomez@example.com', 1),
('Carlos Ramírez', '20987654321', '987654323', 'carlos.ramirez@example.com', 1),
('Ana Torres', '20123456780', '987654324', 'ana.torres@example.com', 1),
('Luis Fernández', '20456789013', '987654325', 'luis.fernandez@example.com', 1),
('Sofía Vargas', '20987654322', '987654326', 'sofia.vargas@example.com', 1),
('Miguel Martínez', '20123456781', '987654327', 'miguel.martinez@example.com', 1),
('Lucía Morales', '20456789014', '987654328', 'lucia.morales@example.com', 1),
('José Rojas', '20987654323', '987654329', 'jose.rojas@example.com', 1),
('Elena Paredes', '20123456782', '987654330', 'elena.paredes@example.com', 1),
('Ricardo Díaz', '20456789015', '987654331', 'ricardo.diaz@example.com', 1),
('Patricia Soto', '20987654324', '987654332', 'patricia.soto@example.com', 1),
('Andrés Castillo', '20123456783', '987654333', 'andres.castillo@example.com', 1),
('Verónica Salas', '20456789016', '987654334', 'veronica.salas@example.com', 1),
('Gabriel Mendoza', '20987654325', '987654335', 'gabriel.mendoza@example.com', 1),
('Isabel Ruiz', '20123456784', '987654336', 'isabel.ruiz@example.com', 1),
('Jorge León', '20456789017', '987654337', 'jorge.leon@example.com', 1),
('Carmen Flores', '20987654326', '987654338', 'carmen.flores@example.com', 1),
('Felipe Guerrero', '20123456785', '987654339', 'felipe.guerrero@example.com', 1),
('Raquel Silva', '20456789018', '987654340', 'raquel.silva@example.com', 1)