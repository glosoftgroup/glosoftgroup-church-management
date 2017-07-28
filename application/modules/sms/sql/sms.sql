CREATE TABLE IF NOT EXISTS  sms (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	recipient  varchar(32)  DEFAULT '' NOT NULL, 
	status  varchar(256)  DEFAULT '' NOT NULL, 
	message  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;