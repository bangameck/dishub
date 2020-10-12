<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content');
$u = $user ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <form class="cmxform" method="post" action="<?= base_url(); ?>/bagian/save" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="username" value="<?= $u['username']; ?>" id="">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label">Nama / Username</label>
                            <input class="form-control <?= ($validation->hasError('user_nama')) ? 'is-invalid' : ''; ?>" name="user_nama" value="<?= $u['nama'] ?>" id="user_nama" type="text" readonly>
                            <div class="invalid-feedback">
                                <?= $validation->getError('user_nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Bidang</label>
                                <select class="js-example-basic-single w-100 <?= ($validation->hasError('id_bidang')) ? 'is-invalid' : ''; ?>" name="id_bidang" id="id_bidang">
                                    <option>Pilih Bidang</option>
                                    <?php foreach ($bidang as $b) : ?>
                                        <option value="<?= $b['id_bidang']; ?>"><?= $b['nm_bidang']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id_bidang'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Bagian</label>
                                <select class="js-example-basic-single w-100 <?= ($validation->hasError('nid_bagian')) ? 'is-invalid' : ''; ?>" name="id_bagian" id="id_bagian" required>
                                    <option value="">Pilih Bagian</option>

                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id_bagian'); ?>
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

    
