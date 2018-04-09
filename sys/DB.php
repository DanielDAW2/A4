<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Sys;

/**
 * Description of PDO
 *
 * @author linux
 */
class DB extends \PDO {
    
    private $stmt;
    static protected $instance;
    
    public function query($stmt)
    {
        $this->stmt = self::$instance->prepare($stmt);
    }
    
    public function __construct(){
        
        $filename = __DIR__."/config.json";
        $dbconf = (array)json_decode(file_get_contents($filename));
        $dsn = $dbconf['dbdriver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
        $username = $dbconf['dbuser'];
        $password = $dbconf['dbpass'];  
        
        return parent::__construct($dsn, $username, $password);
        
    }

    public function getInstance(){
        
        if(!self::$instance instanceof self){         
            try
            {
                self::$instance = new self();
            } catch (PDOException  $ex) {
                echo $ex->getMessage();
            }
            
            
        }
        return self::$instance;
    }
    
    public function execute() {
    
        return $this->stmt->execute();
    }
   
    public function bind($key,$value)
    {
        $type = NULL;
        
        switch (true)
        {
            case is_int($value):
                $type = \PDO::PARAM_INT;
                break;
            case is_string($value):
                $type = \PDO::PARAM_STR;
                break;
            case is_bool($value):
                $type = \PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = \PDO::PARAM_NULL;
                break;
        }
        $this->stmt->bindParam($key,$value,$type);
    }
    
    public function resultSet()
    {
        return $this->stmt->FetchAll();
    }
}