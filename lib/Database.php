<?php
  /**
   * Database Connection
   */
  class Database
  {
    private $hostdb = 'localhost';
    private $userdb = 'root';
    private $passdb = '';
    private $namedb = 'houserent';
    public $link;

    function __construct()
    {
      if (!isset($link)) {
        try {
          $pdo = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb,$this->userdb,$this->passdb);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $pdo->exec("SET CHARACTER SET utf8");
          $this->link = $pdo;
        } catch (PDOException $e) {
          die("Failed to Connect with Database.".$e->getMessage());
        }
      }
    }


  }

 ?>
