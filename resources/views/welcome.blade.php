<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
        }

        .buttons {
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
        }

        .btn-register {
            background-color: #28a745;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>¡Bienvenido a nuestra aplicación!</h1>
    <p>Para continuar, por favor inicia sesión o regístrate si aún no tienes una cuenta.</p>

    <div class="buttons">
        <a href="{{ route('login') }}">
            <button class="btn btn-login">Iniciar sesión</button>
        </a>
        <a href="{{ route('register') }}">
            <button class="btn btn-register">Registrarse</button>
        </a>
    </div>
</div>

</body>
</html>
