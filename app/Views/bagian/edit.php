<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <form class="cmxform" method="post" action="<?= base_url(); ?>/bagian/update/<?= $bagian['id_bagian']; ?>" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $bagian['b_slug']; ?>">
                    <input type="hidden" name="fotoLama" value="<?= $bagian['b_foto']; ?>">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Nama Bidang</label>
                            <input class="form-control <?= ($validation->hasError('nm_bagian')) ? 'is-invalid' : ''; ?>" name="nm_bagian" value="<?= (old('nm_bagian')) ? old('nm_bagian') : $bagian['nm_bagian']; ?>" id="nm_bagian" type="text" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nm_bagian'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Initial</label>
                            <input class="form-control <?= ($validation->hasError('initial')) ? 'is-invalid' : ''; ?>" name="initial" value="<?= (old('initial')) ? old('initial') : $bagian['b_initial']; ?>" id="initial" type="text">
                            <div class="invalid-feedback">
                                <?= $validation->getError('initial'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-form-label">Bidang</label>
                                <select class="js-example-basic-single w-100 <?= ($validation->hasError('nm_bidang')) ? 'is-invalid' : ''; ?>" name="nm_bidang">
                                    <option value="<?= $bagian['id_bidang']; ?>"><?= $bagian['nm_bidang']; ?></option>
                                    <?php foreach ($bidang as $b) : ?>
                                        <option value="<?= $b['id_bidang']; ?>"><?= $b['nm_bidang']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nm_bidang'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="foto" class="col-form-label">Foto</label>
                            <img src="<?= base_url(); ?>/_upload/logo/<?= $bagian['b_foto']; ?>" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-lg-9">
                            <label class="col-form-label">Pilih Foto</label>
                            <input type="file" name="foto" class="file-upload-default" id="foto" onchange="previewImg()">
                            <div class=" input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" disabled="" placeholder="<?= $bagian['b_foto']; ?>" for="foto">
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
                    <button type="submit" class="btn btn-primary"> Save </button>
                    <form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>