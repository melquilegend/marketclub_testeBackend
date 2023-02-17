<?php
require_once 'includes/loginheader.php' ?>
<form action="index.php" method="post">
    <legend>FAÇA SEU LOGIN</legend>
    <p>Digite seu CPF no campo abaixo e clique em logar para fazer seu login.</p>

    <div class="input">
        <input type="text" id="input_login" name="cpf" placeholder="Digite seu CPF" required>
        <label for="input_login">CPF:</label>
    </div>
    <div class="input">
        <input type="password" id="input_senha" placeholder="Senha" inputmode="numeric" name="senha">
        <label for="input_senha">Senha</label>
    </div>

    <button type="submit" name="logar">LOGAR</button>
</form>
</div>
</body>

</html>