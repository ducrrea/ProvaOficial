<?php
$usuarioLogado = $_SESSION['usuario_nome'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'VetCare — Clínica Veterinária') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: #fdf2f8;
            margin: 0;
            color: #500724;
        }
        header {
            background: linear-gradient(90deg, #ffffff 0%, #fff5f8 100%);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #fbcfe8;
            box-shadow: 0 4px 16px rgba(190, 24, 93, 0.06);
        }
        header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #831843;
            margin: 0;
            letter-spacing: 0.3px;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        nav a {
            color: #9d174d;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }
        nav a:hover {
            color: #db2777;
        }
        .user-tag {
            background: #fce7f3;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #f9a8d4;
            color: #831843;
        }
        .container {
            max-width: 1050px;
            margin: 32px auto;
            padding: 0 20px;
        }
        .card {
            background: linear-gradient(180deg, #ffffff 0%, #fff5f8 100%);
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #fbcfe8;
            box-shadow: 0 12px 30px rgba(190, 24, 93, 0.08);
        }
        .card h2, .card h3 {
            font-family: 'Playfair Display', serif;
            color: #831843;
            margin-top: 0;
            letter-spacing: 0.3px;
        }
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-top: 20px;
        }
        .stat-box {
            background: linear-gradient(180deg, #ffffff 0%, #fdf2f8 100%);
            padding: 20px;
            border-radius: 14px;
            text-align: center;
            border: 1px solid #fbcfe8;
            box-shadow: 0 4px 14px rgba(190, 24, 93, 0.05);
        }
        .stat-box span {
            font-size: 0.8rem;
            color: #9d174d;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.4px;
        }
        .stat-box strong {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: #831843;
            margin-top: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
            font-size: 0.9rem;
        }
        th, td {
            padding: 13px 14px;
            text-align: left;
            border-bottom: 1px solid #fce7f3;
            color: #500724;
        }
        th {
            color: #831843;
            font-weight: 600;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            background: #fdf2f8;
            border-top: 1px solid #fbcfe8;
            border-bottom: 2px solid #f9a8d4;
        }
        tbody tr:hover {
            background-color: #fff1f5;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #f472b6 0%, #db2777 100%);
            color: #ffffff;
            padding: 9px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(219, 39, 119, 0.2);
            transition: transform 0.15s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .btn:hover {
            filter: brightness(1.06);
            box-shadow: 0 6px 16px rgba(219, 39, 119, 0.3);
            transform: translateY(-1px);
            color: #ffffff;
        }
        .btn-success {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            box-shadow: 0 4px 14px rgba(190, 24, 93, 0.25);
        }
        .btn-success:hover {
            filter: brightness(1.06);
            box-shadow: 0 6px 18px rgba(190, 24, 93, 0.35);
        }
        .btn-danger {
            background: linear-gradient(135deg, #fb7185 0%, #e11d48 100%);
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.22);
        }
        .btn-danger:hover {
            filter: brightness(1.06);
            box-shadow: 0 6px 16px rgba(225, 29, 72, 0.32);
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-size: 0.88rem;
            margin-bottom: 6px;
            color: #9d174d;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        input, select, textarea {
            width: 100%;
            padding: 11px 14px;
            border-radius: 10px;
            border: 1.5px solid #f9a8d4;
            background: #ffffff;
            color: #500724;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            box-sizing: border-box;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        input::placeholder, textarea::placeholder {
            color: #d88ca8;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #db2777;
            box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.14);
        }
        .alerta-erro {
            background: #ffe4e6;
            border: 1px solid #fda4af;
            color: #9f1239;
            padding: 11px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 0.85rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
<header>
    <h1>ClinicAu — Gestão Veterinária</h1>
    <nav>
        <?php if ($usuarioLogado): ?>
            <a href="/">Painel</a>
            <a href="/tutores">Tutores</a>
            <a href="/pets">Pets</a>
            <a href="/agendamentos">Agendamentos</a>
            <span class="user-tag"> <?= htmlspecialchars($usuarioLogado) ?></span>
            <form action="/logout" method="POST" style="display:inline;margin:0;">
                <button type="submit" class="btn btn-danger" style="padding:5px 10px;font-size:0.8rem;">Sair</button>
            </form>
        <?php else: ?>
            <a href="/login" class="btn">Entrar</a>
        <?php endif; ?>
    </nav>
</header>
<div class="container">