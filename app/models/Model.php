<?php

abstract class Model
{

  protected $config;
  protected $connectionParams;
  protected $conn;

  public function __construct()
  {
    $this->config = new \Doctrine\DBAL\Configuration();
    $this->connectionParams = [
      'dbname'   => DB_NAME,
      'user'     => DB_USERNAME,
      'password' => DB_PASSWORD,
      'host'     => DB_HOST,
      'driver'   => 'pdo_mysql',
      'encoding' => 'utf8',
    ];

    $this->conn = \Doctrine\DBAL\DriverManager::getConnection($this->connectionParams, $this->config);
  }

  public function save()
  {
    $exists = $this->exists();
    if($exists)
    {
      return $this->conn->update($this->table, $this->fields, $exists);
    } else
    {
      $result = $this->conn->insert($this->table, $this->fields);
      $this->id = $result ? $this->conn->lastInsertId() : null;
      return $result;
    }
  }

  public abstract function exists();

  public function queryAll()
  {
    $ps = $this->conn->fetchAll("SELECT * FROM {$this->table}");
    return $ps;
  }

}
