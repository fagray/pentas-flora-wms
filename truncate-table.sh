set foreign_key_checks = 0;
SELECT Concat('TRUNCATE TABLE ',table_schema,'.',TABLE_NAME, ';') 
FROM INFORMATION_SCHEMA.TABLES where  table_schema in ('db_pentasflora');
set foreign_key_checks = 1;