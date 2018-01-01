/**
 * Author:  Grib
 * Created: 01.01.2018:22.20
 * Ver: 0.2
 */
CREATE TABLE `user` 
( 
    `id` INT NULL AUTO_INCREMENT COMMENT 'id пользователя' , 
    `id_address` INT NULL COMMENT 'связь с таблицей: USER' , 
    `name` CHAR(50) NULL COMMENT 'имя пользователя' , 
    `password` CHAR(50) NULL COMMENT 'пароль пользователя' , 
    /*Ключи*/
    PRIMARY KEY (`id`), 
    INDEX (`id_address`), 
    UNIQUE (`name`)
)
 ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'user (таблийца пользователей)';

ALTER TABLE `user` /*Связь таблиц User and Address по key (id_address User) и (id Address)*/
    ADD FOREIGN KEY (`id_address`) 
    REFERENCES `address`(`id`) 
    ON DELETE CASCADE ON UPDATE CASCADE;