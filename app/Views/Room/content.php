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
$classCol = "text-center py-3 mx-1 my-1 rounded-3 border shadow-sm bg-white";
if (count($data) <> 0) { ?>
    <div class="row mt-3 mx-2 row-cols-2">
        <div class="col px-0">
            <div class="<?= $classCol ?>">
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
            <div class="col px-0 bayar" data-user="<?= $df['user'] ?>" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom">
                <div class="<?= $classCol ?>">
                    <h3>
                        <span class="text-<?= $w[$no] ?>"><?= ucwords($df['user']) ?></span><br>
                        <div class="<?= $df['chip'] <= 300 ? 'blink_me' : '' ?>"><b><?= number_format($df['chip']) ?></b></div>
                    </h3>
                </div>
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