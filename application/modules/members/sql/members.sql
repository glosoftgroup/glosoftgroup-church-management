CREATE TABLE IF NOT EXISTS  members (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date_joined  INT(11), 
	title  varchar(32)  DEFAULT '' NOT NULL, 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(32)  DEFAULT '' NOT NULL, 
	dob  INT(11), 
	hbc_id  INT(11), 
	phone1  varchar(256)  DEFAULT '' NOT NULL, 
	phone2  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	country  varchar(32)  DEFAULT '' NOT NULL, 
	county  varchar(32)  DEFAULT '' NOT NULL, 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	marital_status  varchar(32)  DEFAULT '' NOT NULL, 
	member_status  varchar(32)  DEFAULT '' NOT NULL, 
	passport  varchar(256)  DEFAULT '' NOT NULL, 
	occupation  varchar(32)  DEFAULT '' NOT NULL, 
	employer  varchar(256)  DEFAULT '' NOT NULL, 
	how_joined  varchar(32)  DEFAULT '' NOT NULL, 
	baptised  varchar(32)  DEFAULT '' NOT NULL, 
	confirmed  varchar(32)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
	
	
	CREATE TABLE `relatives` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`member_id` INT(11) NOT NULL DEFAULT '0',
	`first_name` VARCHAR(256) NOT NULL DEFAULT '',
	`last_name` VARCHAR(256) NOT NULL DEFAULT '',
	`gender` VARCHAR(32) NOT NULL DEFAULT '',
	`type` VARCHAR(32) NOT NULL DEFAULT '',
	`relationship` VARCHAR(32) NOT NULL DEFAULT '',
	`phone` VARCHAR(256) NOT NULL DEFAULT '',
	`location` VARCHAR(256) NOT NULL DEFAULT '',
	`email` VARCHAR(256) NOT NULL DEFAULT '',
	`additionals` TEXT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL,
	`created_on` INT(11) NULL DEFAULT NULL,
	`modified_on` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=14
;
