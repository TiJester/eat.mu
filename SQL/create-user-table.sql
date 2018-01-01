/**
 * Author:  Grib
 * Created: 01.01.2018:19.50
 */
CREATE TABLE `user` 
( 
    `id` INT NULL AUTO_INCREMENT COMMENT 'id пользователя' , 
    `name` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'имя пользователя' , 
    `password` CHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'пароль пользователя' , PRIMARY KEY (`id`), UNIQUE (`name`)
)
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'user (таблийца пользователей)';
