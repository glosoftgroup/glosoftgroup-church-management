CREATE TABLE IF NOT EXISTS  pledges (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	title  varchar(256)  DEFAULT '' NOT NULL, 
	member  varchar(32)  DEFAULT '' NOT NULL, 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
	expected_pay_date  INT(11), 
	status  varchar(32)  DEFAULT '' NOT NULL, 
	remarks  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;