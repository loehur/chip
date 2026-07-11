<style>
    .feed-list {
        display: flex;
        flex-direction: column;
        gap: 0.4375rem;
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }
    .feed-list::-webkit-scrollbar { width: 4px; }
    .feed-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
    .feed-item {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        padding: 0.75rem 0.875rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(15,23,42,0.07);
        border-radius: 11px;
        animation: feedIn 0.35s ease backwards;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 1px 2px rgba(15,23,42,0.03);
    }
    .feed-item:nth-child(1) { animation-delay: 0.02s; border-color: rgba(99,102,241,0.25); background: linear-gradient(145deg, rgba(238,242,255,0.8) 0%, #ffffff 100%); }
    .feed-item:nth-child(2) { animation-delay: 0.05s; }
    .feed-item:nth-child(3) { animation-delay: 0.08s; }
    @keyframes feedIn {
        from { opacity: 0; transform: translateX(12px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .feed-item:hover { border-color: rgba(99,102,241,0.2); box-shadow: 0 2px 8px rgba(15,23,42,0.06); }
    .feed-arrow {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(99,102,241,0.08);
        border: 1px solid rgba(99,102,241,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #4f46e5;
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
    .feed-route .from { color: #dc2626; }
    .feed-route .to { color: #16a34a; }
    .feed-route .sep { color: #94a3b8; margin: 0 0.25rem; }
    .feed-time {
        font-size: 0.625rem;
        color: #94a3b8;
        margin-top: 0.125rem;
    }
    .feed-amount {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.875rem;
        font-weight: 700;
        color: #0f172a;
        flex-shrink: 0;
        background: #f1f5f9;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        border: 1px solid rgba(15,23,42,0.06);
    }
    .feed-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #94a3b8;
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
