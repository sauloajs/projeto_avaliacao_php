<?php include '../partials/header.php'; ?>
<?php
    session_start();
    include '../controllers/EmployeeController.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ./login.php');
    }

    $employeeController = new EmployeeController();
    $employees = $employeeController->listEmployees();
?>
<main class="content">
    <h2 class="main-title">Funcionários</h2>
    <table class="table">
        <thead>
            <tr class="table-header">
                <th class="table-cell">#</th>
                <th class="table-cell">Email</th>
                <th class="table-cell">Nome</th>
                <th class="table-cell">RG</th>
                <th class="table-cell">CPF</th>
                <th class="table-cell">Company</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee) : ?>
                <tr class="table-row">
                    <td class="table-cell"><?= $employee['user_id'] ?></td>
                    <td class="table-cell"><?= $employee['email'] ?></td>
                    <td class="table-cell"><?= $employee['name'] ?></td>
                    <td class="table-cell"><?= $employee['rg'] ?></td>
                    <td class="table-cell"><?= $employee['cpf'] ?></td>
                    <td class="table-cell"><?= $employee['company_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include '../partials/footer.php'; ?>