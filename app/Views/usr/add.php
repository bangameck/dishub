<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <form class="cmxform" method="post" action="/user/save" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label">No. Unik Pegawai DISHUB</label>
                            <input class="form-control" value="DISHUB-<?= random_string('numeric', 5); ?>" name="no_peg" id="no_peg" type="text" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Nama</label>
                            <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" value="<?= old('nama'); ?>" id="nama" type="text" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Username</label>
                            <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username'); ?>" id="username" type="text">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Email</label>
                            <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email'); ?>" id="email" type="email">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Level</label>
                                <select class="js-example-basic-single w-100 <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" name="level">
                                    <?php $lev = [
                                        '' => 'Pilih Level',
                                        '1' => 'Admin',
                                        '2' => 'Kepala',
                                        '3' => 'Password'
                                    ]; ?>
                                    <option value="<?= old('level'); ?>"><?= $lev[old('level')]; ?></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kepala</option>
                                    <option value="3">Pegawai</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('level'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label">Foto</label>
                            <input type="file" name="foto" id="myDropify" class="border <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" />
                            <div style="color: red;">
                                <?= $validation->getError('foto'); ?>
                            </div>
                        </div>
                    </div>
                    <button type=" submit" class="btn btn-primary"> Save </button>
                    <form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>