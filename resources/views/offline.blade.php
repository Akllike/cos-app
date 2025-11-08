<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#6366f1">
    <title>Нет соединения - Cos App</title>
    <style>
        body {
            font-family: ui-sans-serif, system-ui;
            background-color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        h1 {
            color: #1f2937;
            margin-bottom: 1rem;
        }
        p {
            color: #6b7280;
            margin-bottom: 2rem;
        }
        button {
            background-color: #6366f1;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #5b5cdb;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Нет соединения</h1>
    <p>Проверьте подключение к интернету и попробуйте снова</p>
    <button onclick="location.reload()">Попробовать снова</button>
</div>
</body>
</html>
