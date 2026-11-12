<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>
    .card {
        background: linear-gradient(180deg, #ffffff 0%, #fff5f8 100%);
        border: 1px solid #fbcfe8;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 12px 30px rgba(190, 24, 93, 0.08);
        font-family: 'Montserrat', sans-serif;
        color: #500724;
    }

    .card h2 {
        font-family: 'Playfair Display', serif;
        color: #831843 !important;
        font-size: 1.85rem;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .card .subtitulo-login {
        color: #9d174d !important;
        font-size: 0.88rem;
        margin-top: 0;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #fce7f3;
    }

    .card .alerta-erro {
        background-color: #ffe4e6;
        border: 1px solid #fda4af;
        color: #9f1239;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 18px;
        text-align: center;
    }

    .card .form-group {
        margin-bottom: 18px;
    }

    .card .form-group label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        color: #9d174d;
        margin-bottom: 6px;
        letter-spacing: 0.2px;
    }

    .card .form-group input {
        width: 100%;
        padding: 11px 14px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95rem;
        color: #500724;
        background-color: #ffffff;
        border: 1.5px solid #f9a8d4;
        border-radius: 10px;
        box-sizing: border-box;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .card .form-group input::placeholder {
        color: #d88ca8;
    }

    .card .form-group input:focus {
        outline: none;
        border-color: #db2777;
        box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.14);
    }

    .card .btn {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(190, 24, 93, 0.25);
        transition: transform 0.15s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .card .btn:hover {
        filter: brightness(1.06);
        box-shadow: 0 6px 18px rgba(190, 24, 93, 0.35);
        transform: translateY(-1px);
    }

    .card .rodape-sessao {
        color: #b85d82 !important;
    }
</style>

<div class="card" style="max-width: 400px; margin: 50px auto;">
    <h2 style="text-align:center; color:#831843;"><?= htmlspecialchars($titulo) ?></h2>
    <p class="subtitulo-login" style="text-align:center; color:#9d174d; font-size:0.88rem;">Insira suas credenciais de acesso</p>

    <?php if (!empty($erro)): ?>
        <div class="alerta-erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
        <div class="form-group">
            <label for="email">E-mail Corporativo</label>
            <input type="email" id="email" name="email" required placeholder="seu.email@vetcare.com">
        </div>
        <div class="form-group">
            <label for="senha">Senha de Acesso</label>
            <input type="password" id="senha" name="senha" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn" style="width:100%; margin-top:10px;">Autenticar no Sistema</button>
    </form>
    <div class="rodape-sessao" style="margin-top:20px; font-size:0.8rem; color:#b85d82; text-align:center;">
        Sessão com expiração automática por inatividade após 15 minutos.
    </div>
</div>