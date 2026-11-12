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

    .card .btn.btn-success {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 14px rgba(190, 24, 93, 0.25);
        transition: transform 0.15s ease, box-shadow 0.2s ease, filter 0.2s ease;
    }

    .card .btn.btn-success:hover {
        filter: brightness(1.06);
        box-shadow: 0 6px 18px rgba(190, 24, 93, 0.35);
        transform: translateY(-1px);
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
</style>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2><?= htmlspecialchars($titulo) ?></h2>
        <a href="/pets/novo" class="btn btn-success">+ Cadastrar Pet</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Pet</th>
                <th>Espécie</th>
                <th>Raça</th>
                <th>Nascimento</th>
                <th>Tutor Responsável</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pets)): ?>
                <tr><td colspan="6" style="text-align:center; color:#9d174d;">Nenhum pet cadastrado no momento.</td></tr>
            <?php else: ?>
                <?php foreach ($pets as $p): ?>
                    <tr>
                        <td>#<?= (int)$p['id'] ?></td>
                        <td><strong><?= htmlspecialchars($p['nome']) ?></strong></td>
                        <td><?= htmlspecialchars($p['especie']) ?></td>
                        <td><?= htmlspecialchars($p['raca']) ?></td>
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($p['data_nascimento']))) ?></td>
                        <td><?= htmlspecialchars($p['tutor_nome']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>