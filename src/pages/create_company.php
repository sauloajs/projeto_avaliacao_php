
<?php include '../partials/header.php'; ?>
<main>
    <form id="register-form" class="form">
        <input type="hidden" name="action" value="company/create">
        <h1>Criar Empresa</h1>

        <div class="input-container">
            <label for="username">Nome</label>
            <input type="text" id="name" placeholder="* Nome" name="name" required maxlength="50">
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
                document.getElementById('success-message').innerText = data.message;
                if (data.status === 'success') {
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
