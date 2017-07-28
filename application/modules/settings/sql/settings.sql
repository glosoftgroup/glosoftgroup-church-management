CREATE TABLE IF NOT EXISTS  settings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	name  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	county  varchar(256)  DEFAULT '' NOT NULL, 
	town  varchar(256)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	other_phones  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	sms_initial  varchar(256)  DEFAULT '' NOT NULL, 
	member_code_initial  varchar(256)  DEFAULT '' NOT NULL, 
	file  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;