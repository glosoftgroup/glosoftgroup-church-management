CREATE TABLE IF NOT EXISTS  weddings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	wedding_date  INT(11), 
	bride  varchar(32)  DEFAULT '' NOT NULL, 
	bridegroom  varchar(32)  DEFAULT '' NOT NULL, 
	venue  varchar(256)  DEFAULT '' NOT NULL, 
	status  varchar(32)  DEFAULT '' NOT NULL, 
	brief_description  text  , 
	wedding_photo  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;