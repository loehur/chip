<style>
    .feed-list {
        display: flex;
        flex-direction: column;
        gap: 0.4375rem;
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #27272a transparent;
    }
    .feed-list::-webkit-scrollbar { width: 4px; }
    .feed-list::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 2px; }
    .feed-item {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        padding: 0.75rem 0.875rem;
        background: linear-gradient(145deg, #141418 0%, #101012 100%);
        border: 1px solid rgba(255,255,255,0.04);
        border-radius: 11px;
        animation: feedIn 0.35s ease backwards;
        transition: border-color 0.2s;
    }
    .feed-item:nth-child(1) { animation-delay: 0.02s; border-color: rgba(129,140,248,0.2); }
    .feed-item:nth-child(2) { animation-delay: 0.05s; }
    .feed-item:nth-child(3) { animation-delay: 0.08s; }
    @keyframes feedIn {
        from { opacity: 0; transform: translateX(12px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .feed-item:hover { border-color: rgba(255,255,255,0.1); }
    .feed-arrow {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(99,102,241,0.12);
        border: 1px solid rgba(99,102,241,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #818cf8;
        font-size: 1rem;
    }
    .feed-body { flex: 1; min-width: 0; }
    .feed-route {
        font-size: 0.8125rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .feed-route .from { color: #f87171; }
    .feed-route .to { color: #34d399; }
    .feed-route .sep { color: #52525b; margin: 0 0.25rem; }
    .feed-time {
        font-size: 0.625rem;
        color: #52525b;
        margin-top: 0.125rem;
    }
    .feed-amount {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.875rem;
        font-weight: 700;
        color: #fafafa;
        flex-shrink: 0;
        background: rgba(255,255,255,0.04);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
    }
    .feed-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #52525b;
        font-size: 0.875rem;
    }
</style>

<?php if (empty($data['mutasi'])) { ?>
    <div class="feed-empty">Belum ada aktivitas transfer</div>
<?php } else { ?>
    <div class="feed-list">
        <?php foreach ($data['mutasi'] as $d) { ?>
        <div class="feed-item">
            <div class="feed-arrow">→</div>
            <div class="feed-body">
                <div class="feed-route">
                    <span class="from"><?= ucwords($d['f']) ?></span>
                    <span class="sep">→</span>
                    <span class="to"><?= ucwords($d['t']) ?></span>
                </div>
                <div class="feed-time"><?= $d['insertTime'] ?></div>
            </div>
            <div class="feed-amount"><?= number_format($d['chip']) ?></div>
        </div>
        <?php } ?>
    </div>
<?php } ?>
