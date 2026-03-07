<!-- Main page content-->
<?php
$nameColors = ['#3b82f6', '#eab308', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316', '#14b8a6', '#6366f1'];
?>
<style>
    .blink_me { animation: blinker 0.7s linear infinite; }
    @keyframes blinker { 50% { opacity: 0; } }
    .chip-me-section { padding: 0.5rem 0 1rem; }
    .chip-box.me {
        background: linear-gradient(135deg, rgba(59,130,246,0.12) 0%, rgba(99,102,241,0.08) 50%, rgba(139,92,246,0.06) 100%);
        border: 1px solid rgba(99,102,241,0.25);
        border-radius: 16px;
        padding: 1.75rem 1.5rem;
        text-align: center;
        width: 100%;
        box-shadow: 0 4px 20px rgba(59,130,246,0.08);
    }
    .chip-box.me .name {
        font-size: 0.9375rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 0.5rem;
    }
    .chip-box.me .value {
        font-size: 2.25rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--chip-text);
    }
    .chip-friends {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .chip-box {
        background: linear-gradient(145deg, #131315 0%, #0f0f11 100%);
        border: 1px solid var(--chip-border);
        border-radius: 12px;
        padding: 1.25rem 1rem;
        text-align: center;
        transition: all 0.25s ease;
    }
    .chip-box.friend {
        background: linear-gradient(145deg, #151518 0%, #111113 100%);
    }
    .chip-box.friend:hover {
        border-color: rgba(99,102,241,0.2);
        background: linear-gradient(145deg, rgba(99,102,241,0.08) 0%, rgba(139,92,246,0.05) 100%);
        box-shadow: 0 4px 16px rgba(99,102,241,0.1);
    }
    .chip-box.friend .name {
        font-size: 0.9375rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.375rem;
    }
    .chip-box.friend .value {
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        color: var(--chip-text);
    }
</style>

<div class="chip-me-section">
    <div class="chip-box me">
        <div class="name" style="color: <?= $nameColors[0] ?>"><?= ucwords($_SESSION['user']) ?></div>
        <div class="<?= $data['chip'] <= 300 ? 'blink_me' : '' ?> value"><?= number_format($data['chip']) ?></div>
    </div>
</div>

<div class="chip-friends">
    <?php $no = 0;
    foreach ($data['friend'] as $df) {
        $c = $nameColors[(($no % (count($nameColors) - 1)) + 1)] ?? '#a1a1aa';
        $no++;
    ?>
    <div class="bayar" data-user="<?= $df['user'] ?>" style="cursor: pointer;">
        <div class="chip-box friend">
            <div class="name" style="color: <?= $c ?>"><?= ucwords($df['user']) ?></div>
            <div class="<?= $df['chip'] <= 300 ? 'blink_me' : '' ?> value"><?= number_format($df['chip']) ?></div>
        </div>
    </div>
    <?php } ?>
</div>
