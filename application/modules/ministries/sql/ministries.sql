CREATE TABLE IF NOT EXISTS  ministries (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	code  varchar(256)  DEFAULT '' NOT NULL, 
	name  varchar(256)  DEFAULT '' NOT NULL, 
	leader  varchar(32)  DEFAULT '' NOT NULL, 
	telephone  varchar(256)  DEFAULT '' NOT NULL, 
	mobile  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	congregation_size  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;