
<?php include '../partials/header.php'; ?>
<?php 
include '../controllers/CompanyController.php';

$companyController = new CompanyController();
$companies = $companyController->listAll();
?>

<main>
    <form id="register-form" class="form">
        <input type="hidden" name="action" value="employee/create">
        <h1>Criar Funcionário</h1>

        <div class="input-container">
            <label for="username">Nome</label>
            <input type="text" id="name" placeholder="* Nome" name="name" required maxlength="50">
        </div>

        <div class="input-container">
            <label for="company">Empresa</label>
            <select name="company_id" id="company" required>
                <option selected disabled>Selecione a empresa...</option>
                <?php foreach($companies as $company): ?>
                <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-container">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="* Email" name="email" required maxlength="30">
        </div>
        <div class="input-container">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" placeholder="* CPF" name="cpf" required maxlength="11">
        </div>
        <div class="input-container">
            <label for="rg">RG</label>
            <input type="text" id="rg" placeholder="* RG" name="rg" required maxlength="20">
        </div>

        
        <button class="styled-button" type="submit">Salvar</button>
        
        <span id="error-message"></span>
        <span id="success-message"></span>
    </form>
</main>
<script>
    document.getElementById('register-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('../helpers/formHandler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    document.getElementById('error-message').innerText = data.message;
                    setTimeout(() => {
                        document.getElementById('error-message').innerText = '';
                    }, 3000);
                }

                if (data.status === 'success') {
                    document.getElementById('success-message').innerText = data.message;
                    setTimeout(() => {
                        document.getElementById('success-message').innerText = '';
                    }, 3000);
                }
            })
            .catch(error => {
                document.getElementById('error-message').innerText = 'An error occurred!';
                
                setTimeout(() => {
                    document.getElementById('success-message').innerText = '';
                }, 3000);
            });
    });
</script>
<?php include '../partials/footer.php'; ?>
