<?php

namespace Models;

use PDO;

class User
{
    public $id;
    public $name;
    public $age;

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $name => $value) {
            $this->$name = $value;
        }
    }

    public static function all()
    {
        $conn = self::dbConnection();
        $stmt = $conn->query('SELECT * FROM users');
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $conn = self::dbConnection();
        $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public static function add($user)
    {
        $sql = 'INSERT INTO users (name, age) VALUES (:name, :age)';
        $params = [
            'name' => $user->name,
            'age' => $user->age,
        ];

        $conn = self::dbConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount() == 1;
    }

    public static function save($user)
    {
        $sql = 'UPDATE users SET name=:name, age=:age WHERE id=:id';
        $params = [
            'name' => $user->name,
            'age' => $user->age,
            'id' => $user->id,
        ];

        $conn = self::dbConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount() == 1;
    }

    public static function delete($id)
    {
        $sql = 'DELETE FROM users WHERE id=?';

        $conn = self::dbConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount() == 1;
    }

    private static $conn;
    public static function dbConnection()
    {
        if (!is_null(self::$conn)) {
            return self::$conn;
        }
        // Array destructuring
        [
            'host' => $host,
            'dbname' => $dbname,
            'user' => $user,
            'password' => $password,
            'charset' => $charset
        ] = config('db');

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        self::$conn = new PDO($dsn, $user, $password, $opt);

        return self::$conn;
    }
}
