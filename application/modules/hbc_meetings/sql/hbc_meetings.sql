CREATE TABLE IF NOT EXISTS  hbc_meetings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	hbc  varchar(32)  DEFAULT '' NOT NULL, 
	host  varchar(256)  DEFAULT '' NOT NULL, 
	hosts_phone_no  varchar(256)  DEFAULT '' NOT NULL, 
	estate  varchar(256)  DEFAULT '' NOT NULL, 
	house_number  varchar(256)  DEFAULT '' NOT NULL, 
	service_leader  varchar(32)  DEFAULT '' NOT NULL, 
	preacher  varchar(256)  DEFAULT '' NOT NULL, 
	brief_description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;