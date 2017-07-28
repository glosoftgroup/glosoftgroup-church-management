CREATE TABLE IF NOT EXISTS  donations (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	donor  varchar(256)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	country  varchar(32)  DEFAULT '' NOT NULL, 
	city  varchar(256)  DEFAULT '' NOT NULL, 
	donation_type  varchar(256)  DEFAULT '' NOT NULL, 
	pledged_amount  varchar(256)  DEFAULT '' NOT NULL, 
	value  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;