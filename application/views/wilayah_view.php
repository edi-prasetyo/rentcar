<!doctype html>
<html>

<body>

    <table>

        <!-- City -->
        <tr>
            <td>City</td>
            <td>
                <select id='sel_city' name="provinsi_id">
                    <option>-- Select city --</option>
                    <?php
                    foreach ($provinsi as $provinsi) {
                        echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Department -->
        <tr>
            <td>Department</td>
            <td>
                <select id='sel_depart'>
                    <option>-- Select deparment --</option>
                </select>
            </td>
        </tr>

        <!-- User -->
        <tr>
            <td>User</td>
            <td>
                <select id='sel_user'>
                    <option>-- Select user --</option>
                </select>
            </td>
        </tr>
    </table>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type='text/javascript'>
        // baseURL variable
        var baseURL = "<?php echo base_url(); ?>";

        $(document).ready(function() {

            // City change
            $('#sel_city').change(function() {
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
                        $('#sel_user').find('option').not(':first').remove();
                        $('#sel_depart').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#sel_depart').append('<option value="' + data['id'] + '">' + data['kota_name'] + '</option>');
                        });
                    }
                });
            });

            // Department change
            $('#sel_depart').change(function() {
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
                        $('#sel_user').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#sel_user').append('<option value="' + data['id'] + '">' + data['kecamatan_name'] + '</option>');
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>