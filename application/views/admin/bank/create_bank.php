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
        echo form_open_multipart('admin/bank/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Bank <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="bank_name" placeholder="Nama Bank" value="<?php echo set_value('bank_name'); ?>">
                <?php echo form_error('bank_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nomor Rekening <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="bank_number" placeholder="Nomor rekening" value="<?php echo set_value('bank_number'); ?>">
                <?php echo form_error('bank_number', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Atas Nama <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="bank_account" placeholder="Atas Nama" value="<?php echo set_value('bank_account'); ?>">
                <?php echo form_error('bank_account', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Cabang <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="bank_branch" placeholder="Cabang" value="<?php echo set_value('bank_branch'); ?>">
                <?php echo form_error('bank_branch', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Logo <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="bank_logo">
                </div>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Simpan Bank
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
