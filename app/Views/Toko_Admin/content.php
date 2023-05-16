<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="card mt-n10" style="max-width: 500px;">
            <div class="card-header ">Admin Orins Toko
                <?php if (count($data) == 0) { ?>
                    <button type="button" class="float-end btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
                <?php } ?>
            </div>
            <div class="card-body">

                <?php
                foreach ($data as $a) { ?>
                    <?= $this->userData['nama_toko'] ?><br>
                    <?= $a['nama'] ?> ID : [ <?= $a['id_user'] ?> ]<br>
                    No. HP : <?= $a['user'] ?>
                    <button type="button" class="float-end btn btn-sm btn-outline-primary">Reset Password</button> <br>
                    <small>Default Password : 1234</small>
                <?php }
                ?>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menambah Admin Orins Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $this->BASE_URL ?>Toko_Admin/add" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No. Handphone</label>
                        <input type="text" name="hp" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $this->ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>