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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;       
        }
        .caja {
            background: white;
            width: 700px;
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
        }
        h2 {
            color: #344E41;
            font-size: 35px;
            margin-bottom: 15px;
        }
        p {
            color: #588157;
            font-size: 20px;
            margin-bottom: 25px;
        }
        button {
            padding: 30px 40px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
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
<?php include '../header.php'; ?>
    <div class="caja">
        <h2>Su cuenta está bloqueada</h2>
        <p>No tiene acceso al sistema. Contacte al administrador y vuelva a intentarlo.</p>
<br>
        <a href="login.php">
            <button class="btn-login">Iniciar Sesión</button>
        </a>

    </div>

</body>
</html>