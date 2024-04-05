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

<?php if (count($data) <> 0) { ?>
    <div class="row mt-4 mx-2 mb-2">
        <div class="col">
            <div class="row">
                <div class="col text-center m-1 py-3 rounded-3 border shadow-sm bg-white">
                    <h2>
                        <b class="text-secondary"><?= ucwords($_SESSION['user']) ?></b><br>
                        <div class="<?= $data['chip'] <= 300 ? 'blink_me' : '' ?>"><b><?= number_format($data['chip']) ?></b></div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-2">
        <?php
        $no = 0;
        foreach ($data['friend'] as $df) {
            $no++ ?>
            <div style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="col shadow-sm text-center ps-3 m-1 pt-2 border bg-white border-<?= $w[$no] ?> rounded-3 bayar bg-light" data-user="<?= $df['user'] ?>">
                <h3>
                    <b class="text-<?= $w[$no] ?>"><?= ucwords($df['user']) ?></b><br>
                    <div class="<?= $df['chip'] <= 300 ? 'blink_me' : '' ?>"><b><?= number_format($df['chip']) ?></b></div>
                </h3>

            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="row p-5 m-auto">
        <div class="col text-center">
            <h3><span class="text-danger"><?= $_SESSION['user'] ?></span><br>Not Registered</h3>
        </div>
    </div>

    <div class="row p-5 m-auto">
        <div class="col text-center">
            <a href="<?= $this->BASE_URL ?>"><span class="btn btn-lg btn-outline-dark">Back</span></a>
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