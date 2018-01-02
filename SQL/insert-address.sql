/* 
 * TiJester
 * UA Odessa  * 
 */
/**
 * Author:  Grib
 * Created: 02.01.2018:09.00
 */

INSERT INTO `address` 
    (`id`, `id_user`, `address_country`, `address_city`, `address_street`, `address_street_num`, `address_apartment`) 
    VALUES 
    (NULL, '1', 'Украина', 'Одесса', 'Аграрная', '4', '0'),/*address_apartment - Не дает внести пустые значения*/ 
    (NULL, '2', 'Украина', 'Одесса', 'Добровольского', '78', '43')