<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrasi Akun</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registrasi') ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama lengkap" value="<?= set_value('nama'); ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="">--Pilih Role--</option>
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="skpd" id="skpd" class="form-control">
                                    <option value="">--Pilih SKPD--</option>
                                    <?php foreach ($urusan as $u) : ?>
                                        <option value="<?= $u['Kd_Urusan'].'#'.$u['Kd_Bidang'].'#'.$u['Kd_Unit'].'#'.$u['Kd_Sub'].'#'.$u['Nm_Sub_Unit']; ?>"><?= $u['Nm_Sub_Unit']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                          
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Buat Akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>auth/forgotpassword">Lupa Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>auth">Sudah Memiliki Akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>