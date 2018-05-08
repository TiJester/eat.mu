<?php

/*
 * TiJester
 * UA Odessa  * 
 */

/**
 * 2018(С) Шевченко Г.Ю.
 * Описание класа pager
 * Абстрактный класс постраничной навигации __toString()
 * Альтернативный вывод навигации print_page()
 * V 0.2.0
 */

//  Выставляем уровень обработки ошибок
error_reporting(E_ALL & ~E_NOTICE);

abstract class pager {
    abstract function get_total();
    abstract function get_pnumber();
    abstract function get_page_link();
    abstract function get_parameters();
    
    //  Ссылка на другие страницы
    public function __toString() {
        //  Строка для возвращаемого резульата
        $return_page = "";
        
        //  Через GET-параметр page передаеться номер текущей страницы
        $page = intval($_GET['page']);
        if(empty($page)){
            $page = 1;
        }
        
        //  Вычисляем число страницы в системе
        $number = (int)($this->get_total()/$this->get_pnumber());
        if((float)($this->get_total()/$this->get_pnumber()) - $number !=0){
            $number++;
        }
        
        //  Проверяем есть ли ссылка слева
        if($page - $this->get_page_link() > 1){
            $return_page .= "<a href=$_SERVER[PHP_SELF]?page=1{$this->get_parameters()}>[1-{$this->get_pnumber()}]</a>&nbsp;&nbsp;...&nbsp;&nbsp;";
            //  Есть
            for($i = $page - $this->get_page_link(); $i < $page; $i++){
                $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$this->get_parameters()}>[".(($i - 1)*$this->get_pnumber() + 1)."-".$i*$this->get_pnumber()."]</a>$nbsp;";
            }
        }
        else {
            //  Нет
            for($i = 1; $i<$page; $i++){
                $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$this->get_parameters()}>[".(($i-1)*$this->get_pnumber()+1)."-".$i*$this->get_pnumber()."]</a>&nbsp;";
            }
        }
        
        //  Проверяем есть ли ссылки справа
        if($page + $this->get_page_link() < $number){
            //  Есть
            for($i = $page; $i<=$page+$this->get_page_link(); $i++){
                if($page == $i){
                    $return_page .= "&nbsp;[".(($i-1)*$this->get_pnumber() + 1)."-".$i*$this->get_pnumber()."]&nbsp;";
                }
                else{
                    $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$this->get_parameters()}>[".(($i-1)*$this->get_pnumber() + 1)."-".$i*$this->get_pnumber()."]</a>&nbsp;";
                }
            }
            $return_page .= "&nbsp;...&nbsp;&nbsp;<a href=$_SERVER[PHP_SELF]?page=$number{$this->get_parameters()}>[".(($number-1)*$this->get_pnumber() + 1)."-{$this->get_total()}]</a>$nbsp;";
        }
        else{
            //  нет
            for($i = $page; $i <= $number; $i++){
                if($number == $i){
                    if($page == $i){
                        $return_page .= "&nbsp;[".(($i - 1)*$this->get_pnumber() + 1)."-{$this->get_total()}]&nbsp;";
                    }
                    else{
                        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$this->get_parameters()}>[".(($i - 1)*$this->get_pnumber() + 1)."-{$this->get_total()}]</a>&nbsp;";
                    }
                }
                else{
                    if($page == $i){
                        $return_page .= "&nbsp;[".(($i - 1)* $this->get_pnumber() + 1)."-".$i*$this->get_pnumber()."]&nbsp;";
                    }
                    else{
                        $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$this->get_parameters()}>[".(($i - 1)*$this->get_pnumber() + 1)."-".($i*$this->get_pnumber())."]</a>&nbsp;";
                    }
                }
            }
        }
        return $return_page;
    }
    
    
    //  Альтернативный вид постраничной навигации
    public function print_page(){
        //  Строка для возвращаемого результата
        $return_page = "";
        
        //  Через GET-параметр page передаеться номер текущей страницы
        $page = intval($_GET['page']);
        if(empty($page)) {
            $page = 1;
        }
        
        //  Вычисляем число страниц в системе
        $number = (int)($this->get_total()/$this->get_pnumber());
        if((float)($this->get_total()/$this->get_pnumber()) - $number !=0){
            $number++;
        }
        
        //  Ссылка на первую страницу
        $return_page .= "<a href='$_SERVER[PHP_SELF]?page=1{$this->get_parameters()}'>&lt;&lt;</a> ... ";
        
        //  Выводим ссылку назад если это не первая страница
        if($page != 1){
            $return_page .= "<a href='$_SERVER[PHP_SELF]?page=".($page - 1)."{$this->get_parameters()}'>&lt;</a> ...";
        }
        
        //  Выводим предыдущие элементы
        if($page > $this->get_page_link() + 1){
            for($i = $page - $this->get_page_link(); $i < $page; $i++){
                $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a>";
            }
        }
        else {
            for($i = 1; $i < $page; $i++){
                $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a>";
            }
        }
        
        //  Выводим текущий элемент
        $return_page .= "$i";
        //  Выводим следующие элементы
        if($page + $this->get_page_link() < $number){
            for($i = $page + 1; $i <= $page + $this->get_page_link(); $i++){
                $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a>";
            }
        }
        else {
            for($i = $page + 1; $i <= $number; $i++){
                $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a>";
            }
        }
        
        //  Выводим ссылку вперед если это не последняя страница
        if($page != $number){
            $return_page .= " ... <a href='$_SERVER[PHP_SELF]?page=".($page + 1). "{$this->get_parameters()}'>&gt;</a>";
        }
        
        //  Ссылка на соследную страницу
        $return_page .= " ... <a href='$_SERVER[PHP_SELF]?page=$number{$this->get_parameters()}'>&gt;&gt;</a>";
        
        return $return_page;
    }
}
