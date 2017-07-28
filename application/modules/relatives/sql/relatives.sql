CREATE TABLE IF NOT EXISTS  relatives (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(32)  DEFAULT '' NOT NULL, 
	type  varchar(32)  DEFAULT '' NOT NULL, 
	relationship  varchar(32)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	additionals  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;