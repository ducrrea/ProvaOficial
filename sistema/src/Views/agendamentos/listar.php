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

    .card .subtitulo-tabela {
        color: #9d174d !important;
        font-size: 0.85rem;
        margin-top: 4px;
        margin-bottom: 0;
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

    .card .badge-ano {
        background-color: #fce7f3 !important;
        color: #9d174d !important;
        border: 1px solid #f9a8d4;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.8rem;
        display: inline-block;
    }

    .card .texto-raca {
        color: #b85d82 !important;
        font-size: 0.85rem;
    }

    .card .btn-alterar {
        background: linear-gradient(135deg, #f472b6 0%, #db2777 100%) !important;
        color: #ffffff !important;
        padding: 6px 12px !important;
        font-size: 0.78rem !important;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(219, 39, 119, 0.2);
        transition: filter 0.2s ease, transform 0.15s ease;
    }

    .card .btn-alterar:hover {
        filter: brightness(1.06);
        transform: translateY(-1px);
    }
</style>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2><?= htmlspecialchars($titulo) ?></h2>
            <p class="subtitulo-tabela" style="color:#9d174d; font-size:0.85rem; margin-top:4px;">
                Ordenado cronologicamente por ano de agendamento com dados completos do paciente e do tutor.
            </p>
        </div>
        <a href="/agendamentos/novo" class="btn btn-success">+ Novo Agendamento</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ano</th>
                <th>Data / Hora</th>
                <th>Paciente (Pet)</th>
                <th>Tutor Responsável</th>
                <th>Contato Tutor</th>
                <th>Serviço</th>
                <th style="text-align:right;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($agendamentos)): ?>
                <tr><td colspan="7" style="text-align:center; color:#9d174d;">Nenhum agendamento cadastrado.</td></tr>
            <?php else: ?>
                <?php foreach ($agendamentos as $a): ?>
                    <tr>
                        <td><span class="badge-ano" style="background:#fce7f3; color:#9d174d; padding:3px 8px; border-radius:4px; font-weight:bold; font-size:0.8rem;"><?= htmlspecialchars((string)$a['ano_agendamento']) ?></span></td>
                        <td><strong><?= htmlspecialchars(date('d/m/Y', strtotime($a['data_agendamento']))) ?></strong> às <?= htmlspecialchars(substr($a['hora_agendamento'], 0, 5)) ?></td>
                        <td><?= htmlspecialchars($a['pet_nome']) ?> <span class="texto-raca" style="color:#b85d82;">(<?= htmlspecialchars($a['pet_raca']) ?>)</span></td>
                        <td><?= htmlspecialchars($a['tutor_nome']) ?></td>
                        <td><?= htmlspecialchars($a['tutor_telefone']) ?></td>
                        <td><?= htmlspecialchars($a['servico']) ?></td>
                        <td style="text-align:right;">
                            <a href="/agendamentos/editar-data?id=<?= (int)$a['id'] ?>" class="btn btn-alterar" style="padding:4px 8px; font-size:0.75rem; background:#db2777;">
                                Alterar Data
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>