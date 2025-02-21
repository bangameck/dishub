<!-- core:js -->
<script src="<?= base_url(); ?>/assets/vendors/core/core.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="<?= base_url(); ?>/assets/vendors/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/inputmask/jquery.inputmask.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/select2/select2.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/dropzone/dropzone.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/dropify/dist/dropify.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/chartjs/Chart.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/jquery.flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url(); ?>/assets/vendors/feather-icons/feather.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<script src="<?= base_url(); ?>/assets/js/form-validation.js"></script>
<script src="<?= base_url(); ?>/assets/js/bootstrap-maxlength.js"></script>
<script src="<?= base_url(); ?>/assets/js/inputmask.js"></script>
<script src="<?= base_url(); ?>/assets/js/select2.js"></script>
<script src="<?= base_url(); ?>/assets/js/typeahead.js"></script>
<script src="<?= base_url(); ?>/assets/js/tags-input.js"></script>
<script src="<?= base_url(); ?>/assets/js/dropzone.js"></script>
<script src="<?= base_url(); ?>/assets/js/dropify.js"></script>
<script src="<?= base_url(); ?>/assets/js/bootstrap-colorpicker.js"></script>
<script src="<?= base_url(); ?>/assets/js/datepicker.js"></script>
<script src="<?= base_url(); ?>/assets/js/timepicker.js"></script>
<script src="<?= base_url(); ?>/assets/js/dashboard.js"></script>
<script src="<?= base_url(); ?>/assets/js/datepicker.js"></script>
<script src="<?= base_url(); ?>/assets/js/data-table.js"></script>
<script src="<?= base_url(); ?>/assets/js/file-upload.js"></script>

<script>

$("#kendaraan").change(function(){

    // variabel dari nilai combo box kendaraan
    var id_kendaraan = $("#kendaraan").val();

    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
        url : "<?php echo base_url();?>/kendaraan/get_merk",
        method : "POST",
        data : {id_kendaraan:id_kendaraan},
        async : false,
        dataType : 'json',
        success: function(data){
            var html = '';
            var i;

            for(i=0; i<data.length; i++){
                html += '<option value='+data[i].id_merk_kendaraan+'>'+data[i].merk_kendaraan+'</option>';
            }
            $('#merk').html(html);

        }
    });
});

$('#id_bidang').change(function(){

    // variabel dari nilai combo box kendaraan
    var id_bidang = $('#id_bidang').val();

    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
        url : "<?php echo base_url();?>/bb_u/get_bagian",
        method : "POST",
        data : {id_bidang:id_bidang},
        async : false,
        dataType : 'json',
        success: function(data){
            var html = '';
            var i;

            for(i=0; i<data.length; i++){
                html += '<option value='+data[i].id_bagian+'>'+data[i].nm_bagian+'</option>';
            }
            $('#id_bagian').html(html);

        }
    });
});
</script>
<script>
    $("#username").on({
        keydown: function(e) {
            if (e.which === 32)
                return false;
        },
        keyup: function() {
            this.value = this.value.toLowerCase();
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");

        }
    });

    $("#initial").on({
        keydown: function(e) {
            if (e.which === 32)
                return false;
        },
        keyup: function() {
            this.value = this.value.toUpperCase();
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");

        }
    });

    //image preview
    function previewImg() {
        const foto = document.querySelector('#foto');
        const fotoLabel = document.querySelector('.file-upload-info');
        const imgPreview = document.querySelector('.img-preview');

        fotoLabel.textContent = foto.files[0].name;

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<script>

</script>
<!-- end custom js for this page -->