CREATE TABLE IF NOT EXISTS  asset_stock (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	supplier  varchar(32)  DEFAULT '' NOT NULL, 
	item  varchar(32)  DEFAULT '' NOT NULL, 
	quantity  varchar(256)  DEFAULT '' NOT NULL, 
	unit_price  varchar(256)  DEFAULT '' NOT NULL, 
	total  varchar(256)  DEFAULT '' NOT NULL, 
	person_responsible  varchar(32)  DEFAULT '' NOT NULL, 
	file  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;