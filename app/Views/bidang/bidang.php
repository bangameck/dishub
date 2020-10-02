<!-- template -->
<?= $this->extend('_template/template'); ?>

<!-- isi konten -->
<?= $this->section('content'); ?>

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><?= $title; ?></h6>
                    <a href="<?= base_url(); ?>/bidang/add" type="button" class="btn btn-primary mb-3">Tambah Bidang</a>
                    <?php if (session()->getFlashdata('pesan_gagal')) : ?>
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
                                    <th>Nama Bidang</th>
                                    <th>Inisial</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $lev = [
                                    '0' => 'null',
                                    '1' => 'Admin',
                                    '2' => 'Kepala',
                                    '3' => 'Pegawai'
                                ];
                                foreach ($bidang as $b) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $b['nm_bidang']; ?></td>
                                        <td><?= $b['initial']; ?></td>
                                        <td><img src="<?= base_url(); ?>/_upload/logo/<?= $b['logo']; ?>" alt=""></td>
                                        <td><a href="<?= base_url(); ?>/bidang/<?= $b['slug']; ?>" class="btn btn-outline-primary"> Detail</a>
                                            <a href="<?= base_url(); ?>/bidang/edit/<?= $b['slug']; ?>" class="btn btn-outline-warning"> Edit</a>
                                            <form action="<?= base_url(); ?>/bidang/<?= $b['id_bidang']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah yakin ingin menghapus data ini ?')">Delete</button>
                                            </form>
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