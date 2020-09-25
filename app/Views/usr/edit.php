<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <form class="cmxform" method="post" action="/user/update/<?= $user['id_usr']; ?>">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $user['slug']; ?>">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label">No. Unik Pegawai DISHUB</label>
                            <input class="form-control" value="<?= $user['no_peg']; ?>" name="no_peg" id="no_peg" type="text" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Nama</label>
                            <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" value="<?= $user['nama']; ?>" id="nama" type="text" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Username</label>
                            <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= $user['username']; ?>" id="username" type="text">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Email</label>
                            <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= $user['email']; ?>" id="email" type="email">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Level</label>
                                <select class="js-example-basic-single w-100" name="level">
                                    <?php $lev = [
                                        '' => 'Pilih Level',
                                        '1' => 'Admin',
                                        '2' => 'Kepala',
                                        '3' => 'Password'
                                    ]; ?>
                                    <option value="<?= $user['level']; ?>"><?= $lev[$user['level']]; ?></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala</option>
                                    <option value="3">Pegawai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label">Foto</label>
                            <input type="file" name="foto" id="myDropify" class="border" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Save </button>
                    <form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>