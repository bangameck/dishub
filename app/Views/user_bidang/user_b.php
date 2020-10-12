<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="cmxform" method="post" action="<?= base_url(); ?>/bb_u/detail" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-form-label">Nama Anggota</label>
                                <select class="js-example-basic-single w-100 <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" required>
                                    <option value="">Pilih Nama</option>
                                    <?php foreach ($user as $u) : ?>
                                        <option value="<?= $u['username']; ?>"><?= $u['nama']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('level'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="col-lg-12 btn btn-primary"> Selanjutnya </button>
                    <form>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>