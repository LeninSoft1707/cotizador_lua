DELIMITER //

CREATE PROCEDURE sp_i_cotizacion_001(
    IN pcli_id INT,
    IN pcon_id INT,
    IN pcli_ruc VARCHAR(50),
    IN pcon_telf VARCHAR(50),
    IN pcon_email VARCHAR(50),
    IN pcot_descrip VARCHAR(500)
)
BEGIN
    INSERT INTO tm_cotizacion (cot_id, cli_id, con_id, cli_ruc, con_telf, con_email, cot_descrip, fech_crea, est)
    VALUES (NULL, pcli_id, pcon_id, pcli_ruc, pcon_telf, pcon_email, pcot_descrip, NOW(), 1);
    SELECT LAST_INSERT_ID() AS 'cot_id';
END //

DELIMITER ;

CALL sp_i_cotizacion_001(1, 1, '12345678', '987654321', 'ejemplo@correo.com', 'Descripción de la cotización');