CREATE TABLE IF NOT EXISTS  reports (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	dtae  INT(11), 
	title  varchar(256)  DEFAULT '' NOT NULL, 
	item_id  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;