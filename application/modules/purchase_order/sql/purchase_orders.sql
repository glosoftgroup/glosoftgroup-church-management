CREATE TABLE IF NOT EXISTS  purchase_order (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	purchase_date  INT(11), 
	supplier  varchar(32)  DEFAULT '' NOT NULL, 
	description  varchar(256)  DEFAULT '' NOT NULL, 
	quantity  varchar(256)  DEFAULT '' NOT NULL, 
	unit_price  varchar(256)  DEFAULT '' NOT NULL, 
	sub_total  varchar(256)  DEFAULT '' NOT NULL, 
	vat  varchar(32)  DEFAULT '' NOT NULL, 
	total  varchar(256)  DEFAULT '' NOT NULL, 
	due_date  INT(11), 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;