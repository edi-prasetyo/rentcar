<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>
<div class="card">
    <div class="card-body">

        <?php echo form_open('admin/transaksi/create'); ?>

        <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>">

        <!-- Provinsi -->
        <div class="form-group">
            <label>Provinsi</label>

            <select class="form-control custom-select" id='sel_provinsi' name="provinsi_id">
                <option>-- Pilih Provinsi --</option>
                <?php
                foreach ($provinsi as $provinsi) {
                    echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
                }
                ?>
            </select>

        </div>

        <!-- Kota -->
        <div class="form-group">
            <label>Kota</label>

            <select class="form-control custom-select" id='sel_kota' name="kota_id">
                <option>-- Pilih Kota --</option>
            </select>

        </div>

        <!-- Kecamatan -->
        <div class="form-group">
            <label>Kecamatan</label>

            <select class="form-control custom-select" id='sel_kecamatan' name="kecamatan_id">
                <option>-- Pilih Kecamatan --</option>
            </select>

        </div>

        <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
        <?php echo form_close(); ?>

    </div>
</div>
<!-- Script -->
<script src="<?php echo base_url(); ?>assets/template/admin/plugins/jquery/jquery.min.js"></script>

<script type='text/javascript'>
    // baseURL variable
    var baseURL = "<?php echo base_url(); ?>";

    $(document).ready(function() {

        // Provinsi change
        $('#sel_provinsi').change(function() {
            var provinsi = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?= base_url() ?>admin/wilayah/getKota',
                method: 'post',
                data: {
                    provinsi: provinsi
                },
                dataType: 'json',
                success: function(response) {

                    // Remove options 
                    $('#sel_kecamatan').find('option').not(':first').remove();
                    $('#sel_kota').find('option').not(':first').remove();

                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_kota').append('<option value="' + data['id'] + '">' + data['kota_name'] + '</option>');
                    });
                }
            });
        });

        // Kota change
        $('#sel_kota').change(function() {
            var kota = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?= base_url() ?>admin/wilayah/getKecamatan',
                method: 'post',
                data: {
                    kota: kota
                },
                dataType: 'json',
                success: function(response) {

                    // Remove options
                    $('#sel_kecamatan').find('option').not(':first').remove();

                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_kecamatan').append('<option value="' + data['id'] + '">' + data['kecamatan_name'] + '</option>');
                    });
                }
            });
        });

    });
</script>