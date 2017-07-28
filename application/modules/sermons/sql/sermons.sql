CREATE TABLE IF NOT EXISTS  sermons (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	service_date  INT(11), 
	title  varchar(256)  DEFAULT '' NOT NULL, 
	service_leader  varchar(256)  DEFAULT '' NOT NULL, 
	first_service  varchar(256)  DEFAULT '' NOT NULL, 
	second_service  varchar(256)  DEFAULT '' NOT NULL, 
	pastor_on_duty  varchar(32)  DEFAULT '' NOT NULL, 
	sermon_theme  text  , 
	description  text  , 
	upload_sermon  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;