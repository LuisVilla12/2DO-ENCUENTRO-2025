INSERT INTO registro_constancias (name_, lastname_p, lastname_m,ca_nombre,ca_clave,namepdf,tipo,institucion)
SELECT name_, lastname_p, lastname_m,ca_nombre,ca_clave, CONCAT(REPLACE(name_, ' ', ''),lastname_p,lastname_m, '_constancia_participación.pdf'),'Participación', institucion FROM registro_confirmacion;
