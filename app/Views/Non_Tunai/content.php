<main>
    <?php if (count($data['kas']) > 0) { ?>
        <div class="p-2 ms-3 mt-3 me-3 bg-white">
            <div class="row">
                <div class="col">
                    <div class="row border-bottom">
                        <div class="col ms-2">
                            <span class="text-danger">Antrian Pengecekan Non Tunai</span>
                        </div>
                    </div>
                    <table class="table table-sm">
                        <tr>
                            <th class="text-end">ID</th>
                            <th>Customer</th>
                            <th>Referensi</th>
                            <th>Payment</th>
                            <th class="text-end">Jumlah</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $count = 1;
                        $sum = 0;
                        $client_old = 0;
                        $rows = count($data['kas']);
                        $no = 0;
                        foreach ($data['kas'] as $a) {
                            $no += 1;

                            $client = $a['id_client'];
                            $jumlah = $a['jumlah'];

                            if ($client_old == $client) {
                                $count += 1;
                                $sum += $jumlah;
                            }

                            $pelanggan = "Non";
                            foreach ($data['pelanggan'] as $dp) {
                                if ($dp['id_pelanggan'] == $client) {
                                    $pelanggan = $dp['nama'];
                                }
                            }

                        ?>
                            <?php
                            if (($count > 1 && $client_old <> $client)) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">Rp<?= number_format($sum) ?></td>
                                    <td></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td align="right">#<?= $a['id_kas'] ?></td>
                                <td><?= strtoupper($pelanggan) ?></td>
                                <td><?= $a['ref_transaksi'] ?></td>
                                <td><?= $a['note'] ?></td>
                                <td align="right">Rp<?= number_format($jumlah) ?></td>
                                <td>
                                    <button data-id="<?= $a['id_kas'] ?>" data-val="1" class="action btn btn-sm btn-outline-success">Verify</button>
                                    <button data-id="<?= $a['id_kas'] ?>" data-val="2" class="action border-0 btn-sm bg-white text-danger">Reject</button>
                                </td>
                            </tr>

                            <?php
                            if ($client_old <> $client) {
                                $count = 1;
                                $sum = 0;
                            }

                            if (($count > 1 && $no == $rows)) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">Rp<?= number_format($sum) ?></td>
                                    <td></td>
                                </tr>
                        <?php }
                            $client_old = $client;
                        } ?>
                    </table>

                </div>
            </div>
        </div>
    <?php } ?>
    <div class="p-2 ms-3 mt-3 me-3 bg-white">
        <div class="row">
            <div class="col">
                <div class="row border-bottom">
                    <div class="col ms-2">
                        <span class="text-purple">Riwayat Pembayaran Terkonfirmasi</span> <small>(Last 30)</small>
                    </div>
                </div>
                <table class="table table-sm">
                    <tr>
                        <th class="text-end">ID</th>
                        <th>Customer</th>
                        <th>Referensi</th>
                        <th>Payment</th>
                        <th class="text-end">Jumlah</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $no = 0;
                    foreach ($data['kas_done'] as $a) {
                        $no += 1;

                        $client = $a['id_client'];
                        $jumlah = $a['jumlah'];

                        $pelanggan = "Non";
                        foreach ($data['pelanggan'] as $dp) {
                            if ($dp['id_pelanggan'] == $client) {
                                $pelanggan = $dp['nama'];
                            }
                        }

                    ?>
                        <tr>
                            <td align="right">#<?= $a['id_kas'] ?></td>
                            <td><?= strtoupper($pelanggan) ?></td>
                            <td><?= $a['ref_transaksi'] ?></td>
                            <td><?= $a['note'] ?></td>
                            <td align="right">Rp<?= number_format($jumlah) ?></td>
                            <td>
                                <?php
                                switch ($a['status_mutasi']) {
                                    case 1:
                                        echo '<span class="text-success"><i class="fa-solid fa-check-to-slot"></i> Verified</span>';
                                        break;
                                    default:
                                        echo '<span><i class="fa-solid fa-xmark"></i> Rejected</span>';
                                        break;
                                }
                                ?>
                            </td>
                        </tr>

                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</main>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>

<script>
    $("button.action").click(function() {
        var id_ = $(this).attr("data-id");
        var value = $(this).attr("data-val");
        $.ajax({
            url: "<?= $this->BASE_URL ?>Non_Tunai/action",
            data: {
                id: id_,
                val: value
            },
            type: "POST",
            success: function(result) {
                if (result == 0) {
                    content();
                } else {
                    alert(result);
                }
            },
        });
    });
</script>