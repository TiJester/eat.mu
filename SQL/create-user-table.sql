/**
 * Author:  Grib
 * Created: 02.01.2018:1.49
 * Ver: 0.3
 */
CREATE TABLE `user` 
( 
    `id` INT NULL AUTO_INCREMENT COMMENT 'id пользователя' , 
    `name` CHAR(50) NULL COMMENT 'имя пользователя' , 
    `password` CHAR(50) NULL COMMENT 'пароль пользователя' , 
    /*Ключи*/
    PRIMARY KEY (`id`), 
    UNIQUE (`name`)
)
 ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'user (таблийца пользователей)';
