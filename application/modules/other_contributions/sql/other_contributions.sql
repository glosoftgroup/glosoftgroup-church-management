CREATE TABLE IF NOT EXISTS  other_contributions (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	contribution_type  INT(11), 
	member  varchar(32)  DEFAULT '' NOT NULL, 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
	bank  varchar(32)  DEFAULT '' NOT NULL, 
	treasurer  varchar(32)  DEFAULT '' NOT NULL, 
	confirmed_by  varchar(32)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;