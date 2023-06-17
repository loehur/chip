<main>
    <!-- Main page content-->
    <div class="row me-2">
        <div class="col-md-6 p-0 pe-1">
            <div class="container-fluid pt-2 pe-0">
                <div class="card">
                    <small>
                        <table class="table table-sm table-hover mb-0">
                            <tr>
                                <td colspan="5" class="table-danger">Rekap SPK - <b>Tahap I</b></td>
                            </tr>
                            <?php foreach ($data['recap'] as $r) { ?>
                                <tr>
                                    <td><?= strtoupper($r['spk']) ?></td>
                                    <td align="right"><?= $r['jumlah'] ?> Pcs</td>
                                    <td align="right"><span class="border rounded px-1 py-1 btn updateSPK" data-order="<?= $r['order'] ?>" data-bs-toggle="modal" data-bs-target="#updateSPK">Update</span></td>
                                    <td><span class="border rounded px-1 py-1 btn cekSPK" data-parse="<?= $data['id_divisi'] ?>" data-order="<?= $r['order'] ?>">Cek</span></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-0 pe-1">
            <div class="container-fluid pt-2 pe-0">
                <div class="card">
                    <small>
                        <table class="table table-sm table-hover mb-0">
                            <tr>
                                <td colspan="5" class="table-warning">Rekap SPK - <b>Tahap II</b></td>
                            </tr>
                            <?php foreach ($data['recap_2'] as $r) { ?>
                                <tr>
                                    <td><?= strtoupper($r['spk']) ?></td>
                                    <td align="right"><?= $r['jumlah'] ?> Pcs</td>
                                    <td align="right"><span class="border rounded px-1 py-1 btn updateSPK" data-order="<?= $r['order'] ?>" data-bs-toggle="modal" data-bs-target="#updateSPK2">Update</span></td>
                                    <td><span class="border rounded px-1 py-1 btn cekSPK" data-parse="<?= $data['id_divisi'] ?>" data-order="<?= $r['order'] ?>">Cek</span></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </small>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="updateSPK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update SPK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $this->BASE_URL ?>SPK/updateSPK/<?= $data['id_divisi'] ?>/1" method="POST">
                <div class="modal-body">
                    <div class="col mb-2">
                        <label class="form-label">User Produksi</label>
                        <select class="form-select tize" name="id_karyawan" required>
                            <option></option>
                            <?php foreach ($data['karyawan'] as $k) { ?>
                                <option value="<?= $k['id_karyawan'] ?>"><?= $k['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col" id="cekUpdate"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="updateSPK2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update SPK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $this->BASE_URL ?>SPK/updateSPK/<?= $data['id_divisi'] ?>/2" method="POST">
                <div class="modal-body">
                    <div class="col mb-2">
                        <label class="form-label">User Produksi</label>
                        <select class="form-select tize" name="id_karyawan" required>
                            <option></option>
                            <?php foreach ($data['karyawan'] as $k) { ?>
                                <option value="<?= $k['id_karyawan'] ?>"><?= $k['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col" id="cekUpdate"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="cekSPK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SPK Selesai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $this->BASE_URL ?>SPK/updateSPK/<?= $data['id_divisi'] ?>" method="POST">
                <div class="modal-body">
                    <div class="col" id="cekSelesai"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/selectize.min.js"></script>
<script>
    $(document).ready(function() {
        $('select.tize').selectize();
    });

    $('span.updateSPK').click(function() {
        var order = $(this).attr("data-order");
        $("div#cekUpdate").load('<?= $this->BASE_URL ?>SPK/load_update/' + order);
    });


    $('span.cekSPK').click(function() {
        var order = $(this).attr("data-order");
        var parse = $(this).attr("data-parse");
        $("div#content").load('<?= $this->BASE_URL ?>SPK/cekSPK/' + order + "/" + parse);
    });

    $("form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    content();
                } else {
                    alert(res);
                }
            },
        });
    });
</script>