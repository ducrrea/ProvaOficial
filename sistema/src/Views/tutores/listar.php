<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

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
        margin: 0;
        letter-spacing: 0.3px;
    }

    .card form input[type="text"] {
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

    .card form input[type="text"]::placeholder {
        color: #d88ca8;
    }

    .card form input[type="text"]:focus {
        outline: none;
        border-color: #db2777;
        box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.14);
    }

    .card .btn {
        background: linear-gradient(135deg, #f472b6 0%, #db2777 100%);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(219, 39, 119, 0.2);
        transition: transform 0.15s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .card .btn:hover {
        filter: brightness(1.06);
        box-shadow: 0 6px 16px rgba(219, 39, 119, 0.3);
        transform: translateY(-1px);
    }

    .card .btn.btn-success {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        box-shadow: 0 4px 14px rgba(190, 24, 93, 0.25);
    }

    .card .btn.btn-success:hover {
        box-shadow: 0 6px 18px rgba(190, 24, 93, 0.35);
    }

    .card .btn.btn-danger {
        background: linear-gradient(135deg, #fb7185 0%, #e11d48 100%);
        box-shadow: 0 4px 12px rgba(225, 29, 72, 0.22);
    }

    .card .btn.btn-danger:hover {
        box-shadow: 0 6px 16px rgba(225, 29, 72, 0.32);
    }

    .card table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 24px;
        font-size: 0.9rem;
    }

    .card table thead tr {
        background-color: #fdf2f8;
        border-top: 1px solid #fbcfe8;
        border-bottom: 2px solid #f9a8d4;
    }

    .card table th {
        color: #831843;
        font-weight: 600;
        text-align: left;
        padding: 13px 14px;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .card table tbody tr {
        border-bottom: 1px solid #fce7f3;
        transition: background-color 0.2s ease;
    }

    .card table tbody tr:hover {
        background-color: #fff1f5;
    }

    .card table td {
        padding: 14px;
        color: #500724;
        vertical-align: middle;
    }

    .card table td strong {
        color: #831843;
        font-weight: 600;
    }

    .card table td code {
        background-color: #fdf2f8;
        color: #9d174d;
        border: 1px solid #fbcfe8;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.84rem;
    }

    .card table .btn-editar {
        padding: 6px 12px !important;
        font-size: 0.78rem !important;
        border-radius: 8px;
    }
</style>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2><?= htmlspecialchars($titulo) ?></h2>
        <a href="/tutores/novo" class="btn btn-success">+ Cadastrar Tutor</a>
    </div>

    <!-- Recurso de Busca por Termo -->
    <form action="/tutores" method="GET" style="margin-top:20px; display:flex; gap:10px;">
        <input type="text" name="q" value="<?= htmlspecialchars($busca ?? '') ?>" placeholder="Pesquise por nome, e-mail ou telefone..." style="flex:1;">
        <button type="submit" class="btn">Buscar</button>
        <?php if (!empty($busca)): ?>
            <a href="/tutores" class="btn btn-danger" style="text-decoration:none;">Limpar</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Tutor</th>
                <th>CPF (Protegido LGPD)</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th style="text-align:right;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tutores)): ?>
                <tr><td colspan="6" style="text-align:center; color:#9d174d;">Nenhum tutor encontrado para o termo pesquisado.</td></tr>
            <?php else: ?>
                <?php foreach ($tutores as $t): ?>
                    <tr>
                        <td>#<?= (int)$t['id'] ?></td>
                        <td><strong><?= htmlspecialchars($t['nome']) ?></strong></td>
                        <td><code><?= htmlspecialchars($t['cpf']) ?></code></td>
                        <td><?= htmlspecialchars($t['telefone']) ?></td>
                        <td><?= htmlspecialchars($t['email']) ?></td>
                        <td style="text-align:right;">
                            <a href="/tutores/editar?id=<?= (int)$t['id'] ?>" class="btn btn-editar" style="padding:4px 8px; font-size:0.75rem;">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>