<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    Pemerintah Daerah
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <?= $this->session->flashdata('message'); ?>

                            <?= form_open_multipart('parameter/editskpd'); ?>
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $skpd['tahun']; ?>">
                                </div>
                                <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->