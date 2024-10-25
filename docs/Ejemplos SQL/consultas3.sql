DELIMITER //
CREATE PROCEDURE sp_l_cotizacion_002(
    IN pusu_id INT
)
BEGIN
    	SET lc_time_names = 'es_ES';
		SELECT 
		tm_cotizacion.cot_id, 
		tm_cotizacion.cli_id, 
		tm_cliente.cli_nom,
		tm_cotizacion.cli_ruc,
		tm_cliente.cli_telf,
		tm_cliente.cli_email,
		tm_cotizacion.con_id,
		tm_contacto.con_nom, 
		tm_cotizacion.con_telf,
		tm_cotizacion.con_email,
		tm_cotizacion.emp_id,
		tm_cotizacion.cot_saludo,
		tm_cotizacion.cot_adicional,
		tm_cotizacion.cot_contrato,
		tm_empresa.emp_nom,
		tm_empresa.emp_porcen,
		tm_empresa.emp_ruc,
		tm_empresa.emp_telf,
		tm_empresa.emp_email,
		tm_empresa.emp_direc,
		tm_empresa.emp_web, 
		cot_descrip,  
		cot_subtotal,
		cot_profit, 
		cot_total,
		tm_cotizacion.fech_crea,
		tm_cotizacion.fech_envio,
		tm_cotizacion.fech_visto,
		tm_cotizacion.fech_respuesta,
		tm_cotizacion.cot_tipo,
		tm_cotizacion.usu_id,
		tm_usuario.usu_nom,
		tm_usuario.usu_correo,
		DATE_FORMAT(fech_respuesta, '%W, %d de %M del %Y %H:%i:%s') AS fech_respuesta_format,
		DATE_FORMAT(fech_crea, '%W, %d de %M del %Y') AS fech_crea_format,
		MONTHNAME(fech_crea) AS mes_en_texto 
		FROM 
		tm_cotizacion INNER JOIN 
		tm_cliente ON tm_cotizacion.cli_id = tm_cliente.cli_id INNER JOIN
		tm_contacto ON tm_cotizacion.con_id = tm_contacto.con_id INNER JOIN
		tm_empresa ON tm_cotizacion.emp_id = tm_empresa.emp_id INNER JOIN
		tm_usuario ON tm_cotizacion.usu_id = tm_usuario.usu_id
		WHERE
		tm_cotizacion.usu_id = pusu_id;
END //
DELIMITER ;

cotizador

SELECT * FROM tm_usuario