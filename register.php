<?php include './views/header.php'  ?>

    <div class="container my-3">
        <h1 class="text-center" style="color: var(--blue);">Registro</h1>
        <form method="post" action="./classes/user.php" class="w-50 mx-auto">
            <div class="mb-2">
                <label for="name" class="form-label">Nombres</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Ingresa tu nombre">
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Apellidos</label>
                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Ingresa tu apellido">
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Contraseña</label>
                <input name="pswd" type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
            </div>
            <div class="mb-2">
                <label for="captcha" class="form-label">Captcha</label>
                <input name="captcha" type="captcha" class="form-control" placeholder="Ingresa el resultado">
            </div>
            <select name="gender" class="form-select mb-2" aria-label="Default select example">
                <option value="h">Hombre</option>
                <option value="m">Mujer</option>
            </select>
            <button type="submit" class="btn btn-primary" style="background-color: var(--blue);">Registrarse</button>
            <input name="action" value="register" type="hidden">
        </form>
    </div>
</body>

</html>
