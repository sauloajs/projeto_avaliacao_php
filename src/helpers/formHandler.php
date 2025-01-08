<?php

include '../controllers/UserController.php';
include '../controllers/EmployeeController.php';
include '../controllers/CompanyController.php';

$userController = new UserController();
$employeeController = new EmployeeController();
$companyController = new CompanyController();

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['action']) {
            case 'user/register':
                $userController->registerUser();
                break;
            case 'user/login':
                $userController->loginUser();
                break;
            case 'employee/create':
                $employeeController->storeEmployee();
                break;
            case 'company/create':
                $companyController->storeCompany();
                break;
            default:
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid action',
                ]);
                break;
        }
    }
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);

    exit;
}