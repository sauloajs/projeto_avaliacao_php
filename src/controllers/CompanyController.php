<?php

require_once('../database/models/Company.php');
require_once('../database/conn.php');

class CompanyController
{
    public function storeCompany() 
    {
        $name = $_POST['name'];

        if (empty($name)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Preencha todos os campos'
            ]);

            exit;
        }

        if (strlen($name) > 40) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nome da empresa deve ter no máximo 40 caracteres'
            ]);

            exit;
        }

        $company = new Company($name);
        $company->store();

        echo json_encode([
            'status' => 'success',
            'message' => 'Empresa registrada com sucesso'
        ]);

        exit;
    }

    public function listAll() 
    {
        return Company::listAll();
    }
}