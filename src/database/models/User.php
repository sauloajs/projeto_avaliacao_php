<?php

class User {
    private int $id;
    public ?string $username;
    protected ?string $password;
    
    public function __construct($username = null, $password = null) 
    {
        $this->password = $password;
        $this->username = $username;
    }

    public function store() 
    {
        $connection = (new conn())->create_connection();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$this->username', '$this->password')";

        if(!mysqli_query($connection, $sql)){
            throw new Exception('Erro ao registrar usuário');
        }

        return mysqli_insert_id($connection);
    }

    public function findByUsername($username) 
    {
        $connection = (new conn())->create_connection();
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $sql);
        $user = mysqli_fetch_assoc($result);

        if(!$user) {
            throw new Exception('Usuario/Senha inválidos');
        }

        $this->id = $user['id'];
        $this->username = $user['username'];
        $this->password = $user['password'];

        return $this;
    }

    public static function usernameExists($username)
    {
        $connection = (new conn())->create_connection();
        $sql = "SELECT count(*) FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $sql);
        $count = mysqli_fetch_assoc($result);

        return $count['count(*)'] > 0;
        
    }

    public function verifyPassword($password) 
    {
        return password_verify($password, $this->password);
    }

    public static function listAll() 
    {
        $connection = (new conn())->create_connection();
        $sql = "SELECT * FROM users";
        $result = mysqli_query($connection, $sql);
        $users = [];

        while($user = mysqli_fetch_assoc($result)) {
            $users[] = $user;
        }

        return $users;
    }
}