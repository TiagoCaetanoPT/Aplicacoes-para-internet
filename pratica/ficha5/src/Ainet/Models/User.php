<?php

namespace Ainet\Models;
use PDO;

class User
{
  public $user_id;
  public $email;
  public $password;
  public $fullname;
  public $registered_at;
  public $type;

  public function __construct(array $attributes = [])
  {
    foreach ($attributes as $name => $value) {
      $this->$name = $value;
    }
  }

  public function typeToStr()
  {
    switch ($this->type) {
      case 0:
      return 'Administrator';
      case 1:
      return 'Publisher';
      case 2:
      return 'Client';
    }

    return 'Unknown';
  }

//------------------------------------ LIGAÇÃO À BASE DE DADOS
  public static function conn()
  {
    $host='localhost';
    $dbname='ainet_p5';
    $user='root';
    $password='';
    $charset='utf8';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    return new PDO($dsn, $user, $password, $opt);
  }

//------------------------------------ APRESENTAÇÃO DE TODOS OS DADOS
  public static function all()
  {
    $pdo=static::conn();

    $sql = 'SELECT fullname, email, registered_at, type FROM users';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchALL(PDO::FETCH_CLASS, static::class);
}

public static function find($userId)
{
  $users = static::all();
  if (array_key_exists($userId, $users)) {
    return $users[$userId];
  }

  return;
}

public static function add($user)
{
  //$hash = PASSWORD_HASH($user['password'], PASSWORD_DEFAULT);
  $pdo=static::conn();

  // $sql = 'INSERT INTO users (fullname, email, password, type)
  //         VALUES (:fullname, :email, $hash, $user["type"])';
  $sql = "INSERT INTO users (fullname, email, password, type)
          VALUES (:fullname, :email, :password, :type)";

  $stmt = $pdo->prepare($sql);
  $stmt->execute(['fullname' => $user->fullname, 'email' => $user->email, "password" => $user->password, "type" => $user->type]);

  //var_dump($user);
  //die('INSERT STATEMENT HERE');
}

public static function save($user)
{
  var_dump($user);
  die('UPDATE STATEMENT HERE');
}

public static function delete($userId)
{
  var_dump($userId);
  die('DELETE STATEMENT HERE');
}
}
