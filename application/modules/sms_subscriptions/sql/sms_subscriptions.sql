CREATE TABLE IF NOT EXISTS  sms_subscriptions (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	member  varchar(32)  DEFAULT '' NOT NULL, 
	bible_quotes  varchar(32)  DEFAULT '' NOT NULL, 
	daily_inspirations  varchar(32)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;