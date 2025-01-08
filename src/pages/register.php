
<?php include '../partials/header.php'; ?>
<?php 
include '../controllers/CompanyController.php';

$companyController = new CompanyController();
$companies = $companyController->listAll();
?>

<main>
    <form id="register-form" class="form">
        <input type="hidden" name="action" value="user/register">
        <h1>Registrar-se</h1>

        <div class="input-container">
            <label for="username">Nome de usuário</label>
            <input type="text" id="username" placeholder="* Nome" name="username" required maxlength="40" minlength="3" inputmode="text">
        </div>

        <div class="input-container">
            <label for="password">Senha</label>
            <input type="password" id="password" placeholder="* Senha" name="password" required maxlength="10" minlength="6">
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
                        window.location.href = './login.php';
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
