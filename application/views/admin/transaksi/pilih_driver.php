<div class="col-md-7">
    <div class="card">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        }
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        ?>
        <div class="card-header">Pilih Driver </div>
        <div class="card-body">

            <?php echo form_open('admin/transaksi/pilih_driver/' . $transaksi->id); ?>
            <div class="form-group">
                <label>Pilih Driver</label>
                <select name="driver_id" class="form-control select2bs4" required>
                    <option value="">--Pilih Driver-</option>
                    <?php foreach ($driver as $data) : ?>
                        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Kirim Order</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>