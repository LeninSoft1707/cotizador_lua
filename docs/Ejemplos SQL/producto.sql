CREATE TABLE tm_producto (
    prod_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_id INT NOT NULL,
    prod_nombre VARCHAR(100) NOT NULL,
    prod_descrip TEXT,
    prod_precio DECIMAL(10, 2) NOT NULL,
    est INT DEFAULT 1,
    FOREIGN KEY (cat_id) REFERENCES tm_categoria(cat_id)
);

INSERT INTO tm_producto (cat_id, prod_nombre, prod_descrip, prod_precio, est) VALUES
(1, 'Televisor LED 50"', 'Televisor LED de 50 pulgadas con resolución 4K UHD', 1200.00, 1),
(1, 'Smartphone Android', 'Teléfono móvil con sistema operativo Android, 128GB de almacenamiento', 350.00, 1),
(1, 'Auriculares Inalámbricos', 'Auriculares con Bluetooth y cancelación de ruido', 80.00, 1),
(2, 'Sofá 3 Plazas', 'Sofá de 3 plazas de cuero sintético, color marrón', 450.00, 1),
(2, 'Mesa de Comedor', 'Mesa de comedor de madera para 6 personas', 300.00, 1),
(2, 'Lámpara de Pie', 'Lámpara de pie moderna con luz LED ajustable', 120.00, 1),
(3, 'Camiseta Deportiva', 'Camiseta de poliéster para deporte, talla M', 25.00, 1),
(3, 'Jeans Clásico', 'Jeans azul clásico de corte recto, talla 32', 40.00, 1),
(3, 'Chaqueta de Cuero', 'Chaqueta de cuero genuino, talla L', 150.00, 1),
(4, 'Muñeca Interactiva', 'Muñeca con sonidos y movimientos interactivos', 60.00, 1),
(4, 'Juego de Construcción', 'Juego de bloques de construcción de 500 piezas', 35.00, 1),
(4, 'Auto a Control Remoto', 'Coche a control remoto con batería recargable', 70.00, 1),
(5, 'Bicicleta de Montaña', 'Bicicleta de montaña con marco de aluminio, frenos de disco', 500.00, 1),
(5, 'Balón de Fútbol', 'Balón de fútbol oficial, tamaño 5', 30.00, 1),
(5, 'Raqueta de Tenis', 'Raqueta de tenis de grafito con cubierta protectora', 150.00, 1),
(6, 'Cereal Integral', 'Caja de cereal integral con frutas deshidratadas, 500g', 5.50, 1),
(6, 'Aceite de Oliva', 'Botella de aceite de oliva virgen extra, 1L', 12.00, 1),
(6, 'Pasta Italiana', 'Pasta italiana de trigo duro, 500g', 3.50, 1),
(7, 'Novela de Ficción', 'Libro de novela de ficción bestseller', 20.00, 1),
(7, 'Libro de Cocina', 'Recetario de cocina con 100 recetas saludables', 18.00, 1);
