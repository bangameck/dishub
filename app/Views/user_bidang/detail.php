<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?> </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><?= $title; ?></h6>
                    <form action="<?= base_url(); ?>/bb_u/add" method="post">
                        <input type="hidden" name="username" value="<?= $username; ?>">
                        <button type="sumbit" class="btn btn-primary mb-3"> Tambah Data</button>
                    </form>
                    <?php

                    use function App\Controllers\tgl_indo;

                    if (session()->getFlashdata('pesan_gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong> <?= session()->getFlashdata('pesan_gagal'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Yeay!</strong> <?= session()->getFlashdata('pesan'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Bidang</th>
                                    <th>Bagian</th>
                                    <th>Jabatan</th>
                                    <th>Tgl. Mutasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($user_bagian as $u) :
                                    $tgl_mutasi = tgl_indo(date($u['y'] . '-' . $u['m'] . '-' . $u['d']));

                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $u['nama']; ?></td>
                                        <td><?= $u['nm_bidang']; ?></td>
                                        <td><?= $u['nm_bagian']; ?></td>
                                        <td><?= $u['jabatan']; ?></td>
                                        <td><?= $tgl_mutasi; ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="<?= base_url(); ?>/user/<?= $u['slug']; ?>">Detail</a>
                                                    <a class="dropdown-item" href="<?= base_url(); ?>/user/edit/<?= $u['slug']; ?>">Edit</a>
                                                    <form action="<?= base_url(); ?>/user/<?= $u['id_usr']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah yakin ingin menghapus data ini ?')">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>