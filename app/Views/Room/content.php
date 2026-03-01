<!-- Main page content-->
<?php
$colors = [1 => '#dc2626', 2 => '#22c55e', 3 => '#3b82f6'];
?>
<style>
    .blink_me { animation: blinker 0.7s linear infinite; }
    @keyframes blinker { 50% { opacity: 0; } }
    .chip-box {
        background: #111113;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
        padding: 1rem;
        margin: 0.25rem 0;
        text-align: center;
    }
    .chip-box.me { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.2); }
    .chip-box.friend { background: rgba(161,161,170,0.06); }
    .chip-box.friend:hover { border-color: rgba(255,255,255,0.12); }
    .chip-box .name { font-size: 0.8125rem; color: #71717a; }
    .chip-box .value { font-size: 1.5rem; font-weight: 600; color: #fafafa; }
</style>

<div class="row mx-0 row-cols-2">
    <div class="col p-1">
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
        <div class="col p-1 bayar" data-user="<?= $df['user'] ?>" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom">
            <div class="chip-box friend">
                <div class="name" style="color: <?= $c ?>"><?= ucwords($df['user']) ?></div>
                <div class="<?= $df['chip'] <= 300 ? 'blink_me' : '' ?> value"><?= number_format($df['chip']) ?></div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    $(".bayar").on("click", function(e) {
        var t = $(this).attr('data-user');
        $("input[name=t]").val(t);
        $("b#target").html(t.toUpperCase());
    });
</script>