<?php

require_once __DIR__ . '/Model.php';

class Tweet extends Model
{

  public $table = 'tweet';
  public $fields = [
    'created_at' => '',
    'id_str' => '',
    'retweet_count' => '',
    'user' => '',
    'text' => '',
    'hashtag' => ''
  ];

  public function __construct($createdAt, $id, $retweetCount, $user, $text, $hashtag)
  {
    parent::__construct();
    $this->fields['created_at'] = $createdAt;
    $this->fields['id_str'] = $id;
    $this->fields['retweet_count'] = $retweetCount;
    $this->fields['user'] = $user;
    $this->fields['text'] = $text;
    $this->fields['hashtag'] = $hashtag;
  }

  public function exists()
  {
    $exists = $this->conn->fetchArray("SELECT id FROM {$this->table} WHERE id_str=?", [$this->fields['id_str']]);
    if($exists)
    {
      $this->id = $exists[0];
      return [
        'id' => $exists[0]
      ];
    }
    else
    {
      return false;
    }
  }

  public function queryAll()
  {
    $ps = $this->conn->fetchAll("SELECT * FROM {$this->table} ORDER BY id DESC");
    return $ps;
  }

}
