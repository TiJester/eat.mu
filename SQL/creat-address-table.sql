/* 
 * TiJester
 * UA Odessa  * 
 */
/**
 * Author:  Grib
 * Created: 02.01.2018:1.49
 * Ver: 0.2
 */
CREATE TABLE `address` 
( 
    `id` INT NOT NULL AUTO_INCREMENT ,
    `id_user` INT NULL COMMENT 'связь с таблицей: USER' , 
    `address_country` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Страна' , 
    `address_city` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Город' , 
    `address_street` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Улица' , 
    `address_street_num` INT(5) NOT NULL COMMENT 'Номер на улице' , 
    `address_apartment` INT(5) NOT NULL COMMENT 'Номер квартиры' , 
    PRIMARY KEY (`id`),
    INDEX (`id_user`)
)
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'address (таблийца адреса)';

ALTER TABLE `address` /*Связь таблиц User and Address по key (id_user Address) и (id User)*/
    ADD FOREIGN KEY (`id_user`) 
    REFERENCES `user`(`id`) 
    ON DELETE CASCADE ON UPDATE CASCADE;