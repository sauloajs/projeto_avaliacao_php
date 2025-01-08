<?php
session_start();
$loggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Teste PHP</title>
    <link rel="stylesheet" href="../assets/style.css" />
</head>

<body>
    <div class="container">
        <?php if (!$loggedIn): ?>
        <header>
            <div>
                <h4>
                    Teste PHP
                </h4>
            </div>
            <div>
                <a href="../pages/login.php">Login</a>
                <a href="../pages/register.php">Cadastre-se</a>
            </div>
        </header>
        <?php else: ?>
        <header>
            <div>
                <a href="../pages/home.php">
                    Home
                </a>
            </div>

            <nav id="header-nav">
                <a href="../pages/create_employee.php">Novo Funcionário</a>
                <a href="../pages/create_company.php">Nova Empresa</a>
            </nav>
        </header>
        <?php endif; ?>