CREATE TABLE IF NOT EXISTS  sandbox (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	title  varchar(256)  DEFAULT '' NOT NULL, 
	day  INT(11), 
	dday  varchar(256)  DEFAULT '' NOT NULL, 
	time  varchar(256)  DEFAULT '' NOT NULL, 
	slot  varchar(256)  DEFAULT '' NOT NULL, 
	link  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;