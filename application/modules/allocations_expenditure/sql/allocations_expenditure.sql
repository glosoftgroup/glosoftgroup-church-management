CREATE TABLE IF NOT EXISTS  allocations_expenditure (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	ministry  varchar(32)  DEFAULT '' NOT NULL, 
	expenditure  varchar(256)  DEFAULT '' NOT NULL, 
	balance  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;