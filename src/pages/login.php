<?php include '../partials/header.php'; ?>

<main>
    <form id="login-form" class="form">
        <h1>Login</h1>
        <input type="hidden" name="action" value="user/login">
        <div class="input-container">
            <label for="floatingInput">Username</label>
            <input 
                type="text" 
                id="username" 
                placeholder="* Username" 
                name="username"
                required
            >
        </div>
        <div class="input-container">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                placeholder="* Password" 
                name="password"
                required
            >
        </div>
        <button class="styled-button" type="submit">Login</button>

        <span id="error-message"></span>
        <span id="success-message"></span>
    </form>
</main>
<script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('../helpers/formHandler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = './home.php';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('An error occurred!');
            });
    });
</script>
<?php include '../partials/footer.php'; ?>
