<?php

//namespace app\commands\tmp;

//use Yii;

$classAlias = new Alias();
$classAlias->checkNum();

class Alias{
    
    protected $_db;
    
    public function __construct()
    {        
        $this->connectDB();
    }
    
    public function connectDB()
    {        
//        $param_DB = 'methold_v2_dev';
//        $param_HOST = 'localhost';
//        $param_USER = 'root';
//        $param_PASSWORD = 'root'; 
        
        $param_DB = 'methold_v2';
        $param_HOST = 'methold.mysql.ukraine.com.ua';
        $param_USER = 'methold_v2';
        $param_PASSWORD = '7l723nqw'; 
        
        $db = new PDO('mysql:dbname='.$param_DB.';host='.$param_HOST, $param_USER, $param_PASSWORD);
                
        if(!$db) die('Connection to madads failed');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        $this->_db = $db; 
    }
    
    public function checkNum()
    {
        $sql = "
            SELECT p.id,
                   p.external_id, 
                   p.title_ru, 
                   p.alias,
                   p2.id AS id_2,
                   p2.external_id AS external_id_2,
                   p2.title_ru AS title_ru_2,
                   p2.alias AS alias_2	   
            FROM `products` AS p
            JOIN `products_v2` AS p2 ON p2.external_id = p.external_id 
                                 AND p2.alias != p.alias 
            WHERE p.alias REGEXP '^[0-9]+$'
              AND p2.alias LIKE CONCAT('%', p.alias ,'%')
              AND p2.alias NOT LIKE '%-nzh-%'
              AND p2.alias NOT LIKE '%-2'
              AND p2.alias NOT LIKE '%-3'
              AND p2.alias NOT LIKE '%-4'
            GROUP BY p.title_ru
            ORDER BY p.title_ru ASC, p.external_id ASC
        ";
        
        $query = $this->_db->query($sql) or die($this->_db->errorinfo());
        $query->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $query->fetch()){
var_dump($row);
            $sqlUpdate = "UPDATE `products` SET `alias` = '".$row['alias_2']."' WHERE id = '".$row['id']."' LIMIT 1";
            //$this->_db->query($sqlUpdate) or die($this->_db->errorinfo()); 
 exit();
        }
    }    
        
//    public function check()
//    {
//        $sql = "
//            SELECT p.id,
//                   p.external_id, 
//                   p.title_ru, 
//                   p.alias,
//                   p2.id AS id_2,
//                   p2.external_id AS external_id_2,
//                   p2.title_ru AS title_ru_2,
//                   p2.alias AS alias_2	   
//            FROM `products` AS p
//            JOIN `products_v2` AS p2 ON p2.external_id = p.external_id 
//                                 AND p2.alias != p.alias 
//            LEFT JOIN `products_v2` AS p3 ON p3.alias = p.alias                     
//            WHERE p.alias NOT REGEXP '^[0-9]+$'
//              /*AND p2.alias NOT LIKE CONCAT('%', p.alias ,'%')*/              
//              AND p2.alias NOT LIKE '%-nzh-%'
//              AND p2.alias NOT LIKE '%alyum-%'
//              AND p2.alias NOT LIKE '%-2'
//              AND p2.alias NOT LIKE '%-3'
//              AND p2.alias NOT LIKE '%-4'
//              AND p3.id IS NULL
//            GROUP BY p.title_ru
//            ORDER BY p.title_ru ASC, p.external_id ASC
//        ";
//        
//        $query = $this->_db->query($sql) or die($this->_db->errorinfo());
//        $query->setFetchMode(PDO::FETCH_ASSOC);
//
//        while($row = $query->fetch()){
//var_dump($row);
//            $sqlUpdate = "UPDATE `products` SET `alias` = '".$row['alias_2']."' WHERE id = '".$row['id']."' LIMIT 1";
//            //$this->_db->query($sqlUpdate) or die($this->_db->errorinfo()); 
// exit();
//        }
//    }
    

    
}