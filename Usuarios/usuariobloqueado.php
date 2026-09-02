<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuario Bloqueado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #DAD7CD;
            text-align: center;
            padding-top: 100px;
        }
        .caja {
            background: white;
            width: 400px;
            margin: auto;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
        }
        h2 {
            color: #344E41;
            margin-bottom: 15px;
        }
        p {
            color: #588157;
            font-size: 15px;
            margin-bottom: 25px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            margin: 5px;
        }
        .btn-login {
            background: #344E41;
            color: white;
        }
        .btn-crear {
            background: #A3B18A;
            color: #344E41;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="caja">
        <h2>Su cuenta está bloqueada</h2>
        <p>No tiene acceso al sistema. Contacte al administrador.</p>

        <a href="login.php">
            <button class="btn-login">Iniciar Sesión</button>
        </a>

        <a href="crearusuario.php">
            <button class="btn-crear">Crear Cuenta</button>
        </a>
    </div>

</body>
</html>