<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/mobil/create_hourly/' . $mobil->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Paket <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="paket" placeholder="Nama Paket" value="<?php echo set_value('paket'); ?>">

            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga Paket <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="price" placeholder="Harga Paket" value="<?php echo set_value('price'); ?>">

            </div>
        </div>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status Product <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="status" class="form-control form-control-chosen select2_demo_1">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>