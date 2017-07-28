CREATE TABLE IF NOT EXISTS  dedications (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	middle_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(256)  DEFAULT '' NOT NULL, 
	dob  INT(11), 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	country  varchar(256)  DEFAULT '' NOT NULL, 
	city  varchar(256)  DEFAULT '' NOT NULL, 
	expected_dedication_date  INT(11), 
	service_type  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;