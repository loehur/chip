<?php
$nameColors = ['#6366f1', '#eab308', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316', '#14b8a6', '#3b82f6'];
function watchInitials($name) {
    $parts = explode(' ', trim($name));
    if (count($parts) >= 2) return strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
    return strtoupper(substr($name, 0, 2));
}
$rankMedals = ['🥇', '🥈', '🥉'];
?>
<div data-total="<?= $data['total'] ?>" data-players="<?= count($data['players']) ?>" data-low="<?= $data['low_count'] ?>"></div>
<style>
    .lb-list { display: flex; flex-direction: column; gap: 0.5rem; }
    .lb-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 0.875rem;
        background: linear-gradient(145deg, #141418 0%, #101012 100%);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        transition: all 0.25s ease;
        animation: lbIn 0.4s ease backwards;
    }
    .lb-item:nth-child(1) { animation-delay: 0.02s; border-color: rgba(234,179,8,0.25); background: linear-gradient(145deg, rgba(234,179,8,0.08) 0%, #101012 100%); }
    .lb-item:nth-child(2) { animation-delay: 0.06s; border-color: rgba(161,161,170,0.2); }
    .lb-item:nth-child(3) { animation-delay: 0.1s; border-color: rgba(180,83,9,0.2); }
    @keyframes lbIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .lb-item:hover { border-color: rgba(129,140,248,0.25); transform: translateX(2px); }
    .lb-rank {
        width: 28px;
        text-align: center;
        font-size: 1rem;
        font-weight: 700;
        color: #52525b;
        flex-shrink: 0;
    }
    .lb-rank.top { font-size: 1.25rem; }
    .lb-avatar {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .lb-info { flex: 1; min-width: 0; }
    .lb-name {
        font-size: 0.9375rem;
        font-weight: 600;
        text-transform: capitalize;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .lb-bar-wrap {
        height: 4px;
        background: rgba(255,255,255,0.06);
        border-radius: 2px;
        margin-top: 0.375rem;
        overflow: hidden;
    }
    .lb-bar {
        height: 100%;
        border-radius: 2px;
        background: linear-gradient(90deg, #6366f1, #a855f7);
        transition: width 0.6s cubic-bezier(0.32, 0.72, 0, 1);
    }
    .lb-chip {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1rem;
        font-weight: 700;
        text-align: right;
        flex-shrink: 0;
        letter-spacing: -0.02em;
    }
    .lb-chip.low {
        color: #fbbf24;
        animation: blink 0.8s linear infinite;
    }
    @keyframes blink { 50% { opacity: 0.4; } }
    .lb-empty {
        text-align: center;
        padding: 2rem;
        color: #52525b;
        font-size: 0.875rem;
    }
</style>

<?php
$maxChip = !empty($data['players']) ? max(array_column($data['players'], 'chip')) : 1;
if ($maxChip <= 0) $maxChip = 1;
?>

<?php if (empty($data['players'])) { ?>
    <div class="lb-empty">Belum ada pemain terdaftar</div>
<?php } else { ?>
    <div class="lb-list">
        <?php foreach ($data['players'] as $i => $p) {
            $rank = $i + 1;
            $c = $nameColors[$i % count($nameColors)];
            $isLow = $p['chip'] <= 300;
            $pct = round(($p['chip'] / $maxChip) * 100);
        ?>
        <div class="lb-item">
            <div class="lb-rank <?= $rank <= 3 ? 'top' : '' ?>">
                <?= $rank <= 3 ? $rankMedals[$rank - 1] : $rank ?>
            </div>
            <div class="lb-avatar" style="background: <?= $c ?>"><?= watchInitials($p['user']) ?></div>
            <div class="lb-info">
                <div class="lb-name" style="color: <?= $c ?>"><?= ucwords($p['user']) ?></div>
                <div class="lb-bar-wrap">
                    <div class="lb-bar" style="width: <?= $pct ?>%"></div>
                </div>
            </div>
            <div class="lb-chip <?= $isLow ? 'low' : '' ?>"><?= number_format($p['chip']) ?></div>
        </div>
        <?php } ?>
    </div>
<?php } ?>
