CREATE TABLE IF NOT EXISTS  address_book (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	address_book  varchar(256)  DEFAULT '' NOT NULL, 
	category  varchar(32)  DEFAULT '' NOT NULL, 
	contact_person  varchar(256)  DEFAULT '' NOT NULL, 
	business_name  varchar(256)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	additional_info  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;