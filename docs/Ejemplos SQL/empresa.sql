CREATE TABLE tm_empresa (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_nom VARCHAR(100) NOT NULL,
    emp_porcen DECIMAL(5, 2) NOT NULL
);

INSERT INTO tm_empresa (emp_nom, emp_porcen,est) VALUES
('Tech Innovations', 25.00, 1),
('Global Solutions', 15.50),
('Creative Minds', 10.75),
('Eco Enterprises', 20.30),
('Future Ventures', 18.90);
