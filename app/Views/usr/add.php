<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah data user</h4>
                <form class="cmxform" method="post" action="/user/save">
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
                            <input class="form-control" name="nama" id="nama" type="text" autofocus>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Username</label>
                            <input class="form-control" name="username" id="username" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label">Email</label>
                            <input class="form-control" name="email" id="email" type="email">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label">Level</label>
                                <select class="js-example-basic-single w-100" name="level">
                                    <option>Pilih Level</option>
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