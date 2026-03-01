<!-- Main page content-->
<?php
$colors = [1 => '#dc2626', 2 => '#22c55e', 3 => '#3b82f6', 4 => '#eab308', 5 => '#8b5cf6'];
?>
<style>
    .blink_me { animation: blinker 0.7s linear infinite; }
    @keyframes blinker { 50% { opacity: 0; } }
    .chip-content {
        padding: 0.5rem 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
    }
    .chip-box {
        background: var(--chip-card);
        border: 1px solid var(--chip-border);
        border-radius: 12px;
        padding: 1.25rem 1rem;
        margin: 0.375rem 0;
        text-align: center;
        transition: border-color 0.2s, background 0.2s;
    }
    .chip-box.me {
        background: rgba(34,197,94,0.06);
        border-color: rgba(34,197,94,0.15);
    }
    .chip-box.friend {
        background: var(--chip-card);
    }
    .chip-box.friend:hover {
        border-color: rgba(255,255,255,0.1);
        background: #18181b;
    }
    .chip-box .name {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--chip-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.375rem;
    }
    .chip-box .value {
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        color: var(--chip-text);
    }
</style>

<div class="chip-content">
    <div>
        <div class="chip-box me">
            <div class="name"><?= ucwords($_SESSION['user']) ?></div>
            <div class="<?= $data['chip'] <= 300 ? 'blink_me' : '' ?> value"><?= number_format($data['chip']) ?></div>
        </div>
    </div>
    <?php $no = 0;
    foreach ($data['friend'] as $df) {
        $no++;
        $c = $colors[$no] ?? '#a1a1aa';
    ?>
    <div class="bayar" data-user="<?= $df['user'] ?>" style="cursor: pointer;">
        <div class="chip-box friend">
            <div class="name" style="color: <?= $c ?>"><?= ucwords($df['user']) ?></div>
            <div class="<?= $df['chip'] <= 300 ? 'blink_me' : '' ?> value"><?= number_format($df['chip']) ?></div>
        </div>
    </div>
    <?php } ?>
</div>
