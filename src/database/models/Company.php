<?php

class Company 
{
    public int $id;
    public string $name;

    public function __construct($name = null) 
    {
        $this->name = $name;
    }

    public function store() 
    {
        $connection = (new conn())->create_connection();
        $sql = "INSERT INTO companies (name) VALUES ('$this->name')";

        if(!mysqli_query($connection, $sql)){
            throw new Exception('Erro ao registrar empresa');
        }
    }

    public static function find($id) 
    {
        $connection = (new conn())->create_connection();
        $sql = "SELECT * FROM companies WHERE id = '$id'";
        $result = mysqli_query($connection, $sql);
        $company = mysqli_fetch_assoc($result);

        if(!$company) {
            throw new Exception('Empresa não encontrada');
        }

        return $company;
    }

    public static function listAll() 
    {
        $connection = (new conn())->create_connection();
        $sql = "SELECT * FROM companies";
        $result = mysqli_query($connection, $sql);
        $companies = [];

        while($company = mysqli_fetch_assoc($result)) {
            $companies[] = $company;
        }

        return $companies;
    }
}