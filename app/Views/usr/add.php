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
                        <div class="col-lg-3">
                            <label for="foto" class="col-form-label">Foto</label>
                            <img src="/_upload/f_usr/default.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-lg-9">
                            <label class="col-form-label">Pilih Foto</label>
                            <input type="file" name="foto" class="file-upload-default" id="foto" onchange="previewImg()">
                            <div class=" input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" disabled="" placeholder="Upload Image" for="foto">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>
                            </div>
                            <!-- <div class="custom-file">
                                <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto'); ?>
                                </div>
                                <label class="custom-file-label" for="foto">Pilih Gambar...</label>
                            </div> -->
                        </div>
                    </div>
                    <button type="submit" class="col-lg-12 btn btn-primary"> Save </button>
                    <form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>