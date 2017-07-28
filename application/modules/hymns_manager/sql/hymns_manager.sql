CREATE TABLE IF NOT EXISTS  hymns_manager (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	hymn_title  varchar(256)  DEFAULT '' NOT NULL, 
	composer  varchar(256)  DEFAULT '' NOT NULL, 
	category  varchar(32)  DEFAULT '' NOT NULL, 
	lyrics  text  , 
	file  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;