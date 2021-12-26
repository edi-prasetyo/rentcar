<div class="card mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        echo form_open('admin/pengaturan/update/' . $pengaturan->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Pengaturan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="name" value="<?php echo $pengaturan->name; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Email Ke Admin <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="cc_email" value="<?php echo $pengaturan->cc_email; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Protocol <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="protocol" value="<?php echo $pengaturan->protocol; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">smtp_host <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="smtp_host" value="<?php echo $pengaturan->smtp_host; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">smtp_port <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="smtp_port" value="<?php echo $pengaturan->smtp_port; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">smtp_user <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="smtp_user" value="<?php echo $pengaturan->smtp_user; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">smtp_pass <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="smtp_pass" value="<?php echo $pengaturan->smtp_pass; ?>">
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-info btn-lg btn-block">
                    Update Profile
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>