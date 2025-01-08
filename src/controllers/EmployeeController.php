<?php 

require_once '../database/models/Employee.php';
require_once('../database/conn.php');

class EmployeeController {
    public function storeEmployee() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $company_id = $_POST['company_id'];
        
        try {
            $this->validateForm($name, $email, $rg, $cpf, $company_id);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            exit;
        }

        $user = new User($email, 'password');
        $company = Company::find($_POST['company_id']);
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        try {
            $user_id = $user->store();
            
            Employee::store($company['id'], $user_id, $name, $rg, $cpf, $email);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Funcionário registrado com sucesso'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        exit;
    }

    public function listEmployees() {
        return Employee::listAll();
    }

    private function validateForm($name, $email, $rg, $cpf, $company_id)
    {
        if(empty($name) || empty($email) || empty($rg) || empty($cpf) || empty($company_id))
        {
            throw new Exception('Preencha todos os campos');
        }

        if(strlen($name) > 50)
        {
            throw new Exception('Nome deve ter no máximo 50 caracteres');
        }

        if(strlen($email) > 30)
        {
            throw new Exception('Email deve ter no máximo 30 caracteres');
        }

        if(strlen($rg) > 20)
        {
            throw new Exception('RG deve ter no máximo 20 caracteres');
        }

        if(strlen($cpf) > 11 || strlen($cpf < 11))
        {
            throw new Exception('CPF deve ter 11 caracteres');
        }

        if(!is_numeric($cpf))
        {
            throw new Exception('CPF inválido');
        }

        if(!is_numeric($company_id))
        {
            throw new Exception('ID da empresa inválido');
        }

        if (User::usernameExists($email)) 
        {
            throw new Exception('Usuário já cadastrado');
        }

        return true;
    }
}