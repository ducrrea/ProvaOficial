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
        color: #831843;
        font-size: 1.85rem;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 24px;
        padding-bottom: 12px;
        border-bottom: 1px solid #fce7f3;
        letter-spacing: 0.3px;
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

    .card .form-group input,
    .card .form-group select {
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

    .card .form-group input:focus,
    .card .form-group select:focus {
        outline: none;
        border-color: #db2777;
        box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.14);
    }

    .card .link-voltar {
        color: #be185d !important;
        font-weight: 500;
        font-size: 0.92rem;
        align-self: center;
        transition: color 0.2s ease;
    }

    .card .link-voltar:hover {
        color: #831843 !important;
    }

    .card .btn.btn-success {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 11px 24px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(190, 24, 93, 0.25);
        transition: transform 0.15s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .card .btn.btn-success:hover {
        filter: brightness(1.06);
        box-shadow: 0 6px 18px rgba(190, 24, 93, 0.35);
        transform: translateY(-1px);
    }
</style>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2><?= htmlspecialchars($titulo) ?></h2>
    <?php if (!empty($erro)): ?>
        <div class="alerta-erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="/pets/salvar" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
        <div class="form-group">
            <label for="tutor_id">Tutor Responsável (Obrigatório)</label>
            <select id="tutor_id" name="tutor_id" required>
                <option value="">-- Selecione o Tutor --</option>
                <?php foreach ($tutores as $t): ?>
                    <option value="<?= (int)$t['id'] ?>"><?= htmlspecialchars($t['nome']) ?> (<?= htmlspecialchars($t['telefone']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nome">Nome do Pet</label>
            <input type="text" id="nome" name="nome" required placeholder="Ex.: Thor, Mia, Pipoca">
        </div>
        <div class="form-group">
            <label for="especie">Espécie</label>
            <select id="especie" name="especie" required>
                <option value="Canina">Canina</option>
                <option value="Felina">Felina</option>
                <option value="Aves">Aves</option>
                <option value="Roedores">Roedores</option>
            </select>
        </div>
        <div class="form-group">
            <label for="raca">Raça</label>
            <input type="text" id="raca" name="raca" required placeholder="Ex.: Labrador, Siamês, SRD">
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div style="display:flex; justify-content:space-between; margin-top:20px;">
            <a href="/pets" class="link-voltar" style="color:#be185d; text-decoration:none;">← Voltar</a>
            <button type="submit" class="btn btn-success">Cadastrar Pet</button>
        </div>
    </form>
</div>