<?php
class config
{
    private $host="localhost";
    private $user="root";
    private $dbname="local";
    private $password="thepassword";
    
    function __get($name) 
    {
        return $this->$name;
    }
    
    function __set($name, $value) 
    {
        $this->$name=$value;
    }
}

$config = new config();
echo $config->host."<br/>";
$config->host="127.0.0.1";
echo $config->host;
?>

