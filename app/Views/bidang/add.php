<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <form class="cmxform" method="post" action="<?= base_url(); ?>/bidang/save" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Nama Bidang</label>
                            <input class="form-control <?= ($validation->hasError('nm_bidang')) ? 'is-invalid' : ''; ?>" name="nm_bidang" value="<?= old('nm_bidang'); ?>" id="nm_bidang" type="text" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nm_bidang'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Initial</label>
                            <input class="form-control <?= ($validation->hasError('initial')) ? 'is-invalid' : ''; ?>" name="initial" value="<?= old('initial'); ?>" id="initial" type="text">
                            <div class="invalid-feedback">
                                <?= $validation->getError('initial'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="foto" class="col-form-label">Logo</label>
                            <img src="<?= base_url(); ?>/_upload/logo/default.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-lg-9">
                            <label class="col-form-label">Pilih Logo</label>
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
                        </div>
                    </div>
                    <button type="submit" class="col-lg-12 btn btn-primary"> Save </button>
                    <form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>