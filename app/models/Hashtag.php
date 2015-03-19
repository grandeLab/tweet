<?php

require_once __DIR__ . '/Model.php';

class Hashtag extends Model
{

  public $table = 'hashtag';
  public $fields = [
    'hashtag' => ''
  ];

  public function __construct($hashtag)
  {
    parent::__construct();
    $this->fields['hashtag'] = $hashtag;
  }

  public function getHashtag()
  {
    return $this->fields['hashtag'];
  }

  public function exists()
  {
    $exists = $this->conn->fetchArray("SELECT id FROM {$this->table} WHERE hashtag=?", [$this->fields['hashtag']]);
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

}
