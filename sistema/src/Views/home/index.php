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
        margin-top: 0;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .card .boas-vindas {
        color: #9d174d !important;
        font-size: 0.92rem;
        margin-top: 0;
        margin-bottom: 24px;
    }

    .card .boas-vindas strong {
        color: #831843;
        font-weight: 600;
    }

    .card .grid-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
        margin-top: 20px;
    }

    .card .stat-box {
        background: linear-gradient(180deg, #ffffff 0%, #fdf2f8 100%);
        border: 1px solid #fbcfe8;
        border-radius: 14px;
        padding: 20px 22px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        box-shadow: 0 4px 14px rgba(190, 24, 93, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card .stat-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(190, 24, 93, 0.11);
    }

    .card .stat-box span {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #9d174d;
        margin-bottom: 6px;
    }

    .card .stat-box strong {
        font-family: 'Playfair Display', serif;
        font-size: 1.9rem;
        font-weight: 700;
        color: #831843;
        line-height: 1.2;
    }

    .card .stat-box .btn {
        background-color: #fce7f3;
        color: #9d174d;
        border: 1px solid #f9a8d4;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
    }

    .card .stat-box .btn:hover {
        background-color: #fbcfe8;
        color: #831843;
        transform: translateY(-1px);
    }

    .card .stat-box .btn.btn-success {
        background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
        color: #ffffff;
        border: none;
        box-shadow: 0 4px 12px rgba(190, 24, 93, 0.22);
    }

    .card .stat-box .btn.btn-success:hover {
        filter: brightness(1.06);
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(190, 24, 93, 0.32);
    }

    .card h3 {
        font-family: 'Playfair Display', serif;
        color: #831843;
        font-size: 1.35rem;
        font-weight: 700;
        border-bottom: 1px solid #fbcfe8 !important;
        padding-bottom: 10px !important;
        margin-bottom: 16px;
        letter-spacing: 0.2px;
    }

    .card table {
        width: 100%;
        border-collapse: collapse;
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
    <h2><?= htmlspecialchars($titulo) ?></h2>
    <p class="boas-vindas" style="color: #9d174d;">
        Bem-vindo(a), <strong><?= htmlspecialchars($usuarioNome) ?></strong>. Selecione uma das opções abaixo para gerenciar a clínica:
    </p>

    <div class="grid-stats">
        <div class="stat-box">
            <span>Tutores Cadastrados</span>
            <strong><?= (int)$totalTutores ?></strong>
            <a href="/tutores" class="btn" style="margin-top:12px; font-size:0.75rem;">Gerenciar Tutores</a>
        </div>
        <div class="stat-box">
            <span>Pets Registrados</span>
            <strong><?= (int)$totalPets ?></strong>
            <a href="/pets" class="btn" style="margin-top:12px; font-size:0.75rem;">Gerenciar Pets</a>
        </div>
        <div class="stat-box">
            <span>Agendamentos</span>
            <strong style="color:#db2777;">Consultas</strong>
            <a href="/agendamentos" class="btn btn-success" style="margin-top:12px; font-size:0.75rem;">Ver Agendamentos</a>
        </div>
    </div>

    <h3 style="margin-top:35px; border-bottom:1px solid #fbcfe8; padding-bottom:8px;">Próximos Atendimentos</h3>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Paciente (Pet)</th>
                <th>Tutor Responsável</th>
                <th>Procedimento</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($agendamentosRecentes)): ?>
                <tr><td colspan="5" style="text-align:center; color:#9d174d;">Nenhum agendamento recente.</td></tr>
            <?php else: ?>
                <?php foreach ($agendamentosRecentes as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($a['data_agendamento']))) ?></td>
                        <td><?= htmlspecialchars(substr($a['hora_agendamento'], 0, 5)) ?></td>
                        <td><strong><?= htmlspecialchars($a['pet_nome']) ?></strong> (<?= htmlspecialchars($a['pet_especie']) ?>)</td>
                        <td><?= htmlspecialchars($a['tutor_nome']) ?></td>
                        <td><?= htmlspecialchars($a['servico']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>