<?php 

class Employee
{
    public static function store($company_id, $user_id, $name, $rg, $cpf, $email) 
    {
        $connection = (new conn())->create_connection();
        $sql = "INSERT INTO employees (company_id, user_id, name, rg, cpf, email) VALUES ('$company_id', '$user_id', '$name', '$rg', '$cpf', '$email')";

        if(!mysqli_query($connection, $sql))
        {
            throw new Exception('Erro ao registrar funcionário');
        }
    }

    public static function listAll()
    {
        $connection = (new conn())->create_connection();
        $sql = "SELECT 
                    emp.company_id as company_id,
                    emp.name as name,
                    emp.email as email,
                    emp.rg as rg,
                    emp.cpf as cpf, 
                    usr.username as username, 
                    usr.id as user_id, 
                    comp.name as company_name 
                FROM employees emp 
                INNER JOIN users usr ON emp.user_id = usr.id 
                INNER JOIN companies comp ON emp.company_id = comp.id";
        $result = mysqli_query($connection, $sql);

        $employees = [];

        while($employee = mysqli_fetch_assoc($result))
        {
            $employees[] = $employee;
        }

        return $employees;
    }
}