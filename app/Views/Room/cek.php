<!-- Main page content-->
<style>
    .tx-list { display: flex; flex-direction: column; gap: 0.5rem; }
    .tx-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        background: linear-gradient(145deg, #151518 0%, #111113 100%);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        transition: border-color 0.2s ease;
        animation: txIn 0.35s ease backwards;
    }
    .tx-item:nth-child(1) { animation-delay: 0.03s; }
    .tx-item:nth-child(2) { animation-delay: 0.06s; }
    .tx-item:nth-child(3) { animation-delay: 0.09s; }
    .tx-item:nth-child(4) { animation-delay: 0.12s; }
    .tx-item:nth-child(5) { animation-delay: 0.15s; }
    @keyframes txIn {
        from { opacity: 0; transform: translateX(-8px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .tx-item:hover { border-color: rgba(255,255,255,0.1); }
    .tx-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.125rem;
        font-weight: 700;
    }
    .tx-icon.in {
        background: rgba(34,197,94,0.12);
        color: #22c55e;
        border: 1px solid rgba(34,197,94,0.2);
    }
    .tx-icon.out {
        background: rgba(239,68,68,0.12);
        color: #ef4444;
        border: 1px solid rgba(239,68,68,0.2);
    }
    .tx-body { flex: 1; min-width: 0; }
    .tx-route {
        font-size: 0.875rem;
        font-weight: 500;
        color: #fafafa;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tx-route .arrow { color: #6366f1; margin: 0 0.25rem; }
    .tx-time {
        font-size: 0.6875rem;
        color: #71717a;
        margin-top: 0.125rem;
    }
    .tx-amount { text-align: right; flex-shrink: 0; }
    .tx-amount .chip {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.9375rem;
        font-weight: 700;
    }
    .tx-amount .chip.in { color: #22c55e; }
    .tx-amount .chip.out { color: #ef4444; }
    .tx-balance {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.625rem;
        color: #52525b;
        margin-top: 0.125rem;
    }
    .tx-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #52525b;
        font-size: 0.875rem;
    }
    .tx-empty svg { opacity: 0.3; margin-bottom: 0.75rem; }
</style>

<?php if (empty($data['mutasi'])) { ?>
<div class="tx-empty">
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/></svg>
    <p>Belum ada transaksi</p>
</div>
<?php } else { ?>
<div class="tx-list">
    <?php
    $c = $data['chip'];
    foreach ($data['mutasi'] as $d) {
        $isIn = strtoupper($d['t']) == strtoupper($_SESSION['user']);
        if ($isIn) {
            $b = $c - $d['chip'];
        } else {
            $b = $c + $d['chip'];
        }
    ?>
    <div class="tx-item">
        <div class="tx-icon <?= $isIn ? 'in' : 'out' ?>"><?= $isIn ? '+' : '−' ?></div>
        <div class="tx-body">
            <div class="tx-route">
                <?= ucwords($d['f']) ?><span class="arrow">→</span><?= ucwords($d['t']) ?>
            </div>
            <div class="tx-time"><?= $d['insertTime'] ?></div>
        </div>
        <div class="tx-amount">
            <div class="chip <?= $isIn ? 'in' : 'out' ?>"><?= $isIn ? '+' : '−' ?><?= number_format($d['chip']) ?></div>
            <div class="tx-balance"><?= number_format($b) ?> → <?= number_format($c) ?></div>
        </div>
    </div>
    <?php
        if ($isIn) {
            $c -= $d['chip'];
        } else {
            $c += $d['chip'];
        }
    }
    ?>
</div>
<?php } ?>
