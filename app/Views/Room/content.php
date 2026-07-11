<!-- Main page content-->
<?php
$nameColors = ['#6366f1', '#eab308', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316', '#14b8a6', '#3b82f6'];
function chipInitials($name) {
    $parts = explode(' ', trim($name));
    if (count($parts) >= 2) return strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
    return strtoupper(substr($name, 0, 2));
}
?>
<style>
    .blink_me { animation: blinker 0.7s linear infinite; }
    @keyframes blinker { 50% { opacity: 0.35; } }

    .chip-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(139,92,246,0.1) 40%, rgba(59,130,246,0.08) 100%);
        border: 1px solid rgba(99,102,241,0.25);
        border-radius: 20px;
        padding: 1.75rem 1.5rem;
        text-align: center;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 32px rgba(99,102,241,0.12);
        animation: cardIn 0.4s ease;
    }
    .chip-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(139,92,246,0.2), transparent 70%);
        pointer-events: none;
    }
    @keyframes cardIn {
        from { opacity: 0; transform: translateY(12px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .chip-hero-label {
        font-size: 0.6875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #a5b4fc;
        margin-bottom: 0.5rem;
    }
    .chip-hero-user {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }
    .chip-avatar {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        color: #fff;
    }
    .chip-hero-name {
        font-size: 1rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .chip-hero-value {
        font-family: 'JetBrains Mono', monospace;
        font-size: clamp(2rem, 8vw, 2.75rem);
        font-weight: 700;
        letter-spacing: -0.03em;
        color: #fafafa;
        line-height: 1.1;
    }
    .chip-hero-value.low {
        color: #fbbf24;
        text-shadow: 0 0 20px rgba(251,191,36,0.4);
    }
    .chip-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.75rem;
        padding: 0.25rem 0.625rem;
        font-size: 0.6875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: rgba(245,158,11,0.15);
        color: #fbbf24;
        border: 1px solid rgba(245,158,11,0.3);
        border-radius: 999px;
    }

    .chip-friends-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #71717a;
        margin-bottom: 0.75rem;
    }
    .chip-friends {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    @media (min-width: 768px) {
        .chip-friends { grid-template-columns: repeat(3, 1fr); gap: 0.875rem; }
    }

    .chip-box {
        position: relative;
        background: linear-gradient(145deg, #151518 0%, #111113 100%);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 1rem 0.875rem;
        text-align: center;
        transition: all 0.25s cubic-bezier(0.32, 0.72, 0, 1);
        animation: cardIn 0.4s ease backwards;
    }
    .chip-box.friend { cursor: pointer; }
    .chip-box.friend:nth-child(1) { animation-delay: 0.05s; }
    .chip-box.friend:nth-child(2) { animation-delay: 0.1s; }
    .chip-box.friend:nth-child(3) { animation-delay: 0.15s; }
    .chip-box.friend:nth-child(4) { animation-delay: 0.2s; }
    .chip-box.friend:nth-child(5) { animation-delay: 0.25s; }
    .chip-box.friend:nth-child(6) { animation-delay: 0.3s; }
    .chip-box.friend:hover {
        border-color: rgba(99,102,241,0.35);
        background: linear-gradient(145deg, rgba(99,102,241,0.1) 0%, rgba(139,92,246,0.06) 100%);
        box-shadow: 0 6px 20px rgba(99,102,241,0.15);
        transform: translateY(-2px);
    }
    .chip-box.friend:active { transform: translateY(0) scale(0.98); }
    .chip-box-top {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        margin-bottom: 0.5rem;
    }
    .chip-box .avatar-sm {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.5625rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .chip-box .name {
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: capitalize;
        letter-spacing: 0.02em;
    }
    .chip-box .value {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.375rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        color: #fafafa;
    }
    .chip-box .value.low { color: #fbbf24; }
    .chip-tap-hint {
        font-size: 0.625rem;
        color: #52525b;
        margin-top: 0.375rem;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .chip-box.friend:hover .chip-tap-hint { opacity: 1; }
</style>

<div class="chip-hero">
    <?php $meColor = $nameColors[0]; $isLow = $data['chip'] <= 300; ?>
    <div class="chip-hero-label">Saldo Anda</div>
    <div class="chip-hero-user">
        <div class="chip-avatar" style="background: <?= $meColor ?>"><?= chipInitials($_SESSION['user']) ?></div>
        <span class="chip-hero-name" style="color: <?= $meColor ?>"><?= ucwords($_SESSION['user']) ?></span>
    </div>
    <div class="chip-hero-value <?= $isLow ? 'low blink_me' : '' ?>"><?= number_format($data['chip']) ?></div>
    <?php if ($isLow) { ?>
        <div class="chip-hero-badge blink_me">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L1 21h22L12 2zm0 4l7.53 13H4.47L12 6zm-1 5v4h2v-4h-2zm0 6v2h2v-2h-2z"/></svg>
            Saldo Kritis
        </div>
    <?php } ?>
</div>

<div class="chip-friends-label">Pemain Lain — ketuk untuk transfer</div>
<div class="chip-friends">
    <?php $no = 0;
    foreach ($data['friend'] as $df) {
        $c = $nameColors[(($no % (count($nameColors) - 1)) + 1)] ?? '#a1a1aa';
        $fLow = $df['chip'] <= 300;
        $no++;
    ?>
    <div class="bayar" data-user="<?= $df['user'] ?>">
        <div class="chip-box friend">
            <div class="chip-box-top">
                <div class="avatar-sm" style="background: <?= $c ?>"><?= chipInitials($df['user']) ?></div>
                <div class="name" style="color: <?= $c ?>"><?= ucwords($df['user']) ?></div>
            </div>
            <div class="value <?= $fLow ? 'low blink_me' : '' ?>"><?= number_format($df['chip']) ?></div>
            <div class="chip-tap-hint">Tap untuk kirim</div>
        </div>
    </div>
    <?php } ?>
</div>
