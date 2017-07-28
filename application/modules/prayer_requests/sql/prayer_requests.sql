CREATE TABLE IF NOT EXISTS  prayer_requests (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	request_date  INT(11), 
	phone_number  varchar(256)  DEFAULT '' NOT NULL, 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	second_name  varchar(256)  DEFAULT '' NOT NULL, 
	address  varchar(256)  DEFAULT '' NOT NULL, 
	membership  varchar(32)  DEFAULT '' NOT NULL, 
	prayer_request  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;