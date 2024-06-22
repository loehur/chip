<!-- Main page content-->
<?php
$w = [
    1 => "danger",
    2 => "success",
    3 => "primary",
]
?>

<style>
    .blink_me {
        animation: blinker 0.7s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

<?php
$classCol = "text-center pt-2 my-1 rounded-3 border"; ?>

<div class="row mx-0 row-cols-2">
    <div class="col p-1">
        <div class="<?= $classCol ?> bg-success bg-opacity-10">
            <h3>
                <span class="text-secondary"><?= ucwords($_SESSION['user']) ?></span><br>
                <div class="<?= $data['chip'] <= 300 ? 'blink_me' : '' ?>"><b><?= number_format($data['chip']) ?></b></div>
            </h3>
        </div>
    </div>
    <?php
    $no = 0;
    foreach ($data['friend'] as $df) {
        $no++ ?>
        <div class="col p-1 bayar" data-user="<?= $df['user'] ?>" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom">
            <div class="<?= $classCol ?> bg-warning bg-opacity-10">
                <h3>
                    <span class="text-<?= $w[$no] ?>"><?= ucwords($df['user']) ?></span><br>
                    <div class="<?= $df['chip'] <= 300 ? 'blink_me' : '' ?>"><b><?= number_format($df['chip']) ?></b></div>
                </h3>
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