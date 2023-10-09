<!-- Main page content-->
<?php
$w = [
    1 => "danger",
    2 => "success",
    3 => "primary",
]
?>

<?php if (count($data) <> 0) { ?>
    <div class="row mt-4 mb-2 pb-0 mx-2 cek">
        <div class="col">
            <div class="row">
                <div class="col text-center">
                    <h2>
                        <b class="text-secondary"><?= ucwords($_SESSION['user']) ?></b><br>
                        <div><b><?= number_format($data['chip']) ?></b></div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-3">
        <?php
        $no = 0;
        foreach ($data['friend'] as $df) {
            $no++ ?>
            <div style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="col m-1 border border-<?= $w[$no] ?> rounded bayar bg-light" data-user="<?= $df['user'] ?>">

                <h3>
                    <b class="text-<?= $w[$no] ?>"><?= ucwords($df['user']) ?></b><br>
                    <div class=""><b><?= number_format($df['chip']) ?></b></div>
                </h3>

            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="row p-5 m-auto" style="max-width: 600px;">
        <div class="col text-center">
            <h3>User not Found</h3>
        </div>
    </div>
<?php } ?>

<script>
    $(".bayar").on("click", function(e) {
        var t = $(this).attr('data-user');
        $("input[name=c]").focus();
        $("input[name=t]").val(t);
        $("b#target").html(t.toUpperCase());
    });
</script>