CREATE TABLE IF NOT EXISTS  current (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	total  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;