CREATE TABLE tm_categoria (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_nom VARCHAR(100) NOT NULL,
    cat_decrip TEXT,
    est INT DEFAULT 1
);

INSERT INTO tm_categoria (cat_nom, cat_decrip, est) VALUES
('Electrónica', 'Productos relacionados con dispositivos electrónicos como televisores, teléfonos, etc.', 1),
('Hogar', 'Artículos para el hogar como muebles, electrodomésticos y decoración.', 1),
('Ropa', 'Prendas de vestir para todas las edades y estilos.', 1),
('Juguetes', 'Juguetes y juegos para niños de todas las edades.', 1),
('Deportes', 'Equipos y accesorios para deportes y actividades al aire libre.', 1),
('Alimentos', 'Productos alimenticios como comidas preparadas, frutas, y verduras.', 1),
('Libros', 'Categoría que incluye libros de diversos géneros y autores.', 1)
