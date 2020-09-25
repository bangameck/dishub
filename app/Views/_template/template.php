<?php if (empty(session()->get('username')) && empty(session()->get('password'))) {
    echo '<script type="text/javascript">
            window.location.href = "' . base_url() . '";
            </script>';
    session()->setFlashdata('pesan', 'Login Terlebih dahulu');
}

?>
<!DOCTYPE html>
<html lang="en">

<?= $this->include('_template/head'); ?>

<body>

    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <?= $this->include('_template/sidebar'); ?>


        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <?= $this->include('_template/navbar'); ?>

            <!-- partial -->

            <?= $this->renderSection('content'); ?>

            <!-- partial:partials/_footer.html -->
            <?= $this->include('_template/footer'); ?>
            <!-- partial -->

        </div>
    </div>

    <?= $this->include('_template/js.php'); ?>
</body>

</html>