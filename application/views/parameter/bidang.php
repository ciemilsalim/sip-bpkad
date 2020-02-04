<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-12">
            <?= form_error('bidang', '<div class = "alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>


            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#bidangModal">Tambah Bidang</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Bidang</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bidang as $b) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $b['nama_bidang']; ?></td>
                            <td><a href="#" class="badge badge-success" data-toggle="modal" data-target="#editbidangModal<?= $b['id_bidang']; ?>">Edit</a> | <a onclick="return confirm('Yakin akan menghapus data?');" href="<?= base_url('parameter/delete_bidang/') . $b['id_bidang']; ?>" class="badge badge-danger">Hapus</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="bidangModal" tabindex="-1" role="dialog" aria-labelledby="bidangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bidangModalLabel">Tambah Bidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('parameter/tambah_bidang'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" placeholder="Nama Bidang..">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php
if (isset($bidang)) {

    foreach ($bidang as $b) :
        ?>
        <div class="modal fade" id="editbidangModal<?= $b['id_bidang']; ?>" tabindex="-1" role="dialog" aria-labelledby="editbidangModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editbidangModalLabel">Ubah Bidang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('parameter/edit_bidang'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="id_bidang" name="id_bidang" value="<?= $b['id_bidang']; ?>">
                                <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" placeholder="Nama Bidang.." value="<?= $b['nama_bidang']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach;
}
?>