CREATE TABLE `mydatabase`.`cards` (`id` INT NOT NULL AUTO_INCREMENT , `front_desc` VARCHAR(1000) NOT NULL , `back_desc` VARCHAR(1000) NOT NULL , `tags` VARCHAR(500) NOT NULL , `is_private` CHAR(1) NOT NULL DEFAULT 'Y' , `user` VARCHAR(100) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `cards` ADD `favorite_ind` CHAR(1) NOT NULL DEFAULT 'N' AFTER `user`;

CREATE TABLE `mydatabase`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;