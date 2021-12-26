<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<?php
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
?>

<?php echo form_open('counter/transaksi/select_driver/' . $insert_id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
<div class="col-md-6 mx-auto my-3 pb-5">
    <div class="card">
        <div class="card-body">
            <select class="form-control select2bs4" id='sel_provinsi' name="driver_id" required>
                <option value="">-- Pilih Driver --</option>
                <?php
                foreach ($driver as $data) : ?>
                    <option value='<?php echo $data->id; ?>'><?php echo $data->name; ?></option>

                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Silahkan Pilih Driver.</div>

            <button class="btn btn-success btn-block mt-3" type="submit">Order Sekarang</button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>