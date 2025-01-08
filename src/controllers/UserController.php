<?php

require_once('../database/models/User.php');
require_once('../database/models/Company.php');
require_once('../database/models/Employee.php');
require_once('../database/conn.php');

class UserController {
    public function registerUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (User::usernameExists($username))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Usuário já existe'
            ]);
            exit;
        }
        
        $user = new User($username, $password);
        $user->store();

        echo json_encode([
            'status' => 'success',
            'message' => 'Usuário registrado com sucesso, você será redirecionado para a página de login'
        ]);
        exit;
    }

    public function loginUser() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = (new User())->findByUsername($username);
        
        if($user->verifyPassword($password) === false) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Senha incorreta'
            ]);
            exit;
        }
        
        session_start();

        $_SESSION['user'] = $user->username;
        $_SESSION['logged_in'] = true;

        echo json_encode([
            'status' => 'success',
            'message' => 'Login efetuado com sucesso'
        ]);
        exit;
    }

    public function logoutUser() {
        session_start();
        session_destroy();
        header('Location: ./login.php');
    }

    public function listUsers() {
        $users = (new User())->listAll();

        return $users;
    }
}