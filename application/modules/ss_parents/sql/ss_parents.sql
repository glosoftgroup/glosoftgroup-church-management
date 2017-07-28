CREATE TABLE IF NOT EXISTS  ss_parents (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(256)  DEFAULT '' NOT NULL, 
	relationship  varchar(256)  DEFAULT '' NOT NULL, 
	phone1  varchar(256)  DEFAULT '' NOT NULL, 
	phone2  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	county  varchar(256)  DEFAULT '' NOT NULL, 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	additionals  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;