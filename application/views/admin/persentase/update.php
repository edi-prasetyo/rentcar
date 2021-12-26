<div class="col-md-6 mx-auto">
    <div class="card mb-4">
        <div class="card-header py-3">
            <?php echo $title; ?>
        </div>
        <div class="card-body">


            <div class="text-center">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
            <?php
            echo form_open('admin/persentase/update/' . $persentase->id);
            ?>

            <div class="form-group">
                <label> Potongan Saldo Driver <span class="text-danger">*</span>
                </label>

                <input type="text" class="form-control" name="potong_saldo" value="<?php echo $persentase->potong_saldo; ?>">

            </div>

            <button type="submit" class="btn btn-info btn-block">
                Update Data
            </button>

        </div>

        <?php echo form_close() ?>
    </div>
</div>