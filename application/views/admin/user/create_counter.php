<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            Masukan Data Counter
        </div>
        <div class="card-body">
            <!-- Nested Row within Card Body -->

            <?php
            echo form_open('admin/user/create_counter')
            ?>

            <!-- Provinsi -->
            <div class="form-group row">
                <label class="col-md-4 text-md-right">Provinsi</label>
                <div class="col-md-8">
                    <select class="form-control select2bs4" id='sel_provinsi' name="provinsi_id">
                        <option>-- Pilih Provinsi --</option>
                        <?php
                        foreach ($provinsi as $provinsi) {
                            echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Kota -->
            <div class="form-group row">
                <label class="col-md-4 text-md-right">Kota</label>
                <div class="col-md-8">
                    <select class="form-control custom-select" id='sel_kota' name="kota_id">
                        <option>-- Pilih Kota --</option>
                    </select>
                </div>
            </div>

            <!-- Kecamatan -->
            <!-- <div class="form-group row">
                <label class="col-md-4 text-md-right">Kecamatan</label>
                <div class="col-md-8">
                    <select class="form-control custom-select" id='sel_kecamatan' name="kecamatan_id">
                        <option>-- Pilih Kecamatan --</option>
                    </select>
                </div>
            </div> -->

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Main Agen</label>
                <div class="col-md-8">
                    <select class="form-control select2bs4" name="id_agen" value="">
                        <?php foreach ($user_agen as $user_agen) : ?>
                            <option value='<?php echo $user_agen->id; ?>'><?php echo $user_agen->name; ?> - <?php echo $user_agen->kota_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Title</label>
                <div class="col-md-8">
                    <select class="form-control custom-select" name="user_title" value="">
                        <option value='Bapak'>Bapak</option>
                        <option value='Ibu'>Ibu</option>
                        <option value='Saudara'>Saudara</option>
                        <option value='Saudari'>Saudari</option>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>">
                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Allamat Lengkap</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="user_address" placeholder="Alamat Lengkap" value="<?php echo set_value('user_address'); ?>"></textarea>
                    <?php echo form_error('user_address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nomor Hp</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                    <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Ulangi Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password2" placeholder="Repeat Password">

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary btn-block">
                        Register Account
                    </button>
                </div>

                <?php echo form_close() ?>



            </div>
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