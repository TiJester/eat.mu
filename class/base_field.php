<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класса base_field
 * Базовый класс элемента управления HTML формы,
 * от него наследуються все остальные элеметы управления формы
 * V 0.1
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

abstract class base_field{
/*    
*  Члены класса:
*/
    
    //  Имя элемента управлния
    protected $name;
    //  Тип элемента управлния
    protected $type;
    //  Название слева от элемента управлния
    protected $caption; 
    //  Значение элемента управлния
    protected $value;    
    //  Проверка, обязателен или нет элемента управлния
    protected $is_required;
    //  Строка дополнительных параметров
    protected $parameters;
    //  Подсказка элемента управлния
    protected $help;
    //  Ссылка на подсказку
    protected $help_url;

    //  Класс CSS
    public $css_class;
    //  Стиль CSS
    public $css_style;
    
/*
 * Методы класса
 */
    //  Конструктор класса
    function __construct(
            $name, 
            $type, 
            $caption, 
            $is_required = false, 
            $value, 
            $parameters ="", 
            $help, 
            $help_url = "")
    {
        $this->name = $this->encodestring($name);
        $this->type = $type;
        $this->caption = $caption;
        $this->is_required = $is_required;
        $this->parameters = $parameters;
        $this->help = $help;
        $this->help_url = $help_url;
    }
    
    //  Метод проверки на корректоность заполнения поля
    abstract function check();
    
    //  Абстрактный метод, для возврата инини названия поля
    //  с самого тэга элемента управления
    //  (каждый наследник должен переопределить этот метод)
    abstract function get_html();
    
    //  Доступ к закрытым и защищенным элементам класса
    //  Только для чтения
    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
        else 
        {
            throw new ExceptionMember ($key, "Член".__CLASS__."::$key не существует");
        }    
    }
    
    //  Функция перевода текста с русского в транслит
    protected function encodestring($str)
    {
        //  Заменяем односимвольные
        $str = strtr($str, "абвгдеёзийклмнопрстуфхъыэ_", 
                           "abvgdeeziyklmnoprstufh'iei");
        $str = strtr($str, "АБВГДЕЁЗИЙКЛМНОПРСТУФЪЫЭ_",
                           "ABVGDEEZIYKLMOPRSTUFH'IEI");
        //  Заменяем многосимвольные
        $str = strtr($str, 
                array(
                    "ж"=>"zh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", 
                    "щ"=>"shch","ь"=>"","ю"=>"yu","я"=>"ya",
                    "Ж"=>"ZH", "Ц"=>"TS", "Ч"=>"CH", "Ш"=>"SH",
                    "Щ"=>"SHCH", "Ь"=>"", "Ю"=>"YU", "Я"=>"YA",
                    "ї"=>"i", "Ї"=>"Yi", "є"=>"ie", "Є"=>"Yi"
                    )
                );
        // Возвращаем результат
        return $str;
    }
    
}
